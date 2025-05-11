@extends('layouts.layout')


@section('title', 'تعديل دورة')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0 p-4">
    <h4 class="text-center text-primary fw-bold mb-4">✏️ تعديل بيانات الدورة</h4>

    {{-- ✅ رسالة نجاح أو خطأ --}}
    @if(session('success'))
      <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger text-center fw-bold">{{ session('error') }}</div>
    @endif

    {{-- ✅ نموذج تعديل الدورة --}}
    <form action="{{ route('courses.update', $course->course_number) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- 🔢 رقم الدورة (غير قابل للتعديل) --}}
      <div class="mb-3">
        <label class="form-label fw-bold">🔢 رقم الدورة</label>
        <input type="text" class="form-control text-center bg-light" value="{{ $course->course_number }}" readonly disabled>
      </div>

      {{-- 📘 اسم الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📘 اسم الدورة</label>
        <input type="text" name="name" value="{{ $course->name }}" class="form-control text-center fw-bold" required>
      </div>

      {{-- ⏱ عدد الساعات --}}
      <div class="mb-3">
        <label class="form-label fw-bold">⏱ عدد الساعات</label>
        <input type="number" name="hours" value="{{ $course->hours }}" class="form-control text-center fw-bold" min="1" required>
      </div>

      {{-- 📝 وصف الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📝 وصف الدورة</label>
        <textarea name="description" rows="3" class="form-control text-center fw-bold">{{ $course->description }}</textarea>
      </div>

      {{-- 📎 عرض المرفق الحالي (إن وجد) --}}
      @if($course->attachment)
        <div class="mb-3 text-center">
          <label class="form-label fw-bold">📎 المرفق الحالي:</label>
          <div class="d-flex justify-content-center gap-2">
            <a href="{{ asset('storage/' . $course->attachment) }}" class="btn btn-outline-info btn-sm" target="_blank">👁️ عرض</a>
            <a href="{{ asset('storage/' . $course->attachment) }}" class="btn btn-outline-primary btn-sm" download>📥 تحميل</a>
          </div>
        </div>
      @endif

      {{-- 📤 رفع مرفق جديد (اختياري) --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📤 استبدال المرفق (اختياري)</label>
        <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.txt,.ppt,.pptx,.jpg,.jpeg,.png,.xls,.xlsx,.csv">
        <small class="text-muted">📌 سيتم حذف المرفق القديم تلقائياً عند رفع مرفق جديد.</small>
      </div>

      {{-- ✅ الأزرار --}}
      <div class="d-flex justify-content-center gap-3">
        <button type="submit" class="btn btn-warning px-4 fw-bold">💾 حفظ التعديلات</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4">↩️ العودة</a>
      </div>
    </form>
  </div>
</div>
@endsection
