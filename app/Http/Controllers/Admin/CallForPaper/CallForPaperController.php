<?php

namespace App\Http\Controllers\Admin\CallForPaper;

use App\Models\CallForPaper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallForPaperController extends Controller
{
    /**
     * @var CallForPaper $call_for_paper
     */
    protected $call_for_paper;

    /**
     * CallForPaperController constructor.
     */
    public function __construct()
    {
        $this->call_for_paper = new CallForPaper();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = CallForPaper::latest()->paginate(10);
        return view('admin.call_for_paper.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.call_for_paper.create');
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
            'description' => 'required'
        ]);

        if (strip_tags($request->description) == null) {
            $request->flash();
            return redirect()->route('admin.call_for_paper.create')->with(['status' => 'danger', 'message' => 'The description field is required.']);
        }

        if ($this->call_for_paper->create($request->all())) {
            return redirect()->route('admin.call_for_paper.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.call_for_paper.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param CallForPaper $call_for_paper
     * @return \Illuminate\Http\Response
     */
    public function edit(CallForPaper $call_for_paper)
    {
        return view('admin.call_for_paper.edit', ['model' => $call_for_paper]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CallForPaper $call_for_paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallForPaper $call_for_paper)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required'
        ]);

        if (strip_tags($request->description) == null) {
            $request->flash();
            return redirect()->route('admin.call_for_paper.edit', $call_for_paper->id)->with(['status' => 'danger', 'message' => 'The description field is required.']);
        }

        if ($call_for_paper->update($request->all())) {
            return redirect()->route('admin.call_for_paper.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.call_for_paper.edit', $call_for_paper->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CallForPaper $call_for_paper
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CallForPaper $call_for_paper)
    {
        if ($call_for_paper->delete()) {
            return redirect()->route('admin.call_for_paper.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.call_for_paper.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
