<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Inertia\Inertia;
use Carbon\Carbon;
use DataTables;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Promotions/Index');
    }

    public function getPromotions(Request $request)
    {
        //$this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Promotion::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($promotion) {
                return $promotion->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($promotion) {
                return $promotion->updated_at->format('d/m/Y H:i');
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
    public function store(PromotionRequest $request)
    {
        $data = $request->all();
        $data['date_start'] = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date_start)->format('Y-m-d');
        $data['date_end'] = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date_end)->format('Y-m-d');
        Promotion::create($data);
        return response()->json([
            'type' => 'success',
            'message' => 'Promoción registrada correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return $promotion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionRequest $request, Promotion $promotion)
    {
        $data = $request->all();
        $data['date_start'] = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date_start)->format('Y-m-d');
        $data['date_end'] = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $request->date_end)->format('Y-m-d');
        $promotion->update($data);
        return response()->json([
            'type' => 'success',
            'message' => 'Promoción modificada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Promoción inhabilitada correctamente',
        ]);
    }

    public function restore(Promotion $promotion)
    {
        $promotion->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Promoción habilitada correctamente',
        ]);
    }
}
