@extends('layout')

@section('title', 'عرض جميع الدورات')

@section('content')
<div class="container py-4">

  {{-- ✅ شريط البحث --}}
  <div class="mb-4">
    <input type="text" id="courseSearch" class="form-control text-center fw-bold" placeholder="🔍 ابحث عن دورة برقمها أو اسمها...">
  </div>

  {{-- ✅ عنوان الصفحة وزر إضافة --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">📋 قائمة الدورات</h4>
    <div class="d-flex gap-2">
      <a href="{{ route('courses.create') }}" class="btn btn-success">
        ➕ إضافة دورة جديدة
      </a>
      
    </div>
  </div>

  {{-- ✅ جدول الدورات --}}
  <div class="card shadow rounded-4 p-4 border-0">
    @if($courses->isEmpty())
      <p class="text-center text-muted">لا توجد دورات مسجلة حالياً.</p>
    @else
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>🔢 رقم الدورة</th>
              <th>📘 اسم الدورة</th>
              <th>⏱ عدد الساعات</th>
              <th>📝 الوصف</th>
              <th>📎 المرفق</th>
              <th>🏫 الشعب</th>
              <th>⚙️ الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            @foreach($courses as $course)
              <tr>
                <td>{{ $course->course_number }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->hours }}</td>
                <td>{{ $course->description }}</td>

                {{-- ✅ المرفق --}}
                <td>
                  @if($course->attachment)
                    <div class="d-flex gap-2 justify-content-center">
                      <a href="{{ asset('storage/' . $course->attachment) }}" class="btn btn-sm btn-outline-info" target="_blank">👁️ عرض</a>
                      <a href="{{ asset('storage/' . $course->attachment) }}" class="btn btn-sm btn-outline-primary" download>📥 تحميل</a>
                    </div>
                  @else
                    <span class="text-muted">لا يوجد</span>
                  @endif
                </td>

                {{-- ✅ عمود الشعب --}}
                <td>
                  {{-- زر إضافة شعبة --}}
                  <a href="{{ route('sections.uploadForm', ['course_number' => $course->course_number]) }}"
                     class="btn btn-outline-primary btn-sm mb-2">
                    🧩 افتح شعبة جديدة
                  </a>
                  
                  {{-- زر عرض الشعب الخاصة بالدورة --}}
  <a href="{{ route('sections.byCourse', ['course_number' => $course->course_number]) }}" class="btn btn-outline-info btn-sm">
    📋 عرض الشعب
  </a>
                  {{-- روابط الشعب --}}
                  @if(!empty($course->sections))
                    <div class="mt-2">
                      @foreach($course->sections as $section)
                        <a href="{{ route('sections.show', [$course->course_number, $section->section_id]) }}"
                           class="badge bg-info text-white text-decoration-none d-inline-block my-1">
                          📌 شعبة {{ $section->section_id }}
                        </a>
                      @endforeach
                    </div>
                  @else
                    <span class="text-muted small d-block mt-1">لا توجد شعب</span>
                  @endif
                </td>

                {{-- ✅ عمود الإجراءات --}}
<td class="d-flex flex-column gap-1">

  {{-- تعديل الدورة --}}
  <a href="{{ route('courses.edit', ['course' => $course->course_number]) }}"
     class="btn btn-warning btn-sm w-100">
    ✏️ تعديل
  </a>

  {{-- حذف الدورة --}}
  <form action="{{ route('courses.destroy', ['course_number' => $course->course_number]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm w-100"
            onclick="return confirm('هل أنت متأكد أنك تريد حذف هذه الدورة؟')">
      🗑️ حذف
    </button>
  </form>

</td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>

{{-- ✅ سكربت البحث --}}
@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("courseSearch");
    const tableRows = document.querySelectorAll("table tbody tr");

    searchInput.addEventListener("input", function () {
      const query = this.value.toLowerCase();
      tableRows.forEach(row => {
        const courseNumber = row.children[0].textContent.toLowerCase();
        const courseName = row.children[1].textContent.toLowerCase();
        row.style.display = (courseNumber.includes(query) || courseName.includes(query)) ? "" : "none";
      });
    });
  });
</script>
@endpush

@endsection
