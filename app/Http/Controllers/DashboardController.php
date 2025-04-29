<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function login() {
        return view('login');
    }

    public function logout() {
        return view('logout');
    }
}
