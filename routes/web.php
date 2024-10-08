<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ProfileController;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'loginUser'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');   
    
    // add admin middleware so that only admin can access this routes
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('roles', RolesController::class);
        Route::resource('users', UsersController::class);
    });

    Route::resource('expense_categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpensesController::class);
    // route for profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/{id}/reset_password', [ProfileController::class, 'resetPassword'])->name('profile.reset_password');

    // route for logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
