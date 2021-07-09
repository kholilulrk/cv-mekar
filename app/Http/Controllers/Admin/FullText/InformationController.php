<?php

namespace App\Http\Controllers\Admin\FullText;

use App\Models\FullText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data['model'] = FullText::find($id);
        return view('admin.full_text.information', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param FullText $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FullText $full_text)
    {
        $request->validate([
            'description' => 'required'
        ]);

        if (strip_tags($request->description) == null) {
            $request->flash();
            return redirect()->route('admin.full_text.edit', $full_text->id)->with(['status' => 'danger', 'message' => 'The description field is required.']);
        }

        if ($full_text->update($request->all())) {
            return redirect()->route('admin.abstraction.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.full_text.edit', $full_text->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
