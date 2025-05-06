<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * عرض نموذج إضافة دورة جديدة
     */
    public function create()
    {
        return view('courses_form');
    }

    /**
     * عرض كل الدورات
     */
    public function index()
    {
        $courses = DB::table('courses')->get();
        return view('courses_index', compact('courses'));
    }

    /**
     * حفظ دورة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|integer|unique:courses,course_number',
            'name'          => 'required|string|max:255',
            'hours'         => 'required|integer|min:1',
            'description'   => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt,rtf,odt,xls,xlsx,csv,ods,jpg,jpeg,png,gif,bmp,svg,webp,ppt,pptx,odp,zip,rar,7z,tar,gz|max:20480'
// 20MB
        ]);

        $filename = null;
        if ($request->hasFile('attachment')) {
            $filename = $request->file('attachment')->store('attachments', 'public');
        }

        DB::table('courses')->insert([
            'course_number' => $request->input('course_number'),
            'name'          => $request->input('name'),
            'hours'         => $request->input('hours'),
            'description'   => $request->input('description'),
            'attachment'    => $filename,
        ]);

        return redirect()->back()->with('success', '✅ تم حفظ الدورة بنجاح.');
    }

    /**
     * عرض نموذج تعديل الدورة
     */
    public function edit($course_number)
    {
        $course = DB::table('courses')->where('course_number', $course_number)->first();

        if (!$course) {
            return redirect()->route('courses.index')->with('error', '❌ لم يتم العثور على الدورة');
        }

        return view('courses_edit', compact('course'));
    }

    /**
     * تحديث بيانات الدورة
     */
    public function update(Request $request, $course_number)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'hours'       => 'required|integer|min:1',
            'description' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt,rtf,odt,xls,xlsx,csv,ods,jpg,jpeg,png,gif,bmp,svg,webp,ppt,pptx,odp,zip,rar,7z,tar,gz|max:20480'
// 20MB
        ]);

        $course = DB::table('courses')->where('course_number', $course_number)->first();

        $filename = $course->attachment;
        if ($request->hasFile('attachment')) {
            // حذف المرفق القديم إن وجد
            if ($filename && Storage::disk('public')->exists($filename)) {
                Storage::disk('public')->delete($filename);
            }

            // تخزين الملف الجديد
            $filename = $request->file('attachment')->store('attachments', 'public');
        }

        DB::table('courses')
            ->where('course_number', $course_number)
            ->update([
                'name'        => $request->input('name'),
                'hours'       => $request->input('hours'),
                'description' => $request->input('description'),
                'attachment'  => $filename,
            ]);

        return redirect()->route('courses.index')->with('success', '✅ تم تعديل الدورة بنجاح.');
    }

    /**
     * حذف الدورة
     */
    public function destroy($course_number)
    {
        $course = DB::table('courses')->where('course_number', $course_number)->first();

        // حذف المرفق من السيرفر إن وجد
        if ($course && $course->attachment && Storage::disk('public')->exists($course->attachment)) {
            Storage::disk('public')->delete($course->attachment);
        }

        DB::table('courses')->where('course_number', $course_number)->delete();

        return redirect()->route('courses.index')->with('success', '🗑 تم حذف الدورة بنجاح.');
    }
}
