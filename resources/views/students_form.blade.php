@extends('layout')

@section('title', '🧑‍🎓 تسجيل طالب جديد')

@section('content')
<div class="container-fluid">

  {{-- ✅ عنوان الصفحة وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">🧑‍🎓 تسجيل طالب في الشعبة رقم {{ $section_id }}</h4>
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

  {{-- ✅ نموذج تسجيل الطالب --}}
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
      <i class="bi bi-person-plus-fill"></i> نموذج تسجيل طالب جديد
    </div>

    <div class="card-body">
      <form action="{{ route('students.store', ['course_number' => $course_number, 'section_id' => $section_id]) }}" method="POST">
        @csrf

        {{-- تمرير رقم الدورة والشعبة --}}
        <input type="hidden" name="course_number" value="{{ $course_number }}">
        <input type="hidden" name="section_id" value="{{ $section_id }}">

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="student_id" class="form-label">🆔 رقم الطالب</label>
            <input type="text" name="student_id" id="student_id" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="name" class="form-label">👤 الاسم الكامل</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="phone" class="form-label">📞 رقم الجوال</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check2-circle"></i> حفظ الطالب
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
