<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Orchestra;
use App\Models\Person;
use App\Models\Point;
use App\Models\Promotion;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

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
        $eventList = Event::get(['id', 'name as title', 'date', 'status', 'slug']);
        foreach($eventList as $event) {
            if ($event->status) {
                $event->classNames = 'bg-gradient-success border-success shadow';
            } else {
                $event->classNames = 'bg-gradient-warning border-warning shadow';
            }
        }
        return response()->json(["events" => $eventList]);
    }

    public function getEventsCalendar(Request $request)
    {
        $eventList = Event::where('status', true)->get(['id', 'name as title', 'date', 'start_time', 'end_time', 'slug', 'place', 'cover']);
        foreach($eventList as $event) {
            $event->classNames = 'shadow';
        }
        return response()->json(["events" => $eventList]);
    }

    public function getEventsDTReport(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Event::query()->with('category');
            return DataTables::eloquent($model)
            ->editColumn('date', function ($event) {
                $fecha = Carbon::parse($event->date)->format('d/m/Y');
                return $fecha;
            })
            ->addColumn('can', function ($user) use($can) {
                return json_decode($can, true);
            })
            ->toJson();
        }
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

    public function view(Event $event)
    {
        $fecha = Carbon::parse($event->date);
        $anterior = Event::where('date', Event::where('date', '<', $event->date)->where('status', true)->max('date'))->first();
        $posterior = Event::where('date', Event::where('date', '>', $event->date)->where('status', true)->min('date'))->first();
        if ($anterior) {
            $anterior->date = Carbon::parse($anterior->date)->isoFormat('dddd') . ' ' . Carbon::parse($anterior->date)->format('d') . ' de ' . Carbon::parse($anterior->date)->isoFormat('MMMM');
        }
        if ($posterior) {
            $posterior->date = Carbon::parse($posterior->date)->isoFormat('dddd') . ' ' . Carbon::parse($posterior->date)->format('d') . ' de ' . Carbon::parse($posterior->date)->isoFormat('MMMM');
        }

        if ($event) {
            $info = $event->load('people.phones', 'points', 'promotion', 'category');
            $info->date = $fecha->isoFormat('dddd') . ' ' . $fecha->format('d') . ' de ' . $fecha->isoFormat('MMMM') . ' de ' . $fecha->format('Y');

            return Inertia::render('Client/Event', [
                'orchestra' => Orchestra::first(),
                'event' => $info,
                'anterior' => $anterior,
                'posterior' => $posterior,
            ]);
        } else {
            abort(404);
        }
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
        if (isset($data['cover']))
        {
            $coverPath = str_replace('storage/covers', 'public/covers', $event->cover);
            Storage::delete($coverPath);

            $url = 'covers/'.md5(microtime()).'.jpg';

            $resized_image = Image::make($request->cover)->widen(720)->limitColors(255)->stream('jpg', 100);
            Storage::put('public/'.$url, $resized_image);
            $data['cover'] = Storage::url($url);
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
