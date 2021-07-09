<?php

namespace App\Http\Controllers\Admin\Speaker;

use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
    /**
     * @var Speaker $speaker
     */
    protected $speaker;

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->speaker = new Speaker();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Speaker::latest()->paginate('10');
        return view('admin.speaker.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.speaker.create');
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
            'name' => 'required|max:200',
            'university' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('speaker');

        if ($this->speaker->create($request->except('image') + ['url' => $path])) {
            return redirect()->route('admin.speaker.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.speaker.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        return view('admin.speaker.edit', ['model' => $speaker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speaker $speaker)
    {
        $request->validate([
            'name' => 'required|max:200',
            'university' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {

            if (Storage::exists($speaker->url)) {
                Storage::delete($speaker->url);
            }

            $path = $request->file('image')->store('speaker');
            $update = $speaker->update($request->except('image') + ['url' => $path]);
        } else {
            $update = $speaker->update($request->except('image'));
        }

        if ($update) {
            return redirect()->route('admin.speaker.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        } else {
            return redirect()->route('admin.speaker.edit', $speaker->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Speaker $speaker
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Speaker $speaker)
    {
        if (Storage::exists($speaker->url)) {
            Storage::delete($speaker->url);
        }

        if ($speaker->delete()) {
            return redirect()->route('admin.speaker.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.speaker.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
