<?php

use Illuminate\Support\Facades\Route;

Route::get('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'show' ]);
Route::post('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'register' ]);

Route::middleware(['app.setup'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'show' ]);
        Route::post('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'login' ])->name('admin.login');

        Route::get('/', \App\Http\Controllers\Admin\IndexController::class);

        Route::get('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'show' ])->name('mod.add');
        Route::post('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'add' ])->name('mod.add');
    });

    Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('home');

    Route::post('/auth/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
});
