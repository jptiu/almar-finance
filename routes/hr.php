<?php

use App\Http\Controllers\BenefitController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ContributionReportController;
use App\Http\Controllers\HR\UserController;

Route::middleware(['auth', 'verified'])->prefix('hr')->name('hr.')->group(function () {
    // Users (Employees)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Benefits
    Route::get('/benefits', [BenefitController::class, 'index'])->name('benefits.index');
    Route::get('/benefits/create', [BenefitController::class, 'create'])->name('benefits.create');
    Route::post('/benefits', [BenefitController::class, 'store'])->name('benefits.store');
    Route::get('/benefits/{benefit}', [BenefitController::class, 'show'])->name('benefits.show');
    Route::get('/benefits/{benefit}/edit', [BenefitController::class, 'edit'])->name('benefits.edit');
    Route::put('/benefits/{benefit}', [BenefitController::class, 'update'])->name('benefits.update');
    Route::delete('/benefits/{benefit}', [BenefitController::class, 'destroy'])->name('benefits.destroy');

    // Salaries
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
    Route::post('/salaries', [SalaryController::class, 'store'])->name('salaries.store');
    Route::get('/salaries/{salary}', [SalaryController::class, 'show'])->name('salaries.show');
    Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
    Route::put('/salaries/{salary}', [SalaryController::class, 'update'])->name('salaries.update');
    Route::delete('/salaries/{salary}', [SalaryController::class, 'destroy'])->name('salaries.destroy');

    // Leaves
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/{leave}', [LeaveController::class, 'show'])->name('leaves.show');
    Route::get('/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::put('/leaves/{leave}', [LeaveController::class, 'update'])->name('leaves.update');
    Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy');

    // Contributions
    Route::get('/contributions', [ContributionReportController::class, 'index'])->name('contributions.index');
    Route::get('/contributions/create', [ContributionReportController::class, 'create'])->name('contributions.create');
    Route::post('/contributions', [ContributionReportController::class, 'store'])->name('contributions.store');
    Route::get('/contributions/{report}', [ContributionReportController::class, 'print'])->name('contributions.print');
});
