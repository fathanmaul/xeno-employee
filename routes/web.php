<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmpPresenceController;
use App\Http\Controllers\EmpSalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('employees', EmployeeController::class);

Route::resource('presences', EmpPresenceController::class);

Route::get('/salary/monthly', [EmpSalaryController::class, 'monthly'])->name('salary.monthly');
Route::post('/salary/monthly', [EmpSalaryController::class, 'generateMonthly'])->name('salary.generateMonthly');

Route::resource('salary', EmpSalaryController::class);
