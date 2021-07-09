<?php

namespace App\Http\Controllers\Admin\Registration;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    /**
     * @var Registration $registration
     */
    protected $registration;

    /**
     * RegistrationController constructor.
     */
    public function __construct()
    {
        $this->registration = new Registration();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Registration::latest()->paginate(10);
        return view('admin.registration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.registration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'url' => 'nullable|url'
        ]);

        if ($this->registration->create($request->only('title', 'description', 'url'))) {
            return redirect()->route('admin.registration.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.registration.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Registration $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        return view('admin.registration.edit', ['model' => $registration]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Registration $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'title' => 'required|max:200',
            'url' => 'nullable|url'
        ]);

        if ($registration->update($request->only('title', 'description', 'url'))) {
            return redirect()->route('admin.registration.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.registration.edit', $registration->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Registration $registration
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Registration $registration)
    {
        if ($registration->delete()) {
            return redirect()->route('admin.registration.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.registration.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
