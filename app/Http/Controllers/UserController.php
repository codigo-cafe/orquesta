<?php

namespace App\Http\Controllers;

use App\Events\UserWasCreated;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserManualRequest;
use App\Models\Person;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', User::class);
        return Inertia::render('Admin/Users/Index', [
            'roles' => Role::all(),
        ]);
    }

    public function getUsers(Request $request)
    {
        //$this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = User::with('person', 'roles');
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('can', function ($user) use($can) {
                return json_decode($can, true);
            })
            ->toJson();
        }
    }

    public function create()
    {
        return Person::whereDoesntHave('user')->with('phones', 'address')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //$this->authorize('create', User::class);
        $data = $request->all();
        $password_plain = User::generatePassword();
        $data['password'] = bcrypt($password_plain);

        $user = User::create($data);

        $user->assignRole($request->role_id);

        UserWasCreated::dispatch($user, $password_plain);

        return response()->json([
            'type' => 'success',
            'message' => 'Usuario registrado correctamente',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeManual(UserManualRequest $request)
    {
        //$this->authorize('create', User::class);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $user->assignRole($request->role_id);

        return response()->json([
            'type' => 'success',
            'message' => 'Usuario registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$this->authorize('update', [User::class, $user]);
        return $user->load('roles', 'person', 'person.phones', 'person.address');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
         //$this->authorize('update', [User::class, $user]);
        $user->update($request->except(['person_id']));
        $user->syncRoles($request->role_id);
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$this->authorize('enable', [User::class, $user]);
        $user->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario inhabilitado correctamente',
        ]);
    }

    public function restore(User $user)
    {
        //$this->authorize('disable', [User::class, $user]);
        $user->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario habilitado correctamente',
        ]);
    }
}
