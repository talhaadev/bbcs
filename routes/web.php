<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations run successfully.';
});

Auth::routes();


Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/setting', [AdminController::class, 'getSettings'])->name('setting');
    Route::post('/admin/edit_setting', [AdminController::class, 'editSetting'])->name('settings.edit');
    
});

Route::middleware(['auth', 'isUser'])->group(function () {

    Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    
});
