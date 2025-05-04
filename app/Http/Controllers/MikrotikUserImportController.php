<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MikrotikUserImportController extends Controller
{
    public function showForm()
    {
        return view('mikrotik.import');
    }

    // public function preview(Request $request)
    // {
    //     $request->validate([
    //         'excel_file' => 'required|mimes:xlsx,xls,csv'
    //     ]);

    //     $data = Excel::toArray([], $request->file('excel_file'));
    //     $rows = $data[0]; // أول شيت

    //     return view('mikrotik.import', [
    //         'previewUsers' => $rows
    //     ]);
    // }

    public function import(Request $request)
    {
        $users = json_decode($request->input('confirmed_users'), true);

        foreach ($users as $username) {
            DB::table('network_users')->insert([
                'username' => $username,
                'status' => 0,
            ]);
        }

        return back()->with('success', '✅ تم حفظ المستخدمين في قاعدة البيانات بنجاح.');
    }
}
