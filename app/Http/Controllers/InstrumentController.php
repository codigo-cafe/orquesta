<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstrumentRequest;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Instrument;
use Inertia\Inertia;
use DataTables;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Instruments/Index', [
            'classifications' => Classification::all(),
        ]);
    }

    public function getInstruments(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Instrument::query()->with('classification');
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($instrument) {
                return $instrument->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($instrument) {
                return $instrument->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('can', function ($user) use($can) {
                return json_decode($can, true);
            })
            ->toJson();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstrumentRequest $request)
    {
        Instrument::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Instrumento registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrument $instrument)
    {
        return $instrument->load('classification');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function update(InstrumentRequest $request, Instrument $instrument)
    {
        $instrument->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Instrumento modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument)
    {
        $instrument->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Instrumento inhabilitado correctamente',
        ]);
    }

    public function restore(Instrument $instrument)
    {
        $instrument->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Instrumento habilitado correctamente',
        ]);
    }
}
