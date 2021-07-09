<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\CategoryArticle;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ExhibitionController extends Controller
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
        $data['categories'] = CategoryArticle::all();
        View::share($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Gallery::exhibition()->orderBy('id', 'desc')->paginate('10');
        return view('admin.gallery.exhibition.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.exhibition.create');
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
            'category_article_id' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $category = CategoryArticle::find($request->category_article_id);

        if ($category) {
            $path = $request->file('image')->store('gallery');

            if ($category->galleries()->create($request->only('title', 'description', 'type') + ['url' => $path])) {
                return redirect()->route('admin.exhibition.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            }
            return redirect()->route('admin.exhibition.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
        } else {
            return redirect()->route('admin.exhibition.create')->with(['status' => 'danger', 'message' => 'Category not Found']);
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
     * @param  Gallery  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $exhibition)
    {
        return view('admin.gallery.exhibition.edit', ['model' => $exhibition]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gallery  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $exhibition)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category_article_id' => 'required',
            'description' => 'required',
            'image' => 'image'
        ]);

        $category = CategoryArticle::find($request->category_article_id);

        if ($category) {
            $exhibition->categoryArticle()->associate($category);
            if ($request->hasFile('image')) {

                if (Storage::exists($exhibition->url)) {
                    Storage::delete($exhibition->url);
                }

                $path = $request->file('image')->store('gallery');
                $update = $exhibition->update($request->only('title', 'description', 'type') + ['url' => $path]);
            } else {
                $update = $exhibition->update($request->only('title', 'description'));
            }
        } else {
            return redirect()->route('admin.exhibition.edit', $exhibition->id)->with(['status' => 'success', 'message' => 'Category not Found']);
        }

        if ($update) {
            return redirect()->route('admin.exhibition.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        } else {
            return redirect()->route('admin.exhibition.edit', $exhibition->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $exhibition
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Gallery $exhibition)
    {
        if (Storage::exists($exhibition->url)) {
            Storage::delete($exhibition->url);
        }

        if ($exhibition->delete()) {
            return redirect()->route('admin.exhibition.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.exhibition.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
