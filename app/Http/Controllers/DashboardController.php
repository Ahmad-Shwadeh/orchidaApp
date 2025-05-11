<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * عرض صفحة Dashboard بناءً على الدور المحفوظ في الجلسة
     */
    public function index()
    {
        // تحقق من تسجيل الدخول
        if (!session()->has('user_role')) {
            return redirect('/login')->with('error', '⚠️ الرجاء تسجيل الدخول أولاً.');
        }

        // استخراج الدور
        $role = session('user_role');

        // توجيه المستخدم حسب الدور (رقم)
        return match ($role) {
            0 => view('dashboard.abofiras_dashboard'),
            1 => view('dashboard.deema_dashboard'),
            2 => view('dashboard.ahmad_dashboard'),
            3 => $this->getEditorDashboard(),
            default => redirect('/login')->with('error', '🚫 لا يوجد لوحة تحكم مخصصة لهذا الدور'),
        };
    }

    /**
     * توجيه المحررين (role = 3) حسب اسم المستخدم
     */
    private function getEditorDashboard()
    {
        $username = session('user_name');

        return match ($username) {
            'farah'  => view('dashboard.farah_dashboard'),
            'noor'   => view('dashboard.noor_dashboard'),
            'abood'  => view('dashboard.abood_dashboard'),
            default  => redirect('/login')->with('error', '⚠️ لا يوجد Dashboard لهذا المحرر'),
        };
    }
}
