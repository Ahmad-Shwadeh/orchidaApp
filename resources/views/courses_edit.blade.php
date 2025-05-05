@extends('layout')

@section('title', 'تعديل دورة')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0 p-4">
    <h4 class="text-center text-primary fw-bold mb-4">✏️ تعديل بيانات الدورة</h4>

    {{-- رسالة نجاح أو خطأ --}}
    @if(session('success'))
      <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger text-center fw-bold">{{ session('error') }}</div>
    @endif

    {{-- نموذج تعديل الدورة --}}
    <form action="{{ route('courses.update', $course->course_number) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-bold">🔢 رقم الدورة</label>
        <input type="text" class="form-control text-center" value="{{ $course->course_number }}" disabled>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">📘 اسم الدورة</label>
        <input type="text" name="name" value="{{ $course->name }}" class="form-control text-center" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">⏱ عدد الساعات</label>
        <input type="number" name="hours" value="{{ $course->hours }}" class="form-control text-center" required min="1">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">📝 وصف الدورة</label>
        <textarea name="description" rows="3" class="form-control text-center">{{ $course->description }}</textarea>
      </div>

      <div class="d-flex justify-content-center gap-3">
        <button type="submit" class="btn btn-warning px-4 fw-bold">💾 حفظ التعديلات</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4">↩️ العودة</a>
      </div>
    </form>
  </div>
</div>
@endsection
