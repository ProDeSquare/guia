<?php

use Illuminate\Support\Facades\Route;

Route::get('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'show' ]);
Route::post('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'register' ]);

Route::middleware(['app.setup'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'show' ])->name('admin.login');
        Route::post('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'login' ])->name('admin.login');

        Route::get('/', \App\Http\Controllers\Admin\IndexController::class);

        Route::get('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'show' ])->name('mod.add');
        Route::post('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'add' ])->name('mod.add');
    });

    Route::prefix('mod')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Mod\LoginController::class, 'show' ])->name('mod.login');
        Route::post('/login', [ \App\Http\Controllers\Mod\LoginController::class, 'login' ])->name('mod.login');

        Route::get('/', \App\Http\Controllers\Mod\IndexController::class);

        Route::get('/add/teacher', [ \App\Http\Controllers\Mod\AddTeacherController::class, 'show' ])->name('teacher.add');
        Route::post('/add/teacher', [ \App\Http\Controllers\Mod\AddTeacherController::class, 'add' ])->name('teacher.add');

        Route::get('/add/student', [ \App\Http\Controllers\Mod\AddStudentController::class, 'show' ])->name('student.add');
        Route::post('/add/student', [ \App\Http\Controllers\Mod\AddStudentController::class, 'add' ])->name('student.add');
    });

    Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('home');

    Route::post('/auth/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
});
