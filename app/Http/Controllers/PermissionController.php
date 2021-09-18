<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Permission::class);
        return Inertia::render('Admin/Permissions/Index');
    }

    public function getPermissions(Request $request)
    {
        //$this->authorize('viewAny', Permission::class);
        if ($request->ajax()) {
            $model = Permission::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($permission) {
                return $permission->updated_at->format('d/m/Y H:i');
            })
            ->toJson();
        }
    }
}
