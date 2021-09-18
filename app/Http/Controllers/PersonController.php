<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Person;
use App\Models\Phone;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use DataTables;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/People/Index', [
            'types' => Type::where('status', 1)->get(),
        ]);
    }

    public function getPeople(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Person::query()->with('type', 'phones', 'address');
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($person) {
                return $person->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($person) {
                return $person->updated_at->format('d/m/Y H:i');
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
    public function store(PersonRequest $request)
    {
        $data = $request->all();
        if ($request->profile_photo_path != null)
        {
            $url = 'people/'.md5(microtime()).'.jpg';

            $resized_image = Image::make($request->profile_photo_path)->widen(500)->limitColors(255)->stream('jpg', 100);
            Storage::put('public/'.$url, $resized_image);

            $data['profile_photo_path'] = Storage::url($url);
        } else {
            $data['profile_photo_path'] = null;
        }

        $person = Person::create($data);
        Phone::create([
            'number' => $request->phone,
            'person_id' => $person->id,
        ]);
        Address::create([
            'neighborhood' => $request->neighborhood,
            'streets' => $request->streets,
            'number' => $request->number,
            'person_id' => $person->id,
        ]);
        return response()->json([
            'type' => 'success',
            'message' => 'Persona registrada correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return $person->load('phones', 'address');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        $data = $request->all();
        if ($request->profile_photo_path != null) {
            $photoPath = str_replace('storage', 'public', $person->profile_photo_path);
            Storage::delete($photoPath);

            $url = 'people/'.md5(microtime()).'.jpg';

            $resized_image = Image::make($request->profile_photo_path)->widen(500)->limitColors(255)->stream('jpg', 100);
            Storage::put('public/'.$url, $resized_image);

            $data['profile_photo_path'] = Storage::url($url);
        } else {
            $data['profile_photo_path'] = $person->profile_photo_path;
        }
        $person->update($data);
        $phone = Phone::where('person_id', $person->id);
        $phone->update([
            'number' => $request->phone,
        ]);
        $address = Address::where('person_id', $person->id);
        $address->update([
            'neighborhood' => $request->neighborhood,
            'streets' => $request->streets,
            'number' => $request->number,
        ]);
        return response()->json([
            'type' => 'success',
            'message' => 'Persona modificada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Persona inhabilitada correctamente',
        ]);
    }

    public function restore(Person $person)
    {
        $person->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Persona habilitada correctamente',
        ]);
    }
}
