<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use Illuminate\Http\Request;
use App\Models\Type;
use Inertia\Inertia;
use DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Types/Index');
    }

    public function getTypes(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Type::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($type) {
                return $type->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($type) {
                return $type->updated_at->format('d/m/Y H:i');
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
    public function store(TypeRequest $request)
    {
        Type::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Tipo de persona registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return $type;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Tipo de persona modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Tipo de persona inhabilitado correctamente',
        ]);
    }

    public function restore(Type $type)
    {
        $type->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Tipo de persona habilitado correctamente',
        ]);
    }
}
