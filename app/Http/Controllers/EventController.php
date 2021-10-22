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
        $eventList = Event::get(['id', 'name as title', 'date as start', 'date as end', 'status']);
        foreach($eventList as $event) {
            if ($event->status) {
                $event->classNames = 'bg-gradient-success border-success shadow';
            } else {
                $event->classNames = 'bg-gradient-warning border-warning shadow';
            }
        }
        return response()->json(["events" => $eventList]);
    }

    public function show(Event $event)
    {
        $info = $event->load('user.person');

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($event->date);
        $mes = $meses[($fecha->format('n')) - 1];

        $info->date = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        $info->start_time = Carbon::parse($event->start_time)->format('H:i');
        $info->end_time = Carbon::parse($event->end_time)->format('H:i');
        return $info;
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
        $info = $event->load('people.phones', 'people.address', 'points');
        $info->date = Carbon::parse($info->date)->format('d/m/Y');
        return $info;
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
        $data = $request->all();
        if ($request->hasFile('cover'))
        {
            $coverPath = str_replace('storage/covers', 'public/covers', $event->cover);
            Storage::delete($coverPath);

            $file = $request->cover->store('public/covers');
            // correct the date format
            $image = Image::make(Storage::get($file))
                ->widen(600)
                ->limitColors(255)
                ->encode();

            Storage::put($file, (string) $image);
            $data['cover'] = Storage::url($file);
        } else {
            $data['cover'] = $event->cover;
        }
        $data['date'] = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date)->format('Y-m-d');
        $data['start_time'] = Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s');
        $data['end_time'] = Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s');
        $event->update($data);
        $event->people()->detach();
        $event->people()->attach($request->people);
        $event->points()->detach();
        $event->points()->attach($request->points);
        return response()->json([
            'type' => 'success',
            'message' => 'Evento modificado correctamente',
        ]);
    }

    public function move(Request $request, Event $event)
    {
        //$this->authorize('restore', [Event::class, $event]);
        $request->date = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date)->format('Y-m-d');
        $event->update(['date' => $request->date]);
        return response()->json([
            'type' => 'success',
            'message' => 'Evento modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //$this->authorize('delete', [Event::class, $event]);
        $event->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Evento inhabilitado correctamente',
            'event' => $event->load('user.person'),
        ]);
    }

    public function restore(Event $event)
    {
        //$this->authorize('restore', [Event::class, $event]);
        $event->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Evento habilitado correctamente',
            'event' => $event->load('user.person'),
        ]);
    }
}
