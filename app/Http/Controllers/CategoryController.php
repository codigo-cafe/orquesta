<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        return Inertia::render('Admin/Categories/Index');
    }

    public function getCategories(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        if ($request->ajax()) {
            $can = $request->user() ? $request->user()->getPermissionArray() : [];
            $model = Category::query();
            return DataTables::eloquent($model)
            ->editColumn('created_at', function ($category) {
                return $category->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at->format('d/m/Y H:i');
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
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        Category::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Categoría registrada correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update', [Category::class, $category]);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', [Category::class, $category]);
        $category->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Categoría modificada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', [Category::class, $category]);
        $category->update(['status' => false]);
        return response()->json([
            'type' => 'success',
            'message' => 'Categoría inhabilitada correctamente',
        ]);
    }

    public function restore(Category $category)
    {
        $this->authorize('restore', [Category::class, $category]);
        $category->update(['status' => true]);
        return response()->json([
            'type' => 'success',
            'message' => 'Categoría habilitada correctamente',
        ]);
    }
}
