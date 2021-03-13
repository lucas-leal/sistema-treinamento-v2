<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
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
        });
        
        Route::prefix('courses')->group(function () {
            Route::get('', [CourseController::class, 'index'])->name('courses');

            Route::get('create', [CourseController::class, 'create']);
            Route::post('', [CourseController::class, 'store']);

            Route::get('{id}/units/create', [UnitController::class, 'create']);
            Route::post('{id}/units', [UnitController::class, 'store'])->name('units.store');

            Route::get('{id}/videos/create', [VideoController::class, 'create']);
            Route::post('{id}/videos', [VideoController::class, 'store'])->name('videos.store');

            Route::get('{id}/files/create', [FileController::class, 'create']);
            Route::post('{id}/files', [FileController::class, 'store'])->name('files.store');

            Route::get('{id}/activities/create', [ActivityController::class, 'create'])->name('activities.create');
            Route::get('{id}/activities/next', [ActivityController::class, 'next'])->name('activities.next');
            Route::post('{id}/activities', [ActivityController::class, 'store'])->name('activities.store');
            Route::get('{id}/activities/{activityId}', [ActivityController::class, 'view'])->name('activities.view');
        });
    });

    Route::middleware(User::class)->group(function () {
        Route::get('courses/{id}/subscribe', [RegistrationController::class, 'subscribe'])->name('registration');

        Route::get('courses/in-progress', [CourseController::class, 'inProgress'])->name('courses.in-progress');
        Route::get('courses/concluded', [CourseController::class, 'concluded'])->name('courses.concluded');

        Route::get('courses/{id}/activities/{activityId}/resolution', [ActivityController::class, 'renderResolutionForm'])->name('resolution.create');
        Route::post('courses/{id}/activities/{activityId}/resolution', [ActivityController::class, 'resolution'])->name('resolution.store');

        Route::get('courses/{id}/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
        Route::post('courses/{id}/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

        Route::post('courses/{id}/videos/{videoId}/view', [VideoController::class, 'view'])->name('videos.view');
    });

    Route::get('courses/{id}', [CourseController::class, 'view'])->name('courses.view');
    Route::get('/courses/{id}/files/{fileId}', [FileController::class, 'get'])->name('files.get');
    Route::get('/courses/{id}/videos/{videoId}', [VideoController::class, 'get'])->name('videos.get');
});
