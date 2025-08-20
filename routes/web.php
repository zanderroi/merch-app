<?php

use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Contracts\Role;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin'], function () {


    Route::get('roles', RolesController::class.'@index')
        ->name('admin.roles.index');
    Route::post('roles', RolesController::class.'@create')->name('admin.roles.create');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
