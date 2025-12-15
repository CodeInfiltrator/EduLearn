<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController;

// Home
Route::get('/', function () {
    return view('home');
});

// Admin
Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

// Public Display (User)
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);

// Admin CRUD (Resource Route)
Route::resource('admin/categories', CategoryController::class);
Route::resource('admin/teachers', TeacherController::class);
Route::resource('admin/courses', CourseController::class);

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('teachers', AdminTeacherController::class);
    Route::resource('courses', AdminCourseController::class);
});

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('teachers', AdminTeacherController::class);
    Route::resource('courses', AdminCourseController::class);
});
