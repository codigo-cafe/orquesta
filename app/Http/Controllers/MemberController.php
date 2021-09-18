<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Instrument;
use App\Models\Member;
use App\Models\Orchestra;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Members/Index', [
            'instruments' => Instrument::where('status', 1)->get(),
        ]);
    }

    public function getMembers(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Person::query()->whereHas('member')->with('phones', 'address', 'member.instrument');
            return DataTables::eloquent($model)
            ->editColumn('member.created_at', function ($person) {
                return $person->member->created_at->format('d/m/Y H:i');
            })
            ->editColumn('member.updated_at', function ($person) {
                return $person->member->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('can', function ($user) use($can) {
                return json_decode($can, true);
            })
            ->toJson();
        }
    }

    public function create()
    {
        return Person::whereDoesntHave('member')->with('phones', 'address')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        Member::create([
            'orchestra_id' => Orchestra::first()->id,
            'person_id' => $request->person_id,
            'instrument_id' => $request->instrument_id,
        ]);
        return response()->json([
            'type' => 'success',
            'message' => 'Integrante registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return response()->json([
            'member' => $member->load('person', 'person.phones', 'person.address'),
            'people' => Person::whereDoesntHave('member')->orWhere('id', $member->person_id)->with('phones', 'address')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Integrante modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Integrante inhabilitado correctamente',
        ]);
    }

    public function restore(Person $person)
    {
        $person->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Integrante habilitado correctamente',
        ]);
    }
}
