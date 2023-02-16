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
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::prefix('admin')->group(function(){
        Route::get('/',function(){
            return Inertia::render('Admin/Dashboard');
        });
        Route::resource('/courses',App\Http\Controllers\Admin\CourseController::class);
        Route::resource('/offers',App\Http\Controllers\Admin\OfferController::class);
        Route::resource('/teachers',App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('/rooms',App\Http\Controllers\Admin\RoomController::class);
        Route::get('/scheduler',[App\Http\Controllers\Admin\SchedulerController::class,'index']);
        Route::post('/scheduler/available_rooms',[App\Http\Controllers\Admin\SchedulerController::class,'availableRooms']);
    });
});
