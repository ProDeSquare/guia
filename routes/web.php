<?php

use Illuminate\Support\Facades\Route;

Route::get('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'show' ]);
Route::post('/app/setup', [ \App\Http\Controllers\Admin\SetupController::class, 'register' ]);

Route::middleware(['app.setup'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'show' ])->name('admin.login');
        Route::post('/login', [ \App\Http\Controllers\Admin\LoginController::class, 'login' ])->name('admin.login');

        Route::get('/', \App\Http\Controllers\Admin\IndexController::class)->name('dashboard');

        Route::get('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'show' ])->name('mod.add');
        Route::post('/add/moderator', [ \App\Http\Controllers\Admin\AddModeratorController::class, 'add' ])->name('mod.add');

        Route::get('/view/{admin}', \App\Http\Controllers\Admin\ViewProfileController::class)->name('admin.profile');
        Route::get('/account/settings', \App\Http\Controllers\Admin\SettingsController::class)->name('admin.settings');
    });

    Route::prefix('mod')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Mod\LoginController::class, 'show' ])->name('mod.login');
        Route::post('/login', [ \App\Http\Controllers\Mod\LoginController::class, 'login' ])->name('mod.login');

        Route::get('/', \App\Http\Controllers\Mod\IndexController::class)->name('dashboard');

        Route::get('/add/teacher', [ \App\Http\Controllers\Mod\AddTeacherController::class, 'show' ])->name('teacher.add');
        Route::post('/add/teacher', [ \App\Http\Controllers\Mod\AddTeacherController::class, 'add' ])->name('teacher.add');

        Route::get('/add/student', [ \App\Http\Controllers\Mod\AddStudentController::class, 'show' ])->name('student.add');
        Route::post('/add/student', [ \App\Http\Controllers\Mod\AddStudentController::class, 'add' ])->name('student.add');

        Route::get('/view/{mod}', \App\Http\Controllers\Mod\ViewProfileController::class)->name('mod.profile');
        Route::get('/account/settings', \App\Http\Controllers\Mod\SettingsController::class)->name('mod.settings');
    });

    Route::prefix('teacher')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Teacher\LoginController::class, 'show' ])->name('teacher.login');
        Route::post('/login', [ \App\Http\Controllers\Teacher\LoginController::class, 'login' ])->name('teacher.login');

        Route::get('/', \App\Http\Controllers\Teacher\IndexController::class)->name('dashboard');

        Route::get('/view/{teacher}', \App\Http\Controllers\Teacher\ViewProfileController::class)->name('teacher.profile');

        Route::post('/profile/update', \App\Http\Controllers\Teacher\UpdateProfileController::class)->name('teacher.profile.update');
        Route::get('/account/settings', \App\Http\Controllers\Teacher\SettingsController::class)->name('teacher.settings');
    });

    Route::prefix('student')->group(function () {
        Route::get('/login', [ \App\Http\Controllers\Student\LoginController::class, 'show' ])->name('student.login');
        Route::post('/login', [ \App\Http\Controllers\Student\LoginController::class, 'login' ])->name('student.login');

        Route::get('/add/email', [ \App\Http\Controllers\Student\AddEmailController::class, 'show' ])->name('student.add.email');
        Route::post('/add/email', [ \App\Http\Controllers\Student\AddEmailController::class, 'add' ])->name('student.add.email');

        Route::get('/', \App\Http\Controllers\Student\IndexController::class)->name('dashboard');

        Route::get('/account/settings', \App\Http\Controllers\Student\SettingsController::class)->name('student.settings');

        Route::get('/view/{student}', \App\Http\Controllers\Student\ViewProfileController::class)->name('student.profile');

        Route::get('/requests/view', \App\Http\Controllers\Student\ViewRequestsController::class)->name('requests.view');
        Route::patch('/request/accept/{request}', \App\Http\Controllers\Student\AcceptRequestController::class)->name('request.accept');
        Route::delete('/request/decline/{request}', \App\Http\Controllers\Student\DeclineRequestController::class)->name('request.decline');

        Route::post('/profile/update', \App\Http\Controllers\Student\UpdateProfileController::class)->name('student.profile.update');
    
        Route::post('/group/create', \App\Http\Controllers\Group\CreateGroupController::class)->name('group.create');
        Route::delete('/group/delete', \App\Http\Controllers\Group\DeleteGroupController::class)->name('group.delete');

        Route::post('/send-group-request/{student}', \App\Http\Controllers\Group\SendGroupRequestController::class)->name('add.to.group');
        Route::post('/cancel-group-request/{student}', \App\Http\Controllers\Group\CancelGroupRequestController::class)->name('remove.from.group');
        Route::post('/accept-group-request/{request}', \App\Http\Controllers\Group\AcceptGroupRequestController::class)->name('accept.group.request');
    });

    Route::prefix('group')->group(function () {
        Route::get('/create/project', [ \App\Http\Controllers\Project\CreateController::class, 'show' ])->name('create.project');
        Route::post('/create/project', [ \App\Http\Controllers\Project\CreateController::class, 'add' ])->name('create.project');

        Route::get('/update/project/{project}', [ \App\Http\Controllers\Project\UpdateController::class, 'show' ])->name('update.project');
        Route::patch('/update/project/{project}', [ \App\Http\Controllers\Project\UpdateController::class, 'update' ])->name('update.project');

        Route::get('/{group}/view/projects', \App\Http\Controllers\Group\GetProjectsController::class)->name('view.group.projects');

        Route::get('view/project/{project}', \App\Http\Controllers\Project\ViewController::class)->name('project.view');
    });

    Route::prefix('search')->group(function () {
        Route::get('/{q?}', \App\Http\Controllers\Search\PerformController::class)->name('search');
    });

    Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('home');

    Route::prefix('auth')->group(function () {
        Route::post('/auth/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
        Route::post('/auth/update/password', \App\Http\Controllers\Auth\UpdatePasswordController::class)->name('update.password');
    });
});
