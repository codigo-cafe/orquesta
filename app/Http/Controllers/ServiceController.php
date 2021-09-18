<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Service;
use Inertia\Inertia;
use DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Services/Index');
    }

    public function getServices(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Service::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($service) {
                return $service->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($service) {
                return $service->updated_at->format('d/m/Y H:i');
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
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Servicio registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Servicio modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Servicio inhabilitado correctamente',
        ]);
    }

    public function restore(Service $service)
    {
        $service->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Servicio habilitado correctamente',
        ]);
    }
}
