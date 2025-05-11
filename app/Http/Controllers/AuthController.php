<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Employee;

class AuthController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLogin()
    {
        if (session()->has('user_role')) {
            return $this->redirectToDashboard((int) session('user_role'));
        }

        return view('auth.login_user_admin');
    }

    /**
     * تنفيذ عملية تسجيل الدخول
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Employee::where('username', $request->username)
                        ->where('password', $request->password) // ⚠️ استبدل لاحقًا بـ Hash::check
                        ->first();

        if ($user) {
            session([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            if ($request->has('remember')) {
                session(['remember_me' => true, 'last_activity' => now()]);
            }

            return $this->redirectToDashboard((int) $user->role);
        }

        return back()->with('error', '❌ اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    /**
     * توجيه المستخدم إلى لوحة التحكم الخاصة به حسب الدور
     */
    private function redirectToDashboard(int $role)
    {
        return match ($role) {
            0 => view('dashboard.abofiras_dashboard'), // Admin
            1 => view('dashboard.deema_dashboard'),
            2 => view('dashboard.ahmad_dashboard'),
            3 => view('dashboard.farah_dashboard'),
            4 => view('dashboard.noor_dashboard'),
            5 => view('dashboard.abood_dashboard'),
            default => redirect('/login')->with('error', '🚫 لا يوجد لوحة تحكم لهذا المستخدم'),
        };
    }

    /**
     * تنفيذ تسجيل الخروج
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', '✅ تم تسجيل الخروج بنجاح');
    }
}
