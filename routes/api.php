<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BMController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\LoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return '$request->user()';
});

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('register', 'AuthController@register');
        Route::post('reset-password', 'AuthController@resetPassword')->name("reset-password");
        Route::get('reset-password-test/{email}', 'AuthController@resetPasswordTest')->name("reset-password-test");
        Route::post('reset-password-confirm', 'AuthController@resetPasswordConfirm')->name("reset-password-confirm");
        // Route::post('set-password', 'UserController@setPassword')->name("set-password");
        Route::post('verify-email', 'AuthController@verifyEmail');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('verify-token', 'AuthController@verifyToken');
        });
    });
    Route::get('test', function () {
        return response()->json(['message' => auth()->user()], 200);
    });
    Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
        Route::get('customer', 'CustomerController@index')->name('customer.index');
        Route::get('customer/{id}', 'CustomerController@show')->name('customer.show');

        // Payment Collection
        Route::post('payment', 'PaymentController@store')->name('payment.store');

        // Collections
        Route::get('collections', 'CustomerController@collection')->name('customer.collection');

        // Past due
        Route::get('loan/due', 'CustomerController@pastDue')->name('customer.pastDue');

        Route::get('loan/bad-accounts', 'CustomerController@badAccounts')->name('customer.badAccounts');
    });
});

// Pending Loan Approval
Route::get('loan-approved', [HRController::class, 'approvedLoansAPI']);
Route::get('loan-rejected', [HRController::class, 'rejectedLoansAPI']);
Route::get('loan-pending', [HRController::class, 'pendingLoansAPI']);
Route::post('loan/approve/{id}', [LoanController::class, 'approveAPI']);
Route::post('loan/decline/{id}', [LoanController::class, 'declineAPI']);
Route::get('finance/performance-record', [BMController::class, 'performanceRecordAPI']);