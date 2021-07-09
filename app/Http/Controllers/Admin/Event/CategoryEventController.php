<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\CategoryEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryEventController extends Controller
{
    /**
     * @var CategoryEvent $categoryEvent
     */
    protected $categoryEvent;

    /**
     * CategoryEventController constructor.
     */
    public function __construct()
    {
        $this->categoryEvent = new CategoryEvent();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = CategoryEvent::orderBy('id', 'desc')->paginate(10);
        return view('admin.event.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.category.create');
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
        if ($this->categoryEvent->create($request->all())) {
            return redirect()->route('admin.category_event.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.category_event.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  CategoryEvent  $category_event
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryEvent $category_event)
    {
        return view('admin.event.category.edit', ['model' => $category_event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CategoryEvent  $category_event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryEvent $category_event)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
        ]);
        if ($category_event->update($request->all())) {
            return redirect()->route('admin.category_event.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }
        return redirect()->route('admin.category_event.edit', $category_event->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryEvent $category_event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CategoryEvent $category_event)
    {
        if ($category_event->delete()) {
            return redirect()->route('admin.category_event.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.category_event.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
