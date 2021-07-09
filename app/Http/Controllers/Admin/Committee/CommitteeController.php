<?php

namespace App\Http\Controllers\Admin\Committee;

use App\Models\Committee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitteeController extends Controller
{
    /**
     * @var Committee $committee
     */
    protected $committee;

    /**
     * CommitteeController constructor.
     */
    public function __construct()
    {
        $this->committee = new Committee();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Committee::latest()->paginate(10);
        return view('admin.committee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.committee.create');
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
            return redirect()->route('admin.committee.create')->with(['status' => 'danger', 'message' => 'The description field is required.']);
        }

        if ($this->committee->create($request->all())) {
            return redirect()->route('admin.committee.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.committee.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function edit(Committee $committee)
    {
        return view('admin.committee.edit', ['model' => $committee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required'
        ]);

        if (strip_tags($request->description) == null) {
            $request->flash();
            return redirect()->route('admin.committee.edit', $committee->id)->with(['status' => 'danger', 'message' => 'The description field is required.']);
        }

        if ($committee->update($request->all())) {
            return redirect()->route('admin.committee.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.committee.edit', $committee->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Committee $committee
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Committee $committee)
    {
        if ($committee->delete()) {
            return redirect()->route('admin.committee.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.committee.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
