<?php

namespace App\Http\Controllers\Website\Abstraction;

use App\Models\Abstraction;
use App\Models\CallForPaper;
use App\Models\Contact;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AbstractionController extends Controller
{
    /**
     * @var Abstraction $abstraction
     */
    protected $abstraction;

    /**
     * Abstraction constructor.
     */
    public function __construct()
    {
        View::share('menu', 'Upload Abstract');
        $this->abstraction = new Abstraction();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['model'] = Abstraction::find(0);
        $data['callForPapers'] = CallForPaper::take(3)->get();
        return view('website.abstract.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws GuzzleException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'author' => 'required',
            'call_for_paper_id' => 'required',
            'abstraction' => 'required|file|mimes:pdf,doc,docx|max:8192',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        $path = $request->file('abstraction')->store('abstraction');
        $category = CallForPaper::find($request->call_for_paper_id);

        $setting = Setting::find(1);
        $contact = Contact::find(1);

        if ($category) {
            $model = $category->abstractions()->create($request->except('abstraction', 'g-recaptcha-response') + ['url' => $path]);
            if ($model) {

                Mail::raw(
                    "Nama : $request->name \n".
                    "Phone : $request->phone \n".
                    "Email : $request->email \n".
                    "Judul : $request->title \n".
                    "Author : $request->author \n".
                    "Kategori : $category->title \n".
                    "Link File : ".route('admin.abstraction.show', $model->id)
                    , function ($message) use ($request, $setting, $contact, $model) {
                    $message->to(env('MAIL_SEND_TO', 'emosekolah@gmail.com'));
                    $message->from($contact->email);
                    $message->subject("Data Form Abstraction $setting->title");
                    $message->attach(storage_path('/app/public/'.$model->url));
                });

                Mail::raw(
                    "Congratulations, your abstract has been uploaded successfully.\n".
                    "For more information, please visit the website ".route('landing.index')
                    , function ($message) use ($request, $setting, $contact, $model) {
                    $message->to($request->email);
//                    $message->to('emosekolah@gmail.com');
                    $message->from($contact->email);
                    $message->subject("Notifikasi upload abstract $setting->title");
                });

                return redirect()->route('abstraction.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            }
        } else {
            return redirect()->route('abstraction.index')->with(['status' => 'danger', 'message' => 'Category not Found']);
        }

        return redirect()->route('abstraction.index')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @return void
     * @throws GuzzleException
     */
    public function show()
    {
        try {
            $client = new Client();
            $res = $client->request('get', 'http://dentisphere-mail.aksastudio.com/get-data');

            $response = json_decode($res->getBody());
        } catch (\Exception $e) {
            $response = collect([
                'failed',
                $e->getMessage()
            ]);
            echo "<script>console.log('Error nya : $response[1]')</script>";
        }
        var_dump($response);
        return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
