<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware(Admin::class)->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('users');
            Route::get('create', [UserController::class, 'create']);
            Route::post('', [UserController::class, 'store']);
            Route::get('{id}/report', [UserController::class, 'report'])->name('user.report');
        });
        
        Route::prefix('courses')->group(function () {
            Route::get('', [CourseController::class, 'index'])->name('courses');

            Route::get('create', [CourseController::class, 'create']);
            Route::post('', [CourseController::class, 'store']);

            Route::prefix('{id}')->group(function () {
                Route::get('units/create', [UnitController::class, 'create']);
                Route::post('units', [UnitController::class, 'store'])->name('units.store');

                Route::get('videos/create', [VideoController::class, 'create']);
                Route::post('videos', [VideoController::class, 'store'])->name('videos.store');

                Route::get('files/create', [FileController::class, 'create']);
                Route::post('files', [FileController::class, 'store'])->name('files.store');

                Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
                Route::get('activities/next', [ActivityController::class, 'next'])->name('activities.next');
                Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
                Route::get('activities/{activityId}', [ActivityController::class, 'view'])->name('activities.view');

                Route::get('activate', [CourseController::class, 'activate'])->name('course.activate');
                Route::get('inactivate', [CourseController::class, 'inactivate'])->name('course.inactivate');
            });
        });
    });

    Route::prefix('courses')->group(function () {
        Route::middleware(User::class)->group(function () {
            Route::get('in-progress', [CourseController::class, 'inProgress'])->name('courses.in-progress');
            Route::get('concluded', [CourseController::class, 'concluded'])->name('courses.concluded');

            Route::prefix('{id}')->group(function () {
                Route::get('subscribe', [RegistrationController::class, 'subscribe'])->name('registration');

                Route::get('activities/{activityId}/resolution', [ActivityController::class, 'renderResolutionForm'])->name('resolution.create');
                Route::post('activities/{activityId}/resolution', [ActivityController::class, 'resolution'])->name('resolution.store');
        
                Route::get('evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
                Route::post('evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
        
                Route::post('videos/{videoId}/view', [VideoController::class, 'view'])->name('videos.view');

                Route::get('certificate', [CertificateController::class, 'index'])->name('certificate');
            });
        });

        Route::prefix('{id}')->group(function () {
            Route::get('', [CourseController::class, 'view'])->name('courses.view');
            Route::get('files/{fileId}', [FileController::class, 'get'])->name('files.get');
            Route::get('videos/{videoId}', [VideoController::class, 'get'])->name('videos.get');
        });
    });
});
