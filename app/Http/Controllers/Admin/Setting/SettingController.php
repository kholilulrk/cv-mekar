<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['model'] = Setting::find(1);
        return view('admin.setting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $config = [
            'icon' => 'image',
            'logo' => 'image',
            'logo_grayscale' => 'image'
        ];
        if ($setting->icon == null) {
            $config['icon'] = 'required|image';
        }
        if ($setting->logo == null) {
            $config['logo'] = 'required|image';
        }
        if ($setting->logo_grayscale == null) {
            $config['logo_grayscale'] = 'required|image';
        }
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'keyword' => 'required',
            'short_description' => 'required|max:200',
            'description' => 'required',
            'icon' => 'image',
            'logo' => 'image',
            'logo_grayscale' => 'image'
        ]);

        $upload = [
            'icon' => $setting->icon,
            'logo' => $setting->logo,
            'logo_grayscale' => $setting->logo_grayscale,
            'bg_banner' => $setting->bg_banner
        ];

        if ($request->hasFile('icon')) {

            if (Storage::exists($setting->icon)) {
                Storage::delete($setting->icon);
            }

            $path = $request->file('icon')->store('setting');
            $upload['icon'] = $path;
        }

        if ($request->hasFile('logo')) {

            if (Storage::exists($setting->logo)) {
                Storage::delete($setting->logo);
            }

            $path = $request->file('logo')->store('setting');
            $upload['logo'] = $path;
        }

        if ($request->hasFile('logo_grayscale')) {

            if (Storage::exists($setting->logo_grayscale)) {
                Storage::delete($setting->logo_grayscale);
            }

            $path = $request->file('logo_grayscale')->store('setting');
            $upload['logo_grayscale'] = $path;
        }

        if ($setting->update($request->except('icon', 'logo', 'logo_grayscale') + $upload)) {
            return redirect()->route('admin.setting.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        } else {
            return redirect()->route('admin.setting.index')->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
