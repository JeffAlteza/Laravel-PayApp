<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DashboardController;




//ADMIN---------------------------------------------------------------------------------------------------------------
Route::post('login', [AdminController::class, 'login']);
Route::post('user/register', [AdminController::class, 'create_user']);
Route::get('payment_transactions', [AdminController::class, 'show_payment_transactions']);
Route::get('logs', [AdminController::class, 'show_logs']);
Route::post('loginsample', [AdminController::class, 'sampleLog']);
Route::prefix('/admin')->middleware('auth:api')->group(function () {
    Route::get('/users/show', [AdminController::class, 'show']); 
    // Route::get('/payment_transactions', [AdminController::class, 'show_payment_transactions']); 
    Route::get('/user/show_specific/{id}', [AdminController::class, 'show_specific']); 
    Route::put('/user/update/{id}', [AdminController::class, 'update']);
    Route::delete('/user/delete/{id}', [AdminController::class, 'delete']);
});


//USER----------------------------------------------------------------------------------------------------------------
Route::post('payment', [UserController::class, 'proceed_payment']);
// Route::post('checkout', [UserController::class, 'checkout']);
Route::get('failed_transaction/{id}', [UserController::class,'failed_transaction'])->name('failed_transaction');
Route::get('success_payment/{id}', [UserController::class,'success_payment'])->name('success_payment');
Route::get('callback', [UserController::class,'callback']);


//DASHBOARD-----------------------------------------------------------------------------------------------------------
    //Total Amount of all transactions
Route::get('monday', [DashboardController::class, 'getTotalAmountMonday']);
Route::get('tuesday', [DashboardController::class, 'getTotalAmountTuesday']);
Route::get('wednesday', [DashboardController::class, 'getTotalAmountWednesday']);
Route::get('thursday', [DashboardController::class, 'getTotalAmountThursday']);
Route::get('friday', [DashboardController::class, 'getTotalAmountFriday']);
Route::get('saturday', [DashboardController::class, 'getTotalAmountSaturday']);
Route::get('sunday', [DashboardController::class, 'getTotalAmountSunday']);
Route::get('amount_this_week', [DashboardController::class, 'TotalAmountThisWeek']);
Route::get('amount_this_month', [DashboardController::class, 'TotalAmountThisMonth']);
Route::get('amount_this_year', [DashboardController::class, 'TotalAmountThisYear']);


Route::get('week1', [DashboardController::class, 'week1']);
Route::get('week2', [DashboardController::class, 'week2']);
Route::get('week3', [DashboardController::class, 'week3']);
Route::get('week4', [DashboardController::class, 'week4']);

    //Total Number of all transactions

Route::get('count_week1', [DashboardController::class, 'count_week1']);
Route::get('count_week2', [DashboardController::class, 'count_week2']);
Route::get('count_week3', [DashboardController::class, 'count_week3']);
Route::get('count_week4', [DashboardController::class, 'count_week4']);
Route::get('count_month', [DashboardController::class, 'TotalNumberThisMonth']);
Route::get('count_year', [DashboardController::class, 'TotalNumberThisYear']);


Route::get('count_monday', [DashboardController::class, 'getTotalNumberMonday']);
Route::get('count_tuesday', [DashboardController::class, 'getTotalNumberTuesday']);
Route::get('count_wednesday', [DashboardController::class, 'getTotalNumberWednesday']);
Route::get('count_thursday', [DashboardController::class, 'getTotalNumberThursday']);
Route::get('count_friday', [DashboardController::class, 'getTotalNumberFriday']);
Route::get('count_saturday', [DashboardController::class, 'getTotalNumberSaturday']);
Route::get('count_sunday', [DashboardController::class, 'getTotalNumberSunday']);
