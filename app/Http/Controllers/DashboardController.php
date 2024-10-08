<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;


class DashboardController extends Controller
{
    public function index() {

        // query:
        // SELECT expense_categories.category_name, COUNT(amount) as totol FROM expenses
        // LEFT join expense_categories on expenses.expense_categories_id = expense_categories.id
        // GROUP by expense_categories.category_name
        // $role = auth()->user()->role->role_name;
        // dd($role);
        $user = auth()->user();
        // dd($user->id);
        $expenses = Expense::with('expense_category', 'user')
            ->select('expense_categories.category_name', DB::raw('SUM(expenses.amount) as total'))
            ->leftJoin('expense_categories', 'expenses.expense_categories_id', '=', 'expense_categories.id')
            ->leftJoin('users', 'expenses.user_id', '=', 'users.id')
            ->groupBy('expense_categories.category_name')
            ->where('users.id', $user->id)
            ->get();
        
        return Inertia::render('Dashboard', [
            'expenses' => $expenses,
        ]);
    }
}
