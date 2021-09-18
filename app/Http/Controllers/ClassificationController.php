<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassificationRequest;
use Illuminate\Http\Request;
use App\Models\Classification;
use Inertia\Inertia;
use DataTables;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Classifications/Index');
    }

    public function getClassifications(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Classification::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($classification) {
                return $classification->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($classification) {
                return $classification->updated_at->format('d/m/Y H:i');
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
    public function store(ClassificationRequest $request)
    {
        Classification::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Clasificación registrada correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function edit(Classification $classification)
    {
        return $classification;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function update(ClassificationRequest $request, Classification $classification)
    {
        $classification->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Clasificación modificada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classification $classification)
    {
        $classification->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Clasificación inhabilitada correctamente',
        ]);
    }

    public function restore(Classification $classification)
    {
        $classification->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Clasificación habilitada correctamente',
        ]);
    }
}
