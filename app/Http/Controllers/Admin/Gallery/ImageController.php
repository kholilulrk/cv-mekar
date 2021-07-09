<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\CategoryGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ImageController extends Controller
{
    /**
     * @var Gallery $gallery
     */
    protected $gallery;

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->gallery = new Gallery();
        $data['categories'] = CategoryGallery::all();
        View::share($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Gallery::image()->orderBy('id', 'desc')->paginate('10');
        return view('admin.gallery.image.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.image.create');
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
            'category_gallery_id' => 'required',
            'description' => 'required'
        ]);

        $category = CategoryGallery::find($request->category_gallery_id);

        if ($category) {
            $path = $request->file('image')->store('gallery');

            if ($category->galleries()->create($request->only('title', 'description') + ['url' => $path])) {
                return redirect()->route('admin.gallery.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            }
            return redirect()->route('admin.gallery.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
        } else {
            return redirect()->route('admin.gallery.create')->with(['status' => 'danger', 'message' => 'Category not Found']);
        }
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
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.image.edit', ['model' => $gallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category_gallery_id' => 'required',
            'description' => 'required'
        ]);

        $category = CategoryGallery::find($request->category_gallery_id);

        if ($category) {
            $gallery->CategoryGallery()->associate($category);
            if ($request->hasFile('image')) {

                if (Storage::exists($gallery->url)) {
                    Storage::delete($gallery->url);
                }

                $path = $request->file('image')->store('gallery');
                $update = $gallery->update($request->only('title', 'description') + ['url' => $path]);
            } else {
                $update = $gallery->update($request->only('title', 'description'));
            }
        } else {
            return redirect()->route('admin.gallery.edit', $gallery->id)->with(['status' => 'success', 'message' => 'Category not Found']);
        }

        if ($update) {
            return redirect()->route('admin.gallery.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        } else {
            return redirect()->route('admin.gallery.edit', $gallery->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Gallery $gallery)
    {
        if (Storage::exists($gallery->url)) {
            Storage::delete($gallery->url);
        }

        if ($gallery->delete()) {
            return redirect()->route('admin.gallery.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.gallery.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
