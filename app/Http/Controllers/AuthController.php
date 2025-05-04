<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserAdmin;

class AuthController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLogin()
    {
        // إذا المستخدم سجل مسبقًا ولم يتم تسجيل خروجه
        if (session()->has('user_name')) {
            return $this->redirectToDashboard(session('user_name'));
        }

        return view('login_user_admin');
    }

    /**
     * تنفيذ تسجيل الدخول
     */
    public function login(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // محاولة جلب المستخدم من قاعدة البيانات
        $user = UserAdmin::where('username', $request->username)
                         ->where('password', $request->password) // ✅ لاحقًا استخدم Hash::check()
                         ->first();

        if ($user) {
            // تخزين بيانات الجلسة
            session([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            // إذا تم تفعيل خيار "تذكرني"
            if ($request->has('remember')) {
                session(['remember_me' => true, 'last_activity' => now()]);
            }

            // توجيه حسب اسم المستخدم
            return $this->redirectToDashboard($user->name);
        }

        return back()->with('error', '❌ اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    /**
     * توجيه المستخدم إلى صفحة الداشبورد المناسبة حسب اسمه
     */
    private function redirectToDashboard(string $name)
    {
        return match ($name) {
            'أبو فراس' => view('abofiras_dashboard'),
            'أحمد'     => view('ahmad_dashboard'),
            'ديما'     => view('deema_dashboard'),
            default    => redirect('/login')->with('error', '🚫 المستخدم غير معروف'),
        };
    }

    /**
     * تنفيذ تسجيل الخروج
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('error', '✅ تم تسجيل الخروج بنجاح');
    }
}
