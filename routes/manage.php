<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Inertia\Inertia;


Route::group(['middleware' => config('fortify.middleware', ['admin_web'])], function () {

    $limiter = config('fortify.limiters.login');

    Route::get('/manage/login', function () {
        return Inertia::render('Admin/Login');
    })->middleware(['guest:'.config('fortify.guard')]);
    

    Route::post('/manage/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:'.config('fortify.guard'),
        $limiter ? 'throttle:'.$limiter : null,
    ]));

    Route::post('/manage/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('manage.logout');
});


Route::middleware([
    'auth:admin_web',
])->group(function () {
    Route::get('/manage', function () {
        // 如果是 admin 或者 master 就跳到 amdin
        if (request()->user()->hasRole(['admin', 'master'])) return redirect()->to('/manage/admin');

        // 否則去teacher
        else return redirect()->to('/manage/teacher');
    });
});

Route::middleware([
    'auth:admin_web',
    config('jetstream.auth_session'),
    'role:admin|master',
])->group(function () {
    Route::prefix('/manage/admin')->group(function(){

        Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard');
        Route::resource('/courses',App\Http\Controllers\Admin\CourseController::class)->names('admin.courses');
        Route::resource('/offers',App\Http\Controllers\Admin\OfferController::class)->names('admin.offers');
        Route::resource('/teachers',App\Http\Controllers\Admin\TeacherController::class)->names('admin.teachers');
        Route::resource('/students',App\Http\Controllers\Admin\StudentController::class)->names('admin.students');
        Route::get('/student/get_by_id/{id}',[App\Http\Controllers\Admin\StudentController::class,'getById'])->name('admin.student.get_by_id');
        Route::get('/student/get_by_email/{email}',[App\Http\Controllers\Admin\StudentController::class,'getByEmail'])->name('admin.student.get_email');
        Route::get('/student/get_by_id_num/{idNum}',[App\Http\Controllers\Admin\StudentController::class,'getByIdNum'])->name('admin.student.get_by_id_num');
        Route::resource('/rooms',App\Http\Controllers\Admin\RoomController::class)->names('admin.rooms');
        Route::resource('/application',App\Http\Controllers\Admin\ApplicationController::class)->names('admin.application');
        Route::get('/scheduler',[App\Http\Controllers\Admin\SchedulerController::class,'index'])->name('admin.scheduler');
        Route::post('/scheduler/available_rooms',[App\Http\Controllers\Admin\SchedulerController::class,'availableRooms'])->name('admin.scheduler.available_rooms');
        
    })->name('admin');
});


Route::middleware([
    'auth:admin_web',
    'role:teacher',
])->group(function () {
    Route::prefix('/manage/teacher')->group(function(){

        Route::get('/',[App\Http\Controllers\Teacher\DashboardController::class,'index'])->name('teacher.dashboard');
    
    })->name('teacher');
});

