<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
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

    Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly.report');

    Route::get('/cashflow',[CashFlowController::class,'index'])->name('cashflow');
});
