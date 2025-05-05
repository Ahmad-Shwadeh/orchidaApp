<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// الصفحة الرئيسية الافتراضية
Route::get('/', [DashboardController::class, 'index']);

// واجهات تسجيل الدخول والخروج للمشتركين الجدد
Route::view('/login/new', 'login_new_user')->name('login.new.user');
Route::view('/logout/new', 'logout_new_user')->name('logout.new.user');

// تسجيل دخول المسؤولين بأنواعهم
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات Dashboard الخاصة بالمستخدمين (حسب الاسم)
Route::view('/dashboard/deema', 'deema_dashboard')->name('dashboard.deema');
Route::view('/dashboard/ahmad', 'ahmad_dashboard')->name('dashboard.ahmad');
Route::view('/dashboard/abofiras', 'abofiras_dashboard')->name('dashboard.abofiras');

Route::get('/mikrotik/users', function () {
    return view('mikrotik_users');
})->name('mikrotik.users');

use App\Http\Controllers\MikrotikUserImportController;

Route::get('/mikrotik/import', [MikrotikUserImportController::class, 'showForm'])->name('mikrotik.form');
Route::post('/mikrotik/preview', [MikrotikUserImportController::class, 'preview'])->name('mikrotik.preview');
Route::post('/mikrotik/confirm', [MikrotikUserImportController::class, 'import'])->name('mikrotik.import');

use App\Http\Controllers\CourseController;

Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course_number}', [CourseController::class, 'destroy'])->name('courses.destroy');


