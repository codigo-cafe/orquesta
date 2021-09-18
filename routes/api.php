<?php

use App\Models\Category;
use App\Models\Classification;
use App\Models\Instrument;
use App\Models\Member;
use App\Models\Person;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*

Route::get('categories', function(DataTables $dataTables) {
    $model = Category::query();

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($category) {
            return $category->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($category) {
            return $category->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('classifications', function(DataTables $dataTables) {
    $model = Classification::query();

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($classification) {
            return $classification->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($classification) {
            return $classification->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('instruments', function(DataTables $dataTables) {
    $model = Instrument::query()->with('classification');

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($instrument) {
            return $instrument->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($instrument) {
            return $instrument->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('types', function(DataTables $dataTables) {
    $model = Type::query();

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($type) {
            return $type->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($type) {
            return $type->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('people', function(DataTables $dataTables) {
    $model = Person::query()->with('type', 'phones', 'address');

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($person) {
            return $person->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($person) {
            return $person->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('members', function(DataTables $dataTables) {
    $model = Person::query()->whereHas('member')->with('phones', 'address', 'member.instrument');

    return $dataTables->eloquent($model)
        ->editColumn('member.created_at', function ($person) {
            return $person->member->created_at->format('d/m/Y H:i');
        })
        ->editColumn('member.updated_at', function ($person) {
            return $person->member->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('services', function(DataTables $dataTables) {
    $model = Service::query();

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($service) {
            return $service->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($service) {
            return $service->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});

Route::get('promotions', function(DataTables $dataTables) {
    $model = Promotion::query();

    return $dataTables->eloquent($model)
        ->editColumn('created_at', function ($promotion) {
            return $promotion->created_at->format('d/m/Y H:i');
        })
        ->editColumn('updated_at', function ($promotion) {
            return $promotion->updated_at->format('d/m/Y H:i');
        })
        ->toJson();
});
*/