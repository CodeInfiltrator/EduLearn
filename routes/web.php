<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\LessonController;

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

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/register', [UserAuthController::class, 'showRegister']);
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/logout', [UserAuthController::class, 'logout']);

Route::prefix('admin')
    ->middleware(['auth', 'can:isAdmin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

});

Route::middleware('auth')->group(function () {

    Route::post('/courses/{course}/enroll', [EnrollController::class, 'enroll'])
        ->name('courses.enroll');

    Route::get('/my-courses', [EnrollController::class, 'myCourses'])
        ->name('courses.my');

});

Route::middleware('auth')->group(function () {
    Route::get('/my-courses', [MyCourseController::class, 'index'])
         ->name('mycourses');
});

Route::get('/lessons/{lesson}', [LessonController::class, 'show'])
    ->middleware('auth')
    ->name('lessons.show');

Route::delete('/courses/{course}/unenroll',
    [EnrollController::class, 'destroy'])
    ->middleware('auth')
    ->name('courses.unenroll');

// lessons

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('courses.lessons', Admin\LessonController::class);
});

Route::get('/courses/{course}/learn',
    [LessonController::class, 'index']
)->middleware('auth')->name('courses.learn');

Route::get('/lessons/{lesson}',
    [LessonController::class, 'show']
)->middleware('auth')->name('lessons.show');

Route::middleware('auth')->group(function () {
    Route::get('/courses/{course}/learn', [CourseController::class, 'learn'])
        ->name('courses.learn');
});


