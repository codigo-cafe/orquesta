<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Person;
use App\Models\Point;
use App\Models\Promotion;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Category::class);
        return Inertia::render('Admin/Events/Index', [
            'categories' => Category::all(),
            'promotions' => Promotion::all(),
            'points' => Point::all(),
            'people' => Person::with('phones')->get(),
        ]);
    }

    public function getEvents(Request $request)
    {
        $eventList = Event::get(['id', 'name as title','date']);
        return response()->json(["events" => $eventList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //$this->authorize('create', Event::class);
        $data = $request->all();
        if ($request->hasFile('cover'))
        {
            $file = $request->cover->store('public/covers');
            // correct the date format
            $image = Image::make(Storage::get($file))
                ->widen(600)
                ->limitColors(255)
                ->encode();

            Storage::put($file, (string) $image);
            $data['cover'] = Storage::url($file);
        }
        $data['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data['start_time'] = Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s');
        $data['end_time'] = Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s');
        $event = Event::create($data);
        $event->people()->attach(explode(',', $request->people));
        $event->points()->attach(explode(',', $request->points));
        return response()->json([
            'type' => 'success',
            'message' => 'Evento registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
