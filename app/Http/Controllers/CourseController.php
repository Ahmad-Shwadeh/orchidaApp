<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * عرض صفحة إنشاء دورة جديدة
     */
    public function create()
    {
        return view('courses_form'); // صفحة الفورم
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
     * حفظ دورة جديدة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|integer|unique:courses,course_number',
            'name'          => 'required|string|max:255',
            'hours'         => 'required|integer|min:1',
            'description'   => 'nullable|string',
        ]);

        DB::table('courses')->insert([
            'course_number' => $request->input('course_number'),
            'name'          => $request->input('name'),
            'hours'         => $request->input('hours'),
            'description'   => $request->input('description'),
        ]);

        return redirect()->back()->with('success', '✅ تم حفظ الدورة بنجاح.');
    }

    /**
     * عرض نموذج تعديل دورة
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
        ]);

        DB::table('courses')
            ->where('course_number', $course_number)
            ->update([
                'name'        => $request->input('name'),
                'hours'       => $request->input('hours'),
                'description' => $request->input('description'),
            ]);

        return redirect()->route('courses.index')->with('success', '✅ تم تعديل الدورة بنجاح.');
    }
    public function destroy($course_number)
{
    DB::table('courses')->where('course_number', $course_number)->delete();
    return redirect()->route('courses.index')->with('success', '🗑 تم حذف الدورة بنجاح.');
}

}
