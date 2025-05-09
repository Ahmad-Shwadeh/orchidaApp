<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MikrotikUserImportController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NetworkUserController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| 🏠 صفحات الدخول واللوحة الرئيسية
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index']);
Route::view('/login/new', 'login_new_user')->name('login.new.user');
Route::view('/logout/new', 'logout_new_user')->name('logout.new.user');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ لوحات فرعية للمستخدمين
Route::view('/dashboard/deema', 'deema_dashboard')->name('dashboard.deema');
Route::view('/dashboard/ahmad', 'ahmad_dashboard')->name('dashboard.ahmad');
Route::view('/dashboard/abofiras', 'abofiras_dashboard')->name('dashboard.abofiras');

/*
|--------------------------------------------------------------------------
| 🌐 إدارة مستخدمي ميكروتك
|--------------------------------------------------------------------------
*/
Route::prefix('mikrotik')->name('mikrotik.')->group(function () {
    Route::view('/users', 'mikrotik_users')->name('users');
    Route::get('/import', [MikrotikUserImportController::class, 'showForm'])->name('form');
    Route::post('/preview', [MikrotikUserImportController::class, 'preview'])->name('preview');
    Route::post('/confirm', [MikrotikUserImportController::class, 'import'])->name('import');
});

/*
|--------------------------------------------------------------------------
| 📚 إدارة الدورات التدريبية
|--------------------------------------------------------------------------
*/
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/store', [CourseController::class, 'store'])->name('store');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course_number}', [CourseController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| 🏫 إدارة الشعب (Course Sections)
|--------------------------------------------------------------------------
*/
Route::prefix('sections')->name('sections.')->group(function () {
    Route::get('/course/{course_number}', [CourseSectionController::class, 'viewByCourse'])->name('byCourse');
    Route::get('/upload/{course_number}', [CourseSectionController::class, 'showUploadForm'])->name('uploadForm');
    Route::post('/import/{course_number}', [CourseSectionController::class, 'import'])->name('import');
    Route::post('/{course_number}/store', [CourseSectionController::class, 'store'])->name('store');
});

/*
|--------------------------------------------------------------------------
| 🌐 إدارة مستخدمي الشبكة
|--------------------------------------------------------------------------
*/
Route::prefix('network-users')->name('network.')->group(function () {
    Route::get('/upload', [NetworkUserController::class, 'showUploadForm'])->name('upload');
    Route::post('/import-simple', [NetworkUserController::class, 'importSimple'])->name('importSimple');
    Route::get('/list', [NetworkUserController::class, 'list'])->name('users');
    Route::delete('/clear', [NetworkUserController::class, 'clearAll'])->name('users.clear');

    // 🛠 إضافات مستقبلية
    Route::post('/preview', [NetworkUserController::class, 'preview'])->name('preview');
    Route::post('/import', [NetworkUserController::class, 'importSelected'])->name('importSelected');
    Route::get('/index', [NetworkUserController::class, 'index'])->name('index');
});

// 👨‍🎓 إدارة الطلاب
Route::prefix('students')->name('students.')->group(function () {
    // عرض الطلاب في شعبة معينة
    Route::get('/{section_id}', [StudentController::class, 'index'])->name('index');

    // تسجيل يدوي
    Route::get('/create/{course_number}/{section_id}', [StudentController::class, 'create'])->name('create');
    Route::post('/store/{course_number}/{section_id}', [StudentController::class, 'store'])->name('store');

    // استيراد من Excel
    Route::get('/import/{course_number}/{section_id}', [StudentController::class, 'showImportForm'])->name('importForm');
    Route::post('/import/{course_number}/{section_id}', [StudentController::class, 'import'])->name('import');

    // تعديل الحالة بناءً على student_id
    Route::put('/status/{student_id}', [StudentController::class, 'updateStatus'])->name('updateStatus');
});

