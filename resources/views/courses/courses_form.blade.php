@extends('layouts.layout')


@section('title', 'تسجيل دورة جديدة')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0 p-4">
    <h4 class="text-center text-primary fw-bold mb-4">📝 نموذج تسجيل دورة</h4>

    {{-- ✅ رسالة نجاح --}}
    @if(session('success'))
      <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
    @endif

    {{-- ⚠️ رسائل الخطأ --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0 text-center list-unstyled">
          @foreach($errors->all() as $error)
            <li>⚠️ {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- 🧾 نموذج الإدخال --}}
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- 🔢 رقم الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">🔢 رقم الدورة</label>
        <input type="text" name="course_number" class="form-control text-center fw-bold" required pattern="\d+">
      </div>

      {{-- 📘 اسم الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📘 اسم الدورة</label>
        <input type="text" name="name" class="form-control text-center fw-bold" required>
      </div>

      {{-- ⏱ عدد الساعات --}}
      <div class="mb-3">
        <label class="form-label fw-bold">⏱ عدد الساعات</label>
        <input type="number" name="hours" class="form-control text-center fw-bold" min="1" required>
      </div>

      {{-- 📝 وصف الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📝 وصف الدورة</label>
        <textarea name="description" rows="3" class="form-control text-center fw-bold"></textarea>
      </div>

      {{-- 📎 مرفق الدورة --}}
      <div class="mb-3">
        <label class="form-label fw-bold">📎 مرفق الدورة (PDF, Word, Excel, صور...)</label>
        <input type="file" name="attachment" class="form-control"
               accept=".pdf,.doc,.docx,.txt,.ppt,.pptx,.jpg,.jpeg,.png,.xls,.xlsx,.csv,.zip,.rar">
        <small class="text-muted">📌 اختيار المرفق اختياري، والحد الأقصى 20MB</small>
      </div>

      {{-- ✅ الأزرار --}}
      <div class="d-flex justify-content-center gap-3 mt-4">
        <button type="submit" class="btn btn-success px-4 fw-bold">💾 حفظ الدورة</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4 fw-bold">📋 عرض الدورات</a>
      </div>
    </form>
  </div>
</div>
@endsection
