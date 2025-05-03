<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [DashboardController::class, 'login']);
Route::get('/logout', [DashboardController::class, 'logout']);
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات مخصصة للأدوار
Route::get('/admin/dashboard', fn() => 'أهلاً مسؤول');
Route::get('/secretary/dashboard', fn() => 'أهلاً سكرتير');
Route::get('/viewer/dashboard', fn() => 'أهلاً زائر');
