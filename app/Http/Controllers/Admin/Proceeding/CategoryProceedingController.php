<?php

namespace App\Http\Controllers\Admin\Proceeding;

use App\Models\CategoryProceeding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProceedingController extends Controller
{
    /**
     * @var CategoryProceeding $categoryProceeding
     */
    protected $categoryProceeding;

    /**
     * CategoryProceedingController constructor.
     */
    public function __construct()
    {
        $this->categoryProceeding = new CategoryProceeding();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = CategoryProceeding::latest()->paginate(10);
        return view('admin.proceeding.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proceeding.category.create');
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
            'description' => 'required',
        ]);
        if ($this->categoryProceeding->create($request->all())) {
            return redirect()->route('admin.category_proceeding.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.category_proceeding.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  CategoryProceeding  $category_proceeding
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProceeding $category_proceeding)
    {
        return view('admin.proceeding.category.edit', ['model' => $category_proceeding]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CategoryProceeding  $category_proceeding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProceeding $category_proceeding)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
        ]);
        if ($category_proceeding->update($request->all())) {
            return redirect()->route('admin.category_proceeding.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }
        return redirect()->route('admin.category_proceeding.edit', $category_proceeding->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryProceeding $category_proceeding
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CategoryProceeding $category_proceeding)
    {
        $category_proceeding->proceedings()->update(['category_proceeding_id' => null]);
        if ($category_proceeding->delete()) {
            return redirect()->route('admin.category_proceeding.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.category_proceeding.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
