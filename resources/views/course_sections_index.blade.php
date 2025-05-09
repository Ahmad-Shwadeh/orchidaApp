@extends('layout')

@section('title', '📋 عرض جميع الشعب')

@section('content')
<div class="container-fluid">

  {{-- ✅ العنوان وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">
      📘 الشعب التابعة لدورة  <span class="text-dark">{{ $course->name ?? '—' }}</span>
    </h4>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle"></i> الرجوع إلى قائمة الدورات
    </a>
  </div>

  {{-- ✅ شريط البحث --}}
  <div class="mb-3">
    <input type="text" id="sectionSearch" class="form-control text-center fw-bold" placeholder="🔍 ابحث برقم الشعبة أو اسم المدرب أو القاعة...">
  </div>

  {{-- ✅ جدول عرض الشعب --}}
  <div class="card shadow rounded-4 p-4 border-0">
    @if($sections->isEmpty())
      <div class="alert alert-info text-center fs-5 mb-0">🚫 لا توجد شعب مسجلة حالياً لهذه الدورة.</div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>🏷️ رقم الشعبة</th>
              <th>📘 رقم الدورة</th>
              <th>📅 تاريخ البدء</th>
              <th>🏫 رقم القاعة</th>
              <th>👨‍🏫 اسم المدرّب</th>
              <th>🔖 الحالة</th>
              <th>🎓 الطلاب</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sections as $section)
              <tr>
                <td>{{ $section->section_id }}</td>
                <td>{{ $section->course_number }}</td>
                <td>{{ $section->start_date }}</td>
                <td>{{ $section->room_number }}</td>
                <td>{{ $section->instructor_name }}</td>
                <td>
                  @php
                    $statusColors = [
                      'مفتوحة' => 'success',
                      'ممتلئة' => 'warning',
                      'مغلقة'  => 'danger',
                      'جارية'  => 'info',
                      'منتهية' => 'secondary'
                    ];
                  @endphp
                  <span class="badge bg-{{ $statusColors[$section->status] ?? 'dark' }}">
                    {{ $section->status }}
                  </span>
                </td>

                {{-- ✅ زر الطلاب --}}
                <td class="d-flex flex-column gap-1">
                  <a href="{{ route('students.create', ['course_number' => $course->course_number, 'section_id' => $section->section_id]) }}"
                     class="btn btn-outline-success btn-sm">
                    ➕ تسجيل طالب
                  </a>

                  <a href="{{ route('students.importForm', [$course->course_number, $section->section_id]) }}"
                     class="btn btn-outline-primary btn-sm">
                    📥 استيراد طلاب
                  </a>

                  <a href="{{ route('students.index', ['section_id' => $section->section_id]) }}"
                     class="btn btn-outline-info btn-sm">
                    👁️ عرض الطلاب
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

</div>

{{-- ✅ سكربت الفلترة --}}
@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("sectionSearch");
    const rows = document.querySelectorAll("table tbody tr");

    searchInput.addEventListener("input", function () {
      const query = this.value.toLowerCase();
      rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
      });
    });
  });
</script>
@endpush

@endsection
