<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSection;

class CourseSectionController extends Controller
{
    /**
     * عرض فورم إدخال شعبة جديدة
     */
    public function showUploadForm($course_number)
    {
        $course = Course::where('course_number', $course_number)->first();

        if (!$course) {
            return redirect()->route('courses.index')->with('error', '❌ رقم الدورة غير موجود.');
        }

        return view('course_sections_upload_form', compact('course_number'));
    }

    /**
     * تخزين شعبة جديدة يدوياً من فورم
     */
    public function store(Request $request, $course_number)
    {
        $request->validate([
            'section_id'       => 'required|unique:course_sections,section_id',
            'start_date'       => 'required|date',
            'room_number'      => 'required|string|max:255',
            'instructor_name'  => 'required|string|max:255',
            'status'           => 'required|string|in:مفتوحة,مغلقة,ممتلئة,جارية,منتهية',
        ]);

        // تحقق من وجود الدورة
        $course = Course::where('course_number', $course_number)->first();
        if (!$course) {
            return redirect()->route('courses.index')->with('error', '❌ رقم الدورة غير صالح.');
        }

        // تخزين الشعبة
        CourseSection::create([
            'course_number'    => $course_number,
            'section_id'       => $request->section_id,
            'start_date'       => $request->start_date,
            'room_number'      => $request->room_number,
            'instructor_name'  => $request->instructor_name,
            'status'           => $request->status,
        ]);

        return redirect()->route('courses.index')->with('success', '✅ تم إضافة الشعبة بنجاح.');
    }

    /**
     * عرض جميع الشعب في صفحة واحدة
     */
    public function index()
    {
        $sections = CourseSection::orderBy('start_date')->get(); // ✅ ترتيب حسب تاريخ البدء
        return view('course_sections_index', compact('sections'));
    }
    public function viewByCourse($course_number)
{
    $course = Course::where('course_number', $course_number)->first();

    if (!$course) {
        return redirect()->route('courses.index')->with('error', '❌ رقم الدورة غير موجود.');
    }

    $sections = $course->sections ?? [];

    return view('course_sections_index', compact('sections', 'course'));
}

}
