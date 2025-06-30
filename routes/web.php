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


Route::get('forgot/password', [AdminController::class, 'sendotp'])->name('forgot.password');
Route::post('send/otp', [AdminController::class, 'sendOtpEmail'])->name('send.otp');
Route::get('login/otp/{id}', [AdminController::class, 'LoginOtp'])->name('login.otp');
Route::post('login/otp/{id}', [AdminController::class, 'LoginOtpSubmit']);


Auth::routes();
Route::post('/otp-verified-login', [App\Http\Controllers\Auth\PhoneAuthController::class, 'handleOtpLogin']);

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/impersonate/{id}', function ($id) {
    $admin = Auth::user();

    // Ensure only admins can impersonate
    if ($admin->role === 'admin') {
        session(['impersonate' => $admin->id]); // Save current admin ID
        Auth::loginUsingId($id); // Switch to target user
        return redirect('user/dashboard'); // Redirect to user dashboard or home
    }

    abort(403, 'Unauthorized action.');
})->name('impersonate');

// Stop impersonation
Route::get('/stop-impersonate', function () {
    if (session()->has('impersonate')) {
        $adminId = session('impersonate');
        Auth::loginUsingId($adminId); // Switch back to admin
        session()->forget('impersonate');
        return redirect('/admin-dashboard'); // Redirect to admin panel
    }

    return redirect('/');
})->name('stop.impersonate');


    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/setting', [AdminController::class, 'getSettings'])->name('setting');
    Route::post('/admin/edit_setting', [AdminController::class, 'editSetting'])->name('settings.edit');

    Route::get('/admin/deposits', [AdminController::class, 'getdeposits'])->name('deposits');
    Route::get('/admin/deposit/status/{id}', [AdminController::class, 'ChangedepositStatus']);
    Route::get('/admin/withdrawals', [AdminController::class, 'getwithdrawals'])->name('withdrawals');
    Route::get('/admin/withdrawal/status/{id}', [AdminController::class, 'ChangedwithdrawalStatus']);


    Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::get('/admin/reward/list', [AdminController::class, 'rewardlist'])->name('admin.reward.list');
    Route::post('/admin/set/percentage/{id}', [AdminController::class, 'setPercentage'])->name('set.percentage');
});

Route::middleware(['auth', 'isUser'])->group(function () {

    Route::get('user/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/deposits', [DepositController::class, 'deposits'])->name('user.deposits');
    Route::get('user/create/deposits', [DepositController::class, 'create'])->name('user.create.deposit');
    Route::post('user/store/deposits', [DepositController::class, 'store'])->name('user.store.deposit');

    Route::get('user/withdrawl', [WithdrawalController::class, 'withdrawl'])->name('user.withdrawl');
    Route::get('user/create/withdrawl', [WithdrawalController::class, 'create'])->name('user.create.withdrawl');
    Route::post('user/store/withdrawl', [WithdrawalController::class, 'store'])->name('user.store.withdrawl');
    Route::get('user/get/reward/{id}', [UserDashboardController::class, 'getReward'])->name('user.get.reward');
});
