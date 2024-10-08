<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_categories = ExpenseCategory::all();
        $user = auth()->user();
        $role = $user->role->role_name;

        if($role === "ADMIN") {
            $expenses = Expense::with('expense_category', 'user')->get();
        } else {
            $expenses = Expense::with('expense_category', 'user')->where('user_id', $user->id)->get();
        }
        // dd($expenses);
        return inertia('Expenses', [
            'expenses' => $expenses,
            'expense_categories' => $expense_categories,
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
        // dd($request);        
        $validatedData = $request->validate([
            'expense_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required',
        ]);

        $user = auth()->user();

        Expense::create([
            'expense_categories_id' => $validatedData['expense_id'],
            'user_id' => $user->id,
            'amount' => $validatedData['amount'],
            'entry_date' => $validatedData['entry_date'],
        ]);

        return redirect()->route('expenses.index')->with('message', 'Expenses successfully added.');
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

        // error on update to be fixed tomorrow
        // dd($request);        
        $validatedData = $request->validate([
            'expense_category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required|date',
        ]);

        $expenses_id = Expense::find($id);

        $user = auth()->user();

        $expenses_id->update([
            'expense_categories_id' => $validatedData['expense_category_id'],
            'user_id' => $user->id,
            'amount' => $validatedData['amount'],
            'entry_date' => $validatedData['entry_date'],
        ]);

        return redirect()->route('expenses.index')->with('message', 'Expense details successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense_id = Expense::find($id);
        $expense_id->delete();

        return redirect()->route('expenses.index')->with('message', 'Expenses successfully deleted.');

    }
}
