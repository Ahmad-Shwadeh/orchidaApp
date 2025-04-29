<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [DashboardController::class, 'login']);
Route::get('/logout', [DashboardController::class, 'logout']);
 