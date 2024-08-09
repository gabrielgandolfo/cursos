<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('app');
});

Route::resource('courses', CourseController::class);
Route::resource('students', StudentController::class);
Route::resource('enrollments', EnrollmentController::class);
