<?php

namespace App\Http\Controllers\Website\Event;

use App\Models\CategoryArticle;
use App\Models\SubCategory;
use App\Models\Article;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'Article');
        View::share('categoryArticle', CategoryArticle::where('is_ongoing', 1)->first());
    }

    /**
     * Display a listing of the resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $category = SubCategory::where('slug', $slug)->first();
        $data['category'] = $category;
        $data['models'] = Article::where('sub_category_id', $category->id)->paginate(3);
        return view('website.event.index', $data);
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['model'] = Article::where('slug', $slug)->first();

        $data['meta'] = Setting::find(1);
        $data['meta']->short_description = str_limit(strip_tags($data['model']->description), 100, ' ...');
        $data['meta']->ogimage = $data['model']->showimage();

        $data['menu'] = $data['model']->title;
        return view('website.event.show', $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
