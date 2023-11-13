<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RoleController;
use App\HttP\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('test', function () {
//     return view('test');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/verify/{token}', [RegisterController::class, 'verify']);
Route::get('auth/send-verification', [RegisterController::class, 'sendVerification']);
Route::get('profile', [SettingsController::class, 'profile']);
Route::get('profile/edit', [SettingsController::class, 'editProfile']);
Route::post('profile', [SettingsController::class, 'updateProfile']);
Route::get('settings/password', [SettingsController::class, 'editPassword']);
Route::post('settings/password', [SettingsController::class, 'updatePassword']);

// Route::get('/chart-data', [ChartController::class, 'getChartData']);
Route::get('/pie-chart-data', [ChartController::class, 'getPieChartData']);

Route::post('/upload', [PdfController::class, 'uploadFile']);
Route::get('/export-pdf', [CashflowController::class, 'exportPDF'])->name('export.pdf');

// Route::get('/cashflows', [CashflowController::class, 'index'])->name('cashflows.index')->middleware('auth');
// Route::delete('/cashflows/{id}', [CashflowController::class, 'destroy'])->name('cashflows.destroy')->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('cashflows', CashflowController::class);
    Route::post('cashflows/bulk-delete', [CashflowController::class, 'bulkDestroy']);

    Route::resource('categories', CategoryController::class);
    Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDestroy']);
    Route::delete('categories/force/{category}', [CategoryController::class, 'forceDestroy']);

    Route::resource('roles', RoleController::class);
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'] )->name('roles.edit');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/selected-roles', [RoleController::class, 'deleteAll'])->name('roles.delete');
    // Route::resource('', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/user-roles', [UserController::class, 'deleteAll'])->name('users.delete');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::delete('/selected-permissions', [PermissionController::class, 'deleteAll'])->name('permissions.delete');
});
