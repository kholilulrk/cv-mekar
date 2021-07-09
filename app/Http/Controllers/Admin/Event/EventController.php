<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\CategoryEvent;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * @var Event $event
     */
    protected $event;

    /**
     * EventController constructor.
     */
    public function __construct()
    {
        $this->event = new Event();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Event::orderBy('id', 'desc')->paginate(10);
        return view('admin.event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = CategoryEvent::all();
        return view('admin.event.create', $data);
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
            'category_event_id' => 'required|exists:category_events,id',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('event');
        if ($this->event->create($request->only('category_event_id', 'title', 'description') + ['image' => $path])) {
            return redirect()->route('admin.event.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.event.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
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
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $data['categories'] = CategoryEvent::all();
        $data['model'] = $event;
        return view('admin.event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category_event_id' => 'required|exists:category_events,id',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {

            if (Storage::exists($event->image)) {
                Storage::delete($event->image);
            }

            $path = $request->file('image')->store('event');
            $update = $event->update($request->only('category_event_id', 'title', 'description') + ['image' => $path]);
        } else {
            $update = $event->update($request->only('category_event_id', 'title', 'description'));
        }

        if ($update) {
            return redirect()->route('admin.event.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.event.edit', $event->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        if (Storage::exists($event->image)) {
            Storage::delete($event->image);
        }

        if ($event->delete()) {
            return redirect()->route('admin.event.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.event.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
