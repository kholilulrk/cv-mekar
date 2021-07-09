<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\CategoryArticle;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class VideoController extends Controller
{
    /**
     * @var Gallery $gallery
     */
    protected $gallery;

    /**
     * VideoController constructor.
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
        $data['models'] = $this->gallery->video()->orderBy('id', 'desc')->paginate(10);
        return view('admin.gallery.video.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.video.create');
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
            'url' => 'required|active_url'
        ]);

        $category = CategoryArticle::find($request->category_article_id);

        if ($category) {
            if ($category->galleries()->create($request->all())) {
                return redirect()->route('admin.gallery_video.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            }
            return redirect()->route('admin.gallery_video.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
        } else {
            return redirect()->route('admin.gallery_video.create')->with(['status' => 'danger', 'message' => 'Category not Found']);
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
     * @param  Gallery  $gallery_video
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery_video)
    {
        return view('admin.gallery.video.edit', ['model' => $gallery_video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gallery  $gallery_video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery_video)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category_article_id' => 'required',
            'description' => 'required',
            'url' => 'required|active_url'
        ]);

        $category = CategoryArticle::find($request->category_article_id);

        if ($category) {
            $gallery_video->categoryArticle()->associate($category);

            if ($gallery_video->update($request->all())) {
                return redirect()->route('admin.gallery_video.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
            }
            return redirect()->route('admin.gallery_video.edit', $gallery_video->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
        }else {
            return redirect()->route('admin.gallery_video.edit', $gallery_video->id)->with(['status' => 'danger', 'message' => 'Category not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery_video
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Gallery $gallery_video)
    {
        if ($gallery_video->delete()) {
            return redirect()->route('admin.gallery_video.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.gallery_video.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
