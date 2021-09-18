<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointRequest;
use App\Models\Point;
use DataTables;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Category::class);
        return Inertia::render('Admin/Points/Index');
    }

    public function getPoints(Request $request)
    {
        //$this->authorize('viewAny', Point::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Point::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($point) {
                return $point->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($point) {
                return $point->updated_at->format('d/m/Y H:i');
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
    public function store(PointRequest $request)
    {
        //$this->authorize('create', Category::class);
        Point::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Punto de Venta registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //$this->authorize('update', [Category::class, $category]);
        return $point;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(PointRequest $request, Point $point)
    {
        //$this->authorize('update', [Category::class, $category]);
        $point->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Punto de Venta modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        //$this->authorize('delete', [Category::class, $category]);
        $point->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Punto de Venta inhabilitado correctamente',
        ]);
    }

    public function restore(Point $point)
    {
        //$this->authorize('restore', [Point::class, $point]);
        $point->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Punto de Venta habilitado correctamente',
        ]);
    }
}
