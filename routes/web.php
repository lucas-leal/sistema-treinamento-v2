<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\Admin;
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

            Route::get('{id}', [CourseController::class, 'view'])->name('courses.view');

            Route::get('{id}/units/create', [UnitController::class, 'create']);
            Route::post('{id}/units', [UnitController::class, 'store'])->name('units.store');

            Route::get('{id}/videos/create', [VideoController::class, 'create']);
            Route::post('{id}/videos', [VideoController::class, 'store'])->name('videos.store');

            Route::get('{id}/files/create', [FileController::class, 'create']);
            Route::post('{id}/files', [FileController::class, 'store'])->name('files.store');
        });
    });
});
