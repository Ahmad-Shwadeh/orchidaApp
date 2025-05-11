<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MikrotikUserImportController extends Controller
{
    /**
     * عرض صفحة رفع المستخدمين
     */
    public function showForm()
    {
        return view('mikrotik.import');
    }

    /**
     * حفظ المستخدمين بعد التأكيد
     */
    public function import(Request $request)
    {
        $users = json_decode($request->input('confirmed_users'), true);

        if (!is_array($users) || empty($users)) {
            return back()->with('error', '⚠️ لا توجد بيانات صالحة للاستيراد.');
        }

        $inserted = 0;
        $skipped = [];

        foreach ($users as $username) {
            $username = trim($username);

            if (empty($username) || DB::table('network_users')->where('username', $username)->exists()) {
                $skipped[] = $username;
                continue;
            }

            DB::table('network_users')->insert([
                'username' => $username,
                'status'   => 0, // ✅ 0 تعني غير مستخدم
            ]);

            $inserted++;
        }

        $message = "✅ تم إدخال $inserted مستخدم بنجاح.";
        if (!empty($skipped)) {
            $message .= ' ⚠️ تم تجاهل بعض الأسماء المكررة أو الفارغة.';
        }

        return back()->with('success', $message);
    }
}
