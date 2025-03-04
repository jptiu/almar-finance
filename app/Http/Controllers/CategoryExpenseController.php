<?php

namespace App\Http\Controllers;

use App\Models\CategoryExpense;
use Illuminate\Http\Request;

class CategoryExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category_expenses',
        ]);

        $category = new CategoryExpense();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryExpense $categoryExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryExpense $categoryExpense)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryExpense $categoryExpense)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255|unique:category_expenses,name,' . $categoryExpense->id,

        ]);
        $categoryExpense = CategoryExpense::find($request->id);
        $categoryExpense->name = $request->name;
        $categoryExpense->update();

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $categoryExpense = CategoryExpense::find($id);
        $categoryExpense->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
