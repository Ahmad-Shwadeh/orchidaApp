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

        return view('sections.course_sections_upload_form', compact('course_number'));
    }

    /**
     * تخزين شعبة جديدة يدوياً
     */
    public function store(Request $request, $course_number)
    {
        $request->validate([
            'section_id'      => 'required|unique:course_sections,section_id',
            'start_date'      => 'required|date',
            'room_number'     => 'required|string|max:255',
            'instructor_name' => 'required|string|max:255',
            'status'          => 'required|in:مفتوحة,مغلقة,ممتلئة,جارية,منتهية',
        ]);

        $course = Course::where('course_number', $course_number)->first();
        if (!$course) {
            return redirect()->route('courses.index')->with('error', '❌ رقم الدورة غير صالح.');
        }

        CourseSection::create([
            'course_number'    => $course_number,
            'section_id'       => $request->section_id,
            'start_date'       => $request->start_date,
            'room_number'      => $request->room_number,
            'instructor_name'  => $request->instructor_name,
            'status'           => $request->status,
        ]);

        return redirect()->route('sections.byCourse', ['course_number' => $course_number])
            ->with('success', '✅ تم إضافة الشعبة بنجاح.');
    }

    /**
     * عرض جميع الشعب (للأغراض العامة)
     */
    public function index()
    {
        $sections = CourseSection::orderBy('start_date')->get();
        return view('sections.course_sections_index', compact('sections'));
    }

    /**
     * عرض الشعب التابعة لدورة معينة
     */
    public function viewByCourse($course_number)
    {
        $course = Course::where('course_number', $course_number)->first();

        if (!$course) {
            return redirect()->route('courses.index')->with('error', '❌ رقم الدورة غير موجود.');
        }

        $sections = $course->sections ?? [];

        return view('sections.course_sections_index', compact('sections', 'course'));
    }

    /**
     * عرض فورم تعديل الشعبة
     */
    public function edit($section_id)
    {
        $section = CourseSection::where('section_id', $section_id)->first();

        if (!$section) {
            return redirect()->back()->with('error', '❌ لم يتم العثور على الشعبة.');
        }

        return view('sections.course_sections_edit', compact('section'));
    }

    /**
     * تحديث بيانات شعبة
     */
    public function update(Request $request, $section_id)
    {
        $section = CourseSection::where('section_id', $section_id)->first();

        if (!$section) {
            return redirect()->back()->with('error', '❌ لم يتم العثور على الشعبة.');
        }

        $request->validate([
            'start_date'      => 'required|date',
            'room_number'     => 'required|string|max:255',
            'instructor_name' => 'required|string|max:255',
            'status'          => 'required|in:مفتوحة,مغلقة,ممتلئة,جارية,منتهية',
        ]);

        $section->update([
            'start_date'      => $request->start_date,
            'room_number'     => $request->room_number,
            'instructor_name' => $request->instructor_name,
            'status'          => $request->status,
        ]);

        return redirect()->route('sections.byCourse', ['course_number' => $section->course_number])
            ->with('success', '✅ تم تعديل الشعبة بنجاح.');
    }

    /**
     * حذف شعبة
     */
    public function destroy($section_id)
    {
        $section = CourseSection::where('section_id', $section_id)->first();

        if (!$section) {
            return redirect()->back()->with('error', '❌ لم يتم العثور على الشعبة.');
        }

        $course_number = $section->course_number;
        $section->delete();

        return redirect()->route('sections.byCourse', ['course_number' => $course_number])
            ->with('success', '🗑️ تم حذف الشعبة بنجاح.');
    }
}
