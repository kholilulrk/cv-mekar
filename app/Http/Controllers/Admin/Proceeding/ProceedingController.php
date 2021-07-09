<?php

namespace App\Http\Controllers\Admin\Proceeding;

use App\Models\CategoryArticle;
use App\Models\Proceeding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProceedingController extends Controller
{
    /**
     * @var Proceeding $proceeding
     */
    protected $proceeding;

    /**
     * ProceedingController constructor.
     */
    public function __construct()
    {
        $this->proceeding = new Proceeding();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Proceeding::latest()->paginate(10);
        return view('admin.proceeding.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = CategoryArticle::all();
        return view('admin.proceeding.create', $data);
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
            'category_article_id' => 'required|exists:category_articles,id',
            'file' => 'required|file|mimes:pdf,doc,docx'
        ]);

        $path = $request->file('file')->store('proceeding');
        if ($this->proceeding->create($request->except('file') + ['url' => $path])) {
            return redirect()->route('admin.proceeding.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.proceeding.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param Proceeding $proceeding
     * @return \Illuminate\Http\Response
     */
    public function show(Proceeding $proceeding)
    {
        return response()->file(storage_path($proceeding->showFile()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proceeding  $proceeding
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceeding $proceeding)
    {
        $data['categories'] = CategoryArticle::all();
        $data['model'] = $proceeding;
        return view('admin.proceeding.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proceeding  $proceeding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proceeding $proceeding)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category_article_id' => 'required|exists:category_articles,id',
            'file' => 'file|mimes:pdf,doc,docx'
        ]);

        if ($request->hasFile('file')) {

            if (Storage::exists($proceeding->url)) {
                Storage::delete($proceeding->url);
            }

            $path = $request->file('file')->store('proceeding');
            $update = $proceeding->update($request->except('file') + ['url' => $path]);
        } else {
            $update = $proceeding->update($request->except('file'));
        }

        if ($update) {
            return redirect()->route('admin.proceeding.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.proceeding.edit', $proceeding->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proceeding $proceeding
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Proceeding $proceeding)
    {
        if (Storage::exists($proceeding->url)) {
            Storage::delete($proceeding->url);
        }

        if ($proceeding->delete()) {
            return redirect()->route('admin.proceeding.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.proceeding.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
