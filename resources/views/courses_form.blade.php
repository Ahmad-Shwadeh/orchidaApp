{{-- resources/views/courses_form.blade.php --}}
@extends('layout')

@section('title', 'تسجيل دورة جديدة')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0 p-4">
    <h4 class="text-center text-primary fw-bold mb-4">📝 نموذج تسجيل دورة</h4>

    {{-- رسالة نجاح --}}
    @if(session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- رسالة خطأ --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0 text-center">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- نموذج الإدخال --}}
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-bold">🔢 رقم الدورة</label>
        <input type="text" name="course_number" class="form-control text-center" required pattern="\d+">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">📘 اسم الدورة</label>
        <input type="text" name="name" class="form-control text-center" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">⏱ عدد الساعات</label>
        <input type="number" name="hours" class="form-control text-center" required min="1">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">📝 وصف الدورة</label>
        <textarea name="description" rows="3" class="form-control text-center"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">📎 مرفق الدورة (...PDF , Word , XLS , RAR , PNG)</label>
        <input type="file" name="attachment" class="form-control"
       accept=".pdf,.doc,.docx,.txt,.ppt,.pptx,.jpg,.png,.xls,.xlsx,.csv">

      </div>

      <div class="d-flex justify-content-center gap-3">
        <button type="submit" class="btn btn-success px-4">💾 حفظ الدورة</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4">📋 عرض الدورات</a>
      </div>
    </form>
  </div>
</div>
@endsection
