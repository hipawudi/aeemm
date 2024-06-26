<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('/')->group(function () {
    Route::get('/courses', [\App\Http\Controllers\Api\CourseController::class, 'getCourses']);
    Route::get('/course/{id}', [\App\Http\Controllers\Api\CourseController::class, 'getCourse']);
    Route::get('/newCourses', [\App\Http\Controllers\Api\CourseController::class, 'getNewCourses']);
    Route::get('/getBulletins', [\App\Http\Controllers\Api\BulletinController::class, 'getBulletins']);
    Route::get('/bulletin/{id}', [\App\Http\Controllers\Api\BulletinController::class, 'getBulletin']);
    Route::get('/newBulletins', [\App\Http\Controllers\Api\BulletinController::class, 'getNewBulletins']);
});
