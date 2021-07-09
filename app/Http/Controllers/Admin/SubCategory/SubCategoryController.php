<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Models\CategoryArticle;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use function MongoDB\BSON\toJSON;

class SubCategoryController extends Controller
{
    /**
     * @var SubCategory $subCategory
     */
    protected $subCategory;

    /**
     * SubCategoryController constructor.
     */
    public function __construct()
    {
        $this->subCategory = new SubCategory();
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
        $data['models'] = SubCategory::latest()->paginate(10);
        return view('admin.sub_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sub_category.create');
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
            'category_article_id' => 'required|exists:category_articles,id',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $category = CategoryArticle::find($request->category_article_id);
        $path = $request->file('image')->store('sub_categories');

        if ($category) {
            if ($category->subCategories()->create($request->except('image') + ['image' => $path])) {
                return redirect()->route('admin.sub_category.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
            } else {
                return redirect()->route('admin.sub_category.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
            }
        } else {
            return redirect()->route('admin.sub_category.create')->with(['status' => 'danger', 'message' => 'Category not Found']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sub = SubCategory::where('category_article_id', $request->id)->get();

        if ($sub) {
            return response()->json(['success' => true, 'data' => $sub]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $sub_category)
    {
        return view('admin.sub_category.edit', ['model' => $sub_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $request->validate([
            'name' => 'required|max:200',
            'category_article_id' => 'required|exists:category_articles,id',
            'description' => 'required',
            'image' => 'image'
        ]);

        $category = CategoryArticle::find($request->category_article_id);

        if ($category) {
            $sub_category->categoryArticle()->associate($category);

            if ($request->hasFile('image')) {

                if (Storage::exists($sub_category->image)) {
                    Storage::delete($sub_category->image);
                }

                $path = $request->file('image')->store('sub_categories');
                $update = $sub_category->update($request->except('image') + ['image' => $path]);
            } else {
                $update = $sub_category->update($request->except('image'));
            }

            if ($update) {
                return redirect()->route('admin.sub_category.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
            } else {
                return redirect()->route('admin.sub_category.edit', $sub_category->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
            }
        } else {
            return redirect()->route('admin.sub_category.edit', $sub_category->id)->with(['status' => 'danger', 'message' => 'Category not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SubCategory $sub_category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(SubCategory $sub_category)
    {
        if (Storage::exists($sub_category->image)) {
            Storage::delete($sub_category->image);
        }

        if ($sub_category->delete()) {
            return redirect()->route('admin.sub_category.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.sub_category.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
