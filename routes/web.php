<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MikrotikUserImportController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NetworkUserController;

/*
|--------------------------------------------------------------------------
| صفحات الدخول والخروج واللوحة الرئيسية
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index']);
Route::view('/login/new', 'login_new_user')->name('login.new.user');
Route::view('/logout/new', 'logout_new_user')->name('logout.new.user');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// لوحات المستخدمين
Route::view('/dashboard/deema', 'deema_dashboard')->name('dashboard.deema');
Route::view('/dashboard/ahmad', 'ahmad_dashboard')->name('dashboard.ahmad');
Route::view('/dashboard/abofiras', 'abofiras_dashboard')->name('dashboard.abofiras');

/*
|--------------------------------------------------------------------------
| إدارة مستخدمي ميكروتك
|--------------------------------------------------------------------------
*/

Route::get('/mikrotik/users', function () {
    return view('mikrotik_users');
})->name('mikrotik.users');

Route::get('/mikrotik/import', [MikrotikUserImportController::class, 'showForm'])->name('mikrotik.form');
Route::post('/mikrotik/preview', [MikrotikUserImportController::class, 'preview'])->name('mikrotik.preview');
Route::post('/mikrotik/confirm', [MikrotikUserImportController::class, 'import'])->name('mikrotik.import');

/*
|--------------------------------------------------------------------------
| إدارة الدورات التدريبية
|--------------------------------------------------------------------------
*/

Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course_number}', [CourseController::class, 'destroy'])->name('courses.destroy');

/*
|--------------------------------------------------------------------------
| إدارة مستخدمي الشبكة واستيرادهم من Excel
|--------------------------------------------------------------------------
*/

Route::get('/network-users/upload', [NetworkUserController::class, 'showUploadForm'])->name('network.upload');
Route::post('/network-users/import-simple', [NetworkUserController::class, 'importSimple'])->name('network.importSimple');
Route::get('/network-users/list', [NetworkUserController::class, 'list'])->name('network.users');

// ❌ غير مستخدمين حالياً ولكن محفوظين لو احتجتهم مستقبلاً
Route::post('/network-users/preview', [NetworkUserController::class, 'preview'])->name('network.preview');
Route::post('/network-users/import', [NetworkUserController::class, 'importSelected'])->name('network.importSelected');
Route::get('/network_users_index', [NetworkUserController::class, 'index'])->name('network.index');
Route::delete('/network-users/clear', [NetworkUserController::class, 'clearAll'])->name('network.users.clear');
