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
    Route::prefix('/manage')->group(function(){
        Route::prefix('/admin')->group(function(){
            Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard');
            Route::prefix('/member')->group(function(){
                Route::resource('/',App\Http\Controllers\Admin\MemberController::class);
                Route::get('/create_login/{member}',[App\Http\Controllers\Admin\MemberController::class,'createLogin']);
            })->name('manage.admin.member');        
        })->name('manage.admin');
        Route::prefix('/organization')->group(function(){
            Route::get('/',[App\Http\Controllers\Organization\DashboardController::class,'index']);
            Route::resource('organization', App\Http\Controllers\Organization\OrganizationController::class);
            Route::resource('organization.members', App\Http\Controllers\Organization\OrganizationMemberController::class);
            Route::get('/member/{organization}',[App\Http\Controllers\Organization\OrganizationController::class,'member'])->name('organization.member');
            // Route::prefix('/member')->group(function(){
                
            // })->name('manage.organization.member');
        })->name('manage.organization');
        
    })->name('manage');



});


Route::middleware([
    'auth:admin_web',
    'role:teacher',
])->group(function () {
    Route::prefix('/manage/teacher')->group(function(){

        Route::get('/',[App\Http\Controllers\Teacher\DashboardController::class,'index'])->name('teacher.dashboard');
    
    })->name('teacher');
});

