<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations run successfully.';
});

Auth::routes();
Route::post('/otp-verified-login', [App\Http\Controllers\Auth\PhoneAuthController::class, 'handleOtpLogin']);


Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/setting', [AdminController::class, 'getSettings'])->name('setting');
    Route::post('/admin/edit_setting', [AdminController::class, 'editSetting'])->name('settings.edit');

    Route::get('/admin/deposits', [AdminController::class, 'getdeposits'])->name('deposits');
    Route::get('/admin/deposit/status/{id}', [AdminController::class, 'ChangedepositStatus']);
    Route::get('/admin/withdrawals', [AdminController::class, 'getwithdrawals'])->name('withdrawals');
    Route::get('/admin/withdrawal/status/{id}', [AdminController::class, 'ChangedwithdrawalStatus']);
});

Route::middleware(['auth', 'isUser'])->group(function () {

    Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/deposits', [DepositController::class, 'deposits'])->name('user.deposits');
    Route::get('user/create/deposits', [DepositController::class, 'create'])->name('user.create.deposit');
    Route::post('user/store/deposits', [DepositController::class, 'store'])->name('user.store.deposit');

    Route::get('user/withdrawl', [WithdrawalController::class, 'withdrawl'])->name('user.withdrawl');
    Route::get('user/create/withdrawl', [WithdrawalController::class, 'create'])->name('user.create.withdrawl');
    Route::post('user/store/withdrawl', [WithdrawalController::class, 'store'])->name('user.store.withdrawl');
});
