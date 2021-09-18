<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Role::class);
        return Inertia::render('Admin/Roles/Index', [
            'permissions' => Permission::all()->sortBy('id'),
        ]);
    }

    public function getRoles(Request $request)
    {
        //$this->authorize('viewAny', Role::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Role::with('permissions');
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($role) {
                return $role->updated_at->format('d/m/Y H:i');
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
    public function store(RoleRequest $request)
    {
        //$this->authorize('create', Role::class);
        $role = Role::create($request->all());
        $role->givePermissionTo($request->permissions);
        return response()->json([
            'type' => 'success',
            'message' => 'Rol registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //$this->authorize('update', [Role::class, $role]);
        return $role->load('permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        //$this->authorize('update', [Role::class, $role]);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        return response()->json([
            'type' => 'success',
            'message' => 'Rol modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //$this->authorize('delete', [Role::class, $role]);
        $role->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Rol inhabilitado correctamente',
        ]);
    }

    public function restore(Role $role)
    {
        //$this->authorize('restore', [Role::class, $role]);
        $role->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Rol habilitado correctamente',
        ]);
    }
}
