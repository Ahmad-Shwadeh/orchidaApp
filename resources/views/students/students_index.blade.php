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

  {{-- ✅ فورم حفظ الجميع --}}
  <form action="{{ route('students.bulkUpdate') }}" method="POST">
    @csrf

    {{-- ✅ زر حفظ الجميع بمحاذاة عمود الحفظ (على جهة الشمال) --}}
    <div class="d-flex justify-content-end mb-2">
      <button type="submit" class="btn btn-primary">
        💾 حفظ الجميع
      </button>
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
                <tr>
                  <td>{{ $student->student_id }}</td>
                  <td>{{ $student->name }}</td>
                  <td>{{ $student->phone }}</td>
                  <td>
                    <select name="status[{{ $student->student_id }}]" class="form-select form-select-sm 
                      @switch($student->status)
                        @case('مدفوع') bg-success text-white @break
                        @case('غيرمدفوع') bg-warning text-dark @break
                        @case('لايرد') bg-danger text-white @break
                        @case('إلغاء') bg-secondary text-white @break
                        @case('موعد') bg-info text-dark @break
                        @default bg-light text-dark
                      @endswitch">
                      <option value="جديد"      {{ $student->status == 'جديد' ? 'selected' : '' }}>جديد</option>
                      <option value="إلغاء"     {{ $student->status == 'إلغاء' ? 'selected' : '' }}>إلغاء</option>
                      <option value="لايرد"     {{ $student->status == 'لايرد' ? 'selected' : '' }}>لا يرد</option>
                      <option value="موعد"      {{ $student->status == 'موعد' ? 'selected' : '' }}>يريد موعد آخر</option>
                      <option value="مدفوع"     {{ $student->status == 'مدفوع' ? 'selected' : '' }}>سجل ودفع</option>
                      <option value="غيرمدفوع" {{ $student->status == 'غيرمدفوع' ? 'selected' : '' }}>سجل لم يدفع</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="notes[{{ $student->student_id }}]" value="{{ $student->notes }}" class="form-control form-control-sm" placeholder="اكتب ملاحظات">
                  </td>
                  <td>
                    <form action="{{ route('students.updateStatus', ['student_id' => $student->student_id]) }}" method="POST" class="d-inline">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="">
                      <input type="hidden" name="notes" value="">
                      <button type="submit" class="btn btn-sm btn-outline-success save-single">💾</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </form>
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

{{-- ✅ سكربت الفلترة + زر الحفظ الفردي --}}
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

    // ✅ زر حفظ فردي يجلب القيم الجديدة قبل الإرسال
    document.querySelectorAll(".save-single").forEach(btn => {
      btn.addEventListener("click", function (e) {
        const form = this.closest("form");
        const row = this.closest("tr");
        const status = row.querySelector("select").value;
        const notes = row.querySelector("input[type=text]").value;

        form.querySelector("input[name='status']").value = status;
        form.querySelector("input[name='notes']").value = notes;
      });
    });
  });
</script>
@endpush

@endsection
