<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrchestraController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Mail\LoginCredentials;
use App\Models\Orchestra;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('email', function(){
    return new LoginCredentials(User::first(), 'password123');
});
*/

Route::get('/', function () {
    return Inertia::render('Client/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'orchestra' => Orchestra::first(),
    ]);
})->name('home');

Route::get('/galeria', function () {
    return Inertia::render('Client/Gallery', [
        'orchestra' => Orchestra::first(),
    ]);
})->name('gallery');

//LISTA DE RUTAS DATATABLES
Route::middleware(['auth:sanctum', 'verified', 'verify_status', 'verify_route'])->group(function () {
    Route::get('categories/list', [CategoryController::class, 'getCategories'])->name('categories.list');
    Route::get('classifications/list', [ClassificationController::class, 'getClassifications'])->name('classifications.list');
    Route::get('instruments/list', [InstrumentController::class, 'getInstruments'])->name('instruments.list');
    Route::get('members/list', [MemberController::class, 'getMembers'])->name('members.list');
    Route::get('people/list', [PersonController::class, 'getPeople'])->name('people.list');
    Route::get('promotions/list', [PromotionController::class, 'getPromotions'])->name('promotions.list');
    Route::get('services/list', [ServiceController::class, 'getServices'])->name('services.list');
    Route::get('types/list', [TypeController::class, 'getTypes'])->name('types.list');
    Route::get('events/list', [EventController::class, 'getEvents'])->name('events.list');
    Route::get('points/list', [PointController::class, 'getPoints'])->name('points.list');
    Route::get('users/list', [UserController::class, 'getUsers'])->name('users.list');
    Route::get('roles/list', [RoleController::class, 'getRoles'])->name('roles.list');
    Route::get('permissions/list', [PermissionController::class, 'getPermissions'])->name('permissions.list');
});

Route::middleware(['auth:sanctum', 'verified', 'verify_status'])->group(function () {
    Route::resource('orchestra', OrchestraController::class)->except(['edit', 'store', 'show', 'create', 'destroy'])->names([
        'index' => 'orchestra.index',
        'update' => 'orchestra.update',
    ]);

    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'categories.index',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
    ]);
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::put('categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::resource('events', EventController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'events.index',
        'store' => 'events.store',
        'edit' => 'events.edit',
        'update' => 'events.update',
    ]);
    Route::put('events/{category}/restore', [EventController::class, 'restore'])->name('events.restore');
    Route::put('events/{category}/destroy', [EventController::class, 'destroy'])->name('events.destroy');

    Route::resource('points', PointController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'points.index',
        'store' => 'points.store',
        'edit' => 'points.edit',
        'update' => 'points.update',
    ]);
    Route::put('points/{point}/restore', [PointController::class, 'restore'])->name('points.restore');
    Route::put('points/{point}/destroy', [PointController::class, 'destroy'])->name('points.destroy');

    Route::resource('classifications', ClassificationController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'classifications.index',
        'store' => 'classifications.store',
        'edit' => 'classifications.edit',
        'update' => 'classifications.update',
    ]);
    Route::put('classifications/{classification}/restore', [ClassificationController::class, 'restore'])->name('classifications.restore');
    Route::put('classifications/{classification}/destroy', [ClassificationController::class, 'destroy'])->name('classifications.destroy');

    Route::resource('instruments', InstrumentController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'instruments.index',
        'store' => 'instruments.store',
        'edit' => 'instruments.edit',
        'update' => 'instruments.update',
    ]);
    Route::put('instruments/{instrument}/restore', [InstrumentController::class, 'restore'])->name('instruments.restore');
    Route::put('instruments/{instrument}/destroy', [InstrumentController::class, 'destroy'])->name('instruments.destroy');

    Route::resource('types', TypeController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'types.index',
        'store' => 'types.store',
        'edit' => 'types.edit',
        'update' => 'types.update',
    ]);
    Route::put('types/{type}/restore', [TypeController::class, 'restore'])->name('types.restore');
    Route::put('types/{type}/destroy', [TypeController::class, 'destroy'])->name('types.destroy');

    Route::resource('people', PersonController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'people.index',
        'store' => 'people.store',
        'edit' => 'people.edit',
        'update' => 'people.update',
    ]);
    Route::put('people/{person}/restore', [PersonController::class, 'restore'])->name('people.restore');
    Route::put('people/{person}/destroy', [PersonController::class, 'destroy'])->name('people.destroy');

    Route::resource('members', MemberController::class)->except(['show', 'destroy'])->names([
        'index' => 'members.index',
        'create' => 'members.create',
        'store' => 'members.store',
        'edit' => 'members.edit',
        'update' => 'members.update',
    ]);
    Route::put('members/{person}/restore', [MemberController::class, 'restore'])->name('members.restore');
    Route::put('members/{person}/destroy', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::resource('users', UserController::class)->except(['show', 'destroy'])->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
    ]);
    Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::put('users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('services', ServiceController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'services.index',
        'store' => 'services.store',
        'edit' => 'services.edit',
        'update' => 'services.update',
    ]);
    Route::put('services/{service}/restore', [ServiceController::class, 'restore'])->name('services.restore');
    Route::put('services/{service}/destroy', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::resource('promotions', PromotionController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'promotions.index',
        'store' => 'promotions.store',
        'edit' => 'promotions.edit',
        'update' => 'promotions.update',
    ]);
    Route::put('promotions/{promotion}/restore', [PromotionController::class, 'restore'])->name('promotions.restore');
    Route::put('promotions/{promotion}/destroy', [PromotionController::class, 'destroy'])->name('promotions.destroy');

    Route::resource('roles', RoleController::class)->except(['show', 'create', 'destroy'])->names([
        'index' => 'roles.index',
        'store' => 'roles.store',
        'edit' => 'roles.edit',
        'update' => 'roles.update',
    ]);
    Route::put('roles/{role}/restore', [RoleController::class, 'restore'])->name('roles.restore');
    Route::put('roles/{role}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::resource('permissions', PermissionController::class)->only(['index'])->names([
        'index' => 'permissions.index',
    ]);
});