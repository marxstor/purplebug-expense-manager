<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ExpenseCategory::all();

        // dd($categories);
        return inertia('ExpenseCategory', [
            'categories' => $categories,
            'message' => session('message'),
        ]);
    
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
        $validatedData = $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        $validatedData['category_name'] = strtoupper($validatedData['category_name']);

        ExpenseCategory::create($validatedData);

        return redirect()->route('expense_categories.index')->with('message', 'New expense category added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        $category_id = ExpenseCategory::find($id);

        $validatedData['category_name'] = strtoupper($validatedData['category_name']);

        $category_id->update($validatedData);

        return redirect()->route('expense_categories.index')->with('message', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category_id = ExpenseCategory::find($id);
        $category_id->delete();

        return redirect()->route('expense_categories.index')->with('message', 'Category deleted successfully.');
    }
}
