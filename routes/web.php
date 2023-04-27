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
        'hasLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::resource('forms', \App\Http\Controllers\FormController::class)->names('forms');
Route::get('courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses');
Route::get('course/{course}', [\App\Http\Controllers\CourseController::class, 'detail']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('professionals', App\Http\Controllers\Member\ProfessionalController::class);
    Route::get('membership', [App\Http\Controllers\Member\MembershipController::class, 'index'])->name('membership');
});

Route::prefix('api')->group(function () {
    Route::get('bulletins', [App\Http\Controllers\Api\BulletinController::class, 'index'])->name('api.bulletins');
    Route::get('courses', [App\Http\Controllers\Api\CourseController::class, 'index'])->name('api.courses');
    Route::get('course/{course}', [\App\Http\Controllers\Api\CourseController::class, 'show'])->name('api.course.show');
})->name('api');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'role:organization|admin|master',
])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.index');
        Route::resource('members', App\Http\Controllers\Admin\MemberController::class)->names('admin.members');
        Route::post('members/createLogin', [App\Http\Controllers\Admin\MemberController::class, 'createLogin'])->name('admin.members.createLogin');
        Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class)->names('admin.certificates');
        Route::resource('professionals', App\Http\Controllers\Admin\ProfessionalController::class)->names('admin.professionals');
        Route::get('professional/{certificate}/members', [App\Http\Controllers\Admin\ProfessionalController::class, 'members'])->name('admin.professional.members');
        Route::resource('forms', App\Http\Controllers\Admin\FormController::class)->names('admin.forms');
        Route::resource('forms.fields', App\Http\Controllers\Admin\FormFieldController::class)->names('admin.forms.fields');
        Route::get('certificate-delete-media/{media}', [App\Http\Controllers\Admin\CertificateController::class, 'deleteMedia'])->name('admin.certificate-delete-media');
        Route::get('form-delete-media/{media}', [App\Http\Controllers\Admin\FormController::class, 'deleteMedia'])->name('admin.form-delete-media');
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->names('admin.courses');
        Route::resource('messages', App\Http\Controllers\Admin\MessageController::class)->names('admin.messages');
        Route::resource('bulletins', App\Http\Controllers\Admin\BulletinController::class)->names('admin.bulletins');
    })->name('admin');
});
