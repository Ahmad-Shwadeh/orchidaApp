@extends('layout')

@section('title', '📥 استيراد طلاب من ملف Excel')

@section('content')
<div class="container-fluid">

  {{-- ✅ عنوان الصفحة وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-primary mb-0">
      📥 استيراد طلاب إلى الشعبة رقم <span class="text-dark">{{ $section_id }}</span>
    </h4>
    <a href="{{ route('sections.byCourse', ['course_number' => $course_number]) }}" class="btn btn-secondary shadow-sm">
      <i class="bi bi-arrow-left-circle"></i> الرجوع إلى الشعب
    </a>
  </div>

  {{-- ✅ رسائل التنبيه --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! session('success') !!}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! session('error') !!}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif

  {{-- ✅ كارد نموذج رفع الطلاب --}}
  <div class="card border-0 shadow rounded-4 mb-5">
    <div class="card-header bg-dark text-white">
      <i class="bi bi-upload"></i> رفع ملف Excel لبيانات الطلاب
    </div>

    <div class="card-body">
      <form action="{{ route('students.import', ['course_number' => $course_number, 'section_id' => $section_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ✅ تمرير رقم الدورة والشعبة --}}
        <input type="hidden" name="course_number" value="{{ $course_number }}">
        <input type="hidden" name="section_id" value="{{ $section_id }}">

        {{-- ✅ اختيار الملف --}}
        <div class="mb-3">
          <label for="excel_file" class="form-label fw-bold">📁 اختر ملف Excel</label>
          <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xls,.xlsx,.csv" required>
        </div>

        {{-- ✅ ملاحظة تنسيقية --}}
        <div class="alert alert-warning small">
          ⚠️ تأكد أن الملف يحتوي على <strong>3 أعمدة مرتبة بدون رؤوس</strong>:
          <ul class="mb-0 mt-2">
            <li>1️⃣ <strong>رقم الطالب</strong> (student_id)</li>
            <li>2️⃣ <strong>اسم الطالب</strong> (name)</li>
            <li>3️⃣ <strong>رقم الهاتف</strong> (phone)</li>
          </ul>
        </div>

        {{-- ✅ زر رفع ومعالجة --}}
        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-cloud-arrow-up-fill"></i> رفع ومعالجة الملف
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
