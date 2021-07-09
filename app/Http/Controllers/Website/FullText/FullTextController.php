<?php

namespace App\Http\Controllers\Website\FullText;

use App\Models\Abstraction;
use App\Models\CallForPaper;
use App\Models\Contact;
use App\Models\FullText;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class FullTextController extends Controller
{
    /**
     * @var FullText $full_text
     */
    protected $full_text;

    /**
     * FullText constructor.
     */
    public function __construct()
    {
        View::share('menu', 'Upload Abstract');
        $this->full_text = new FullText();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['model'] = FullText::find(0);
        $data['abstractions'] = Abstraction::where('name', '<>', 'default')->where('status', 'approve')->orderBy('name', 'asc')->get();
        return view('website.full_text.index', $data);
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
            'abstraction_id' => 'required',
            'full_text' => 'required|file|mimes:pdf,doc,docx|max:8192',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        $path = $request->file('full_text')->store('full_text');
        $abstraction = Abstraction::find($request->abstraction_id);

        $setting = Setting::find(1);
        $contact = Contact::find(1);

        if ($abstraction) {
            $model = $abstraction->fullTexts()->create($request->except('full_text', 'g-recaptcha-response') + ['url' => $path]);
            if ($model) {

                Mail::raw(
                    "Nama : $request->name \n".
                    "Phone : $request->phone \n".
                    "Email : $request->email \n".
                    "Judul : $request->title \n".
                    "Author : $request->author \n".
                    "Kategori : $abstraction->title \n".
                    "Link File : ".route('admin.full_text.show', $model->id)
                    , function ($message) use ($request, $setting, $contact, $model) {
                    $message->to(env('MAIL_SEND_TO', 'emosekolah@gmail.com'));
                    $message->from($contact->email);
                    $message->subject("Data Form Full Text $setting->title");
                    $message->attach(storage_path('/app/public/'.$model->url));
                });

                if ($request->email != '-') {
                    Mail::raw(
                        "Congratulations on your full text successfully uploaded.\n".
                        "For more information, please visit the website ".route('landing.index')
                        , function ($message) use ($request, $setting, $contact, $model) {
                        $message->to($request->email);
//                        $message->to('emosekolah@gmail.com');
                        $message->from($contact->email);
                        $message->subject("Notifikasi upload full text $setting->title");
                    });
                }

                return redirect()->route('full_text.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            }
        } else {
            return redirect()->route('full_text.index')->with(['status' => 'danger', 'message' => 'Category not Found']);
        }

        return redirect()->route('full_text.index')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $model = Abstraction::with('category')->where('id', $request->id)->first();

        if ($model) {
            return response()->json(['success' => true, 'data' => $model]);
        }
        return response()->json(['success' => false, 'data' => 'Data Tidak Ditemukan']);
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
