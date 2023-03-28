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
Route::resource('forms',\App\Http\Controllers\FormController::class)->names('forms');
Route::get('courses',[\App\Http\Controllers\CourseController::class,'index'])->name('courses');
Route::get('course/{course}',[\App\Http\Controllers\CourseController::class,'detail']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Member\DashboardController::class,'index'])->name('dashboard');
    Route::resource('professionals',App\Http\Controllers\Member\ProfessionalController::class);
    Route::get('membership',[App\Http\Controllers\Member\MembershipController::class,'index'])->name('membership');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'role:organization|admin|master',
])->group(function () {
    Route::prefix('/admin')->group(function(){
        Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.index');
        Route::resource('members', App\Http\Controllers\Admin\MemberController::class)->names('admin.members');
        Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class)->names('admin.certificates');
        Route::resource('forms', App\Http\Controllers\Admin\FormController::class)->names('admin.forms');
        Route::resource('form.fields', App\Http\Controllers\Admin\FormFieldController::class)->names('admin.form.fields');
        Route::get('certificate-delete-media/{media}',[App\Http\Controllers\Admin\CertificateController::class,'deleteMedia'])->name('admin.certificate-delete-media');
        Route::get('form-delete-media/{media}',[App\Http\Controllers\Admin\FormController::class,'deleteMedia'])->name('admin.form-delete-media');
        Route::resource('messages', App\Http\Controllers\Admin\MessageController::class)->names('admin.messages');
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->names('admin.courses');
    })->name('admin');
});


