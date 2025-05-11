@extends('layouts.layout')


@section('title', '👨‍🎓 قائمة الطلاب في الشعبة')

@section('content')
<div class="container-fluid">

  {{-- ✅ العنوان وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">
      👨‍🎓 الطلاب في الشعبة رقم {{ $section->section_id }} - الدورة: {{ $section->course->name ?? '—' }}
    </h4>
    <a href="{{ route('sections.byCourse', ['course_number' => $section->course_number]) }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle"></i> الرجوع إلى الشعب
    </a>
  </div>

  {{-- ✅ شريط البحث --}}
  <div class="mb-3">
    <input type="text" id="studentSearch" class="form-control text-center fw-bold"
           placeholder="🔍 ابحث برقم الطالب أو الاسم أو الجوال...">
  </div>

  {{-- ✅ جدول عرض الطلاب --}}
  <div class="card shadow-sm rounded-4 p-4 border-0">
    @if($students->isEmpty())
      <div class="alert alert-info text-center fs-5">🚫 لا يوجد طلاب مسجلون في هذه الشعبة حالياً.</div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>🆔 رقم الطالب</th>
              <th>👤 الاسم الكامل</th>
              <th>📞 رقم الجوال</th>
              <th>📌 الحالة</th>
              <th>📝 ملاحظات</th>
              <th>💾 حفظ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($students as $student)
              <form action="{{ route('students.updateStatus', ['student_id' => $student->student_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <tr>
                  <td>{{ $student->student_id }}</td>
                  <td>{{ $student->name }}</td>
                  <td>{{ $student->phone }}</td>
                  <td>
                    <select name="status" class="form-select form-select-sm">
                      <option value="جديد"      {{ $student->status == 'جديد' ? 'selected' : '' }}>جديد</option>
                      <option value="إلغاء"     {{ $student->status == 'إلغاء' ? 'selected' : '' }}>إلغاء</option>
                      <option value="لايرد"     {{ $student->status == 'لايرد' ? 'selected' : '' }}>لا يرد</option>
                      <option value="موعد"      {{ $student->status == 'موعد' ? 'selected' : '' }}>يريد موعد آخر</option>
                      <option value="مدفوع"     {{ $student->status == 'مدفوع' ? 'selected' : '' }}>سجل ودفع</option>
                      <option value="غيرمدفوع" {{ $student->status == 'غيرمدفوع' ? 'selected' : '' }}>سجل لم يدفع</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="notes" value="{{ $student->notes }}" class="form-control form-control-sm" placeholder="اكتب ملاحظات">
                  </td>
                  <td>
                    <button type="submit" class="btn btn-sm btn-outline-success">💾</button>
                  </td>
                </tr>
              </form>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>

{{-- ✅ رسائل التنبيه --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {!! session('error') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
  </div>
@endif

{{-- ✅ سكربت الفلترة --}}
@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("studentSearch");
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
