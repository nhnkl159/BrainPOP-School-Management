<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PeriodController;

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

//Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('student', [AuthController::class, 'student']);
    Route::post('teacher', [AuthController::class, 'teacher']);
});

//Making a /api/ prefix for all end-points.
Route::prefix('api')->group(function () {

    //API Resources routes

    // Non Auth routes:
    Route::post('teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');

    // Auth protected routes:
    Route::middleware('auth:sanctum')->group(function () {

        //Teachers
        Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
        Route::put('teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        //Students
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');
        Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('students/{teacher}', [StudentController::class, 'destroy'])->name('students.destroy');

        // Periods
        Route::apiResource('periods', PeriodController::class);
    });
});

