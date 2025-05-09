<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NetworkUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class NetworkUserController extends Controller
{
    /**
     * عرض نموذج رفع الملف
     */
    public function showUploadForm()
    {
        return view('upload_preview');
    }

    /**
     * استيراد العمود الأول من ملف Excel وتخزينه
     */
    public function importSimple(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:20480'
        ]);

        $filename = uniqid('excel_') . '.' . $request->file('excel_file')->getClientOriginalExtension();
        $path = $request->file('excel_file')->storeAs('attachments', $filename, 'public');
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            return redirect()->route('network.upload')->with('error', '❌ فشل في الوصول إلى الملف المرفوع.');
        }

        $data = Excel::toArray([], $fullPath);
        $rows = $data[0] ?? [];

        if (count($rows) < 2) {
            Storage::disk('public')->delete($path);
            return back()->with('error', '⚠️ الملف لا يحتوي على بيانات كافية.');
        }

        $inserted = 0;
        $skipped = [];

        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            $username = trim($row[0] ?? '');

            if (!$username || NetworkUser::where('username', $username)->exists()) {
                $skipped[] = [$username];
                continue;
            }

            NetworkUser::create([
                'username'     => $username,
                'status'       => 0,
                'attachment'   => $path,
                'assigned_at'  => now(),
                'last_update'  => now(),
            ]);

            $inserted++;
        }

        $skippedFile = null;
        if (!empty($skipped)) {
            $skippedPath = 'public/skipped/skipped_' . now()->format('Ymd_His') . '.xlsx';

            Excel::store(new class($skipped) implements FromCollection {
                protected $rows;
                public function __construct(array $rows) {
                    $this->rows = new Collection($rows);
                }
                public function collection() {
                    return $this->rows;
                }
            }, $skippedPath, 'local');

            $skippedFile = asset(str_replace('public/', 'storage/', $skippedPath));
        }

        Storage::disk('public')->delete($path);

        if ($skippedFile) {
            return redirect()->route('network.upload')->with('error',
                '⚠️ تم تجاهل بعض الصفوف. <a href="' . $skippedFile . '" class="btn btn-warning btn-sm mt-2" target="_blank">تحميل الصفوف المرفوضة</a>'
            );
        }

        return redirect()->route('network.upload')->with('success', '✅ تم تخزين ' . $inserted . ' مستخدم جديد بنجاح.');
    }

    /**
     * عرض المستخدمين حسب تاريخ التخصيص (الأقدم أولًا)
     */
    public function list()
    {
        $users = NetworkUser::orderBy('assigned_at', 'asc')->get(); // ← حسب الأقدم
        return view('network_users_index', compact('users'));
    }

    /**
     * حذف جميع المستخدمين
     */
    public function clearAll()
    {
        NetworkUser::truncate();
        return redirect()->route('network.users')->with('success', '🗑 تم حذف جميع المستخدمين بنجاح.');
    }
}
