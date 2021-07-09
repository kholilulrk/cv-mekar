<?php

namespace App\Http\Controllers\Admin\Slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * @var Slider $slider
     */
    protected $slider;

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        $this->slider = new Slider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Slider::orderBy('id', 'desc')->paginate(10);
        return view('admin.slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('slider');
        if ($this->slider->create($request->only('title', 'description') + ['url' => $path])) {
            return redirect()->route('admin.slider.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.slider.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', ['model' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {

            if (Storage::exists($slider->url)) {
                Storage::delete($slider->url);
            }

            $path = $request->file('image')->store('slider');
            $update = $slider->update($request->only('title', 'description') + ['url' => $path]);
        } else {
            $update = $slider->update($request->only('title', 'description'));
        }

        if ($update) {
            return redirect()->route('admin.slider.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.slider.edit', $slider->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Slider $slider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        if (Storage::exists($slider->url)) {
            Storage::delete($slider->url);
        }

        if ($slider->delete()) {
            return redirect()->route('admin.slider.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.slider.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
