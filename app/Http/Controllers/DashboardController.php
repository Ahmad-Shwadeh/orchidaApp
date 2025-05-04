<?php
namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // تحقق من أن المستخدم مسجل دخول
        if (!session()->has('user_name')) {
            return redirect('/login')->with('error', 'الرجاء تسجيل الدخول أولاً');
        }

        // جلب اسم المستخدم من الجلسة
        $username = session('user_name');

        // توجيه المستخدم للـ Dashboard الخاص فيه حسب اسمه
        return match ($username) {
            'ديما'      => view('deema_dashboard'),
            'أحمد'      => view('ahmad_dashboard'),
            'أبو فراس'  => view('abofiras_dashboard'),
            default     => redirect('/login')->with('error', '⚠️ لا يوجد صفحة Dashboard لهذا المستخدم'),
        };
    }
}
