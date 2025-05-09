@extends('layout')

@section('title', '📋 عرض جميع الشعب')

@section('content')
<div class="container-fluid">

  {{-- ✅ عنوان وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="text-primary fw-bold mb-0">
  📘 الشعب التابعة لـ الدورة رقم {{ $course->course_number ?? '—' }}
</h4>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle"></i> الرجوع إلى الدورات
    </a>
  </div>

  {{-- ✅ شريط البحث --}}
  <div class="mb-3">
    <input type="text" id="sectionSearch" class="form-control text-center fw-bold" placeholder="🔍 ابحث برقم الشعبة أو اسم المدرب أو القاعة...">
  </div>

  {{-- ✅ جدول الشعب --}}
  <div class="card shadow rounded-4 p-4 border-0">
    @if($sections->isEmpty())
      <div class="alert alert-info text-center fs-5">🚫 لا توجد شعب مسجلة حالياً.</div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>🏷️ رقم الشعبة</th>
              <th>📘 رقم الدورة</th>
              <th>📅 تاريخ البدء</th>
              <th>🏫 رقم القاعة</th>
              <th>👨‍🏫 اسم المدرّب</th>
              <th>🔖 الحالة</th>
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
                      'مغلقة' => 'danger',
                      'جارية'  => 'info',
                      'منتهية' => 'secondary'
                    ];
                  @endphp
                  <span class="badge bg-{{ $statusColors[$section->status] ?? 'dark' }}">{{ $section->status }}</span>
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
