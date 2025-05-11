<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\CourseSection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentController extends Controller
{
    /**
     * عرض الطلاب في شعبة معينة
     */
    public function index($section_id)
    {
        $section = CourseSection::with('course')->where('section_id', $section_id)->first();

        if (!$section) {
            return redirect()->route('courses.index')->with('error', '⚠️ لم يتم العثور على الشعبة.');
        }

        $students = Student::where('section_id', $section_id)
            ->orderBy('student_id', 'asc')
            ->get();

        return view('students.students_index', compact('students', 'section'));
    }

    /**
     * تحديث الحالة والملاحظات لطالب
     */
    public function updateStatus(Request $request, $student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        $student->status = $request->input('status');
        $student->notes  = $request->input('notes');
        $student->save();

        return redirect()->back()->with('success', '✅ تم تحديث حالة الطالب بنجاح.');
    }

    /**
     * عرض فورم استيراد الطلاب من Excel
     */
    public function showImportForm($course_number, $section_id)
    {
        return view('students.students_import_form', compact('course_number', 'section_id'));
    }

    /**
     * عرض فورم إضافة طالب يدويًا
     */
    public function create($course_number, $section_id)
    {
        return view('students.students_form', compact('course_number', 'section_id'));
    }

    /**
     * تخزين طالب جديد مُضاف يدويًا
     */
    public function store(Request $request, $course_number, $section_id)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
        ]);

        Student::create([
            'student_id'    => $request->student_id,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'course_number' => $course_number,
            'section_id'    => $section_id,
            'status'        => 'جديد',
        ]);

        return redirect()->back()->with('success', '✅ تم إضافة الطالب بنجاح.');
    }

    /**
     * استيراد بيانات الطلاب من ملف Excel
     */
    public function import(Request $request, $course_number, $section_id)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:20480',
        ]);

        $data = Excel::toArray([], $request->file('excel_file'));
        $rows = $data[0] ?? [];

        if (count($rows) < 1) {
            return back()->with('error', '⚠️ الملف لا يحتوي على بيانات.');
        }

        $inserted = 0;
        $skipped = [];

        foreach ($rows as $row) {
            $student_id = trim($row[0] ?? '');
            $name       = trim($row[1] ?? '');
            $phone      = trim($row[2] ?? '');

            if (!$student_id || !$name || !$phone || Student::where('student_id', $student_id)->exists()) {
                $skipped[] = [$student_id, $name, $phone];
                continue;
            }

            Student::create([
                'student_id'    => $student_id,
                'name'          => $name,
                'phone'         => $phone,
                'course_number' => $course_number,
                'section_id'    => $section_id,
                'status'        => 'جديد',
            ]);

            $inserted++;
        }

        // ✅ حفظ الصفوف المرفوضة في ملف قابل للتحميل
        if (!empty($skipped)) {
            $skippedPath = 'public/skipped/students_skipped_' . now()->format('Ymd_His') . '.xlsx';

            Excel::store(new class($skipped) implements FromCollection {
                protected $rows;
                public function __construct(array $rows) {
                    $this->rows = new Collection($rows);
                }
                public function collection() {
                    return $this->rows;
                }
            }, $skippedPath, 'local');

            $skippedLink = asset(str_replace('public/', 'storage/', $skippedPath));

            return redirect()->back()->with('error',
                '⚠️ تم تجاهل بعض الصفوف بسبب أخطاء. <a href="' . $skippedLink . '" class="btn btn-warning btn-sm mt-2" target="_blank">تحميل الصفوف المرفوضة</a>'
            );
        }

        return redirect()->back()->with('success', "✅ تم استيراد $inserted طالب بنجاح.");
    }
}
