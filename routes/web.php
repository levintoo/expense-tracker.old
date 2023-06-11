<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__.'/auth.php';

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses');
    Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/expenses/create', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{id}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::post('/expenses/{id}/update', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{id}/delete', [ExpensesController::class, 'destroy'])->name('expenses.delete');

    Route::get('/income', [IncomeController::class, 'index'])->name('income');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/create', [IncomeController::class, 'store'])->name('income.store');
    Route::get('/income/{id}/edit', [IncomeController::class, 'edit'])->name('income.edit');
    Route::post('/income/{id}/update', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/{id}/delete', [IncomeController::class, 'destroy'])->name('income.delete');

    Route::get('/income-category', [IncomeCategoryController::class, 'index'])->name('income.category');
    Route::get('/income-category/create', [IncomeCategoryController::class, 'create'])->name('income.category.create');
    Route::post('/income-category/create', [IncomeCategoryController::class, 'store'])->name('income.category.store');
    Route::get('/income-category/{id}/edit', [IncomeCategoryController::class, 'edit'])->name('income.category.edit');
    Route::post('/income-category/{id}/update', [IncomeCategoryController::class, 'update'])->name('income.category.category.update');
    Route::delete('/income-category/{id}/delete', [IncomeCategoryController::class, 'destroy'])->name('income.category.delete');

    Route::get('/expenses-category', [ExpensesCategoryController::class, 'index'])->name('expenses.category');
    Route::get('/expenses-category/create', [ExpensesCategoryController::class, 'create'])->name('expenses.category.create');
    Route::post('/expenses-category/create', [ExpensesCategoryController::class, 'store'])->name('expenses.category.store');
    Route::get('/expenses-category/{id}/edit', [ExpensesCategoryController::class, 'edit'])->name('expenses.category.edit');
    Route::post('/expenses-category/{id}/update', [ExpensesCategoryController::class, 'update'])->name('expenses.category.category.update');
    Route::delete('/expenses-category/{id}/delete', [ExpensesCategoryController::class, 'destroy'])->name('expenses.category.delete');

    Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly.report');
});
