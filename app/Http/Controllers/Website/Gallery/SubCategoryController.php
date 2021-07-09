<?php

namespace App\Http\Controllers\Website\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryGallery;
use App\Models\Gallery;
use Illuminate\Support\Facades\View;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'SubGallery');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $gallery['category_gallery'] = CategoryGallery::where('slug', $slug)->first();

        if ($gallery['category_gallery']) {
            $gallery['sub_gallery'] = Gallery::where('category_gallery_id', $gallery['category_gallery']->id)->get();
            return view('website.gallery.sub_gallery.index', $gallery);
        }
        return redirect()->route('landing.index');
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
