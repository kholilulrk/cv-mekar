<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\CategoryGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryGalleryController extends Controller
{
    /**
     * @var CategoryGallery $categoryGallery
     */
    protected $categoryGallery;

    /**
     * VideoController constructor.
     */
    public function __construct()
    {
        $this->categoryGallery = new CategoryGallery();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = CategoryGallery::latest()->paginate(10);
        return view('admin.gallery.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.category.create');
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
            'description' => 'required'
        ]);
        
        $path = $request->file('image')->store('category_gallery');

        if ($this->categoryGallery->create($request->only('name', 'description') + ['url' => $path])) {
            return redirect()->route('admin.category_gallery.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.category_gallery.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  CategoryGallery  $category_gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryGallery $category_gallery)
    {
        return view('admin.gallery.category.edit', ['model' => $category_gallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CategoryGallery  $category_gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryGallery $category_gallery)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required'
        ]);
        if ($request->hasFile('image')) {

            if (Storage::exists($category_gallery->url)) {
                Storage::delete($category_gallery->url);
            }

            $path = $request->file('image')->store('category_gallery');
            $update = $category_gallery->update($request->only('name', 'description') + ['url' => $path]);
            return redirect()->route('admin.category_gallery.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }
        // if ($category_gallery->update($request->all())) {
        //     return redirect()->route('admin.category_gallery.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        // }
        else {
            $update = $category_gallery->update($request->all());
            return redirect()->route('admin.category_gallery.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }
        return redirect()->route('admin.category_gallery.edit', $category_gallery->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryGallery $category_gallery
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CategoryGallery $category_gallery)
    {
        $category_gallery->galleries()->update(['category_gallery_id' => null]);
        if ($category_gallery->delete()) {
            return redirect()->route('admin.category_gallery.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.category_gallery.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
