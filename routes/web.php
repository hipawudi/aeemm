<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::prefix('admin')->group(function(){
        Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index']);
        Route::resource('/courses',App\Http\Controllers\Admin\CourseController::class);
        Route::resource('/offers',App\Http\Controllers\Admin\OfferController::class);
        Route::resource('/offer_students',App\Http\Controllers\Admin\OfferStudentController::class);
        Route::resource('/teachers',App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('/students',App\Http\Controllers\Admin\StudentController::class);
        Route::get('/student/get_by_id/{id}',[App\Http\Controllers\Admin\StudentController::class,'getById']);
        Route::get('/student/get_by_email/{email}',[App\Http\Controllers\Admin\StudentController::class,'getByEmail']);
        Route::get('/student/get_by_id_num/{idNum}',[App\Http\Controllers\Admin\StudentController::class,'getByIdNum']);
        Route::resource('/rooms',App\Http\Controllers\Admin\RoomController::class);
        Route::resource('/application',App\Http\Controllers\Admin\ApplicationController::class);
        Route::get('/scheduler',[App\Http\Controllers\Admin\SchedulerController::class,'index']);
        Route::post('/scheduler/available_rooms',[App\Http\Controllers\Admin\SchedulerController::class,'availableRooms']);
    })->name('admin');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:teacher',
])->group(function () {
    Route::prefix('teacher')->group(function(){
        Route::get('/',[App\Http\Controllers\Teacher\DashboardController::class,'index']);
    })->name('teacher');
});
