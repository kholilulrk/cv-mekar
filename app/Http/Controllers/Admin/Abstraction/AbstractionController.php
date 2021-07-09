<?php

namespace App\Http\Controllers\Admin\Abstraction;

use App\Models\Abstraction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AbstractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Abstraction::latest()->where('id', '<>', 0)->where('id', '<>', 1)->orderBy('status', 'desc')->paginate(10);
        return view('admin.abstraction.index', $data);
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
     * @param Abstraction $abstraction
     * @return \Illuminate\Http\Response
     */
    public function show(Abstraction $abstraction)
    {
        return response()->file(storage_path($abstraction->showFile()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Abstraction $abstraction
     * @return \Illuminate\Http\Response
     */
    public function edit(Abstraction $abstraction)
    {
        return view('admin.abstraction.edit', ['model' => $abstraction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abstraction $abstraction)
    {
        $abstraction->status = $request->status;

        if ($abstraction->save()) {
            return redirect()->route('admin.abstraction.index')->with(['status' => 'success', 'message' => 'Approve Successfully']);
        }
        return redirect()->route('admin.abstraction.index')->with(['status' => 'danger', 'message' => 'Reply Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Abstraction $abstraction
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Abstraction $abstraction)
    {
        if (Storage::exists($abstraction->url)) {
            Storage::delete($abstraction->url);
        }

        foreach ($abstraction->fullTexts as $fullText) {
            if (Storage::exists($fullText->url)) {
                Storage::delete($fullText->url);
            }
            $fullText->delete();
        }

        if ($abstraction->delete()) {
            return redirect()->route('admin.abstraction.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.abstraction.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
