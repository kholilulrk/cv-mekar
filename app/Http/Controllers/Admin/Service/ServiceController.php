<?php

namespace App\Http\Controllers\Admin\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['service'] = Service::orderBy('id', 'desc')->paginate(5);
        return view('admin.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'title'         => 'required|max:200',
            'description'   => 'required',
            'icon'          => 'required|image'
        ]);

        $path = $request->file('icon')->store('service');

        $service = Service::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'icon'          => $path
        ]);

        if($service) {
            return redirect()->route('admin.service.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.service.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service  = Service::find($id);

        $request->validate([
            'title'         => 'required|max:200',
            'description'   => 'required',
            'icon'          => 'image'
        ]);

        if ($request->file('icon')) {
            $file = $request->file('icon');
            $path = $file->store("service");

            if (@$service->icon && Storage::exists($service->icon)) {
                Storage::delete($service->icon);
            }
        }

        $service->fill([
            'title'             => $request->title,
            'description'       => $request->description,
            'icon'              => ($request->file('icon') ? $path : ($service->icon != null ? $service->icon : null))
        ])->save();

        return redirect()->route('admin.service.index')->with(['status' => 'success', 'message' => 'Service updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if (@$service->icon && Storage::exists($service->icon)) {
            Storage::delete($service->icon);
        }

        $service->delete();

        return redirect()->route('admin.service.index')->with(['status' => 'success', 'message' => 'Service deleted successfully']);
    }
}
