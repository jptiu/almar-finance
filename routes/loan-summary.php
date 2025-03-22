<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanSummaryController;

Route::middleware(['auth', 'verified'])
    ->prefix('loan-summary')
    ->group(function () {
        Route::get('/', [LoanSummaryController::class, 'index'])
            ->name('loan-summary.index');
        Route::post('/export', [LoanSummaryController::class, 'export'])
            ->name('loan-summary.export');
    });
