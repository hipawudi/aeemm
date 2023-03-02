<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/admin/login', function () {
    return Inertia::render('Admin/Login');
});

Route::middleware([
    // 'auth:sanctum',
    'auth:admin_web',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|master',
])->group(function () {
    Route::prefix('admin')->group(function(){

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
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:teacher|master',
])->group(function () {
    Route::prefix('teacher')->group(function(){
        Route::get('/',[App\Http\Controllers\Teacher\DashboardController::class,'index'])->name('teacher.dashboard');
    })->name('teacher');
});

