<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = DB::table('users_admins')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role
            ]);

            // توجيه حسب الدور
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'secretary') {
                return redirect('/secretary/dashboard');
            } else {
                return redirect('/viewer/dashboard');
            }
        }

        return back()->with('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
