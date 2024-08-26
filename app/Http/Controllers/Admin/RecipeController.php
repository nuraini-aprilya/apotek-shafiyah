<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $recipes = Recipe::with('customer')->latest()->get();
            return DataTables::of($recipes)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    return $row->customer ? $row->customer->full_name : '-';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('status', function ($row) {
                    return $row->status();
                })
                ->addColumn('action', 'admin.recipe.include.action')
                ->toJson();
        }

        return view('admin.recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('customer');
        return view('admin.recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe) {}

    public function approveRecipe(Recipe $recipe)
    {
        $recipe->update([
            'status' => 2
        ]);

        return redirect()->route('admin.recipe.index');
    }

    public function rejectRecipe(Recipe $recipe)
    {
        $recipe->update([
            'status' => 3
        ]);

        return redirect()->route('admin.recipe.index');
    }
}
