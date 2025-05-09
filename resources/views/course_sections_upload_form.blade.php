@extends('layout')

@section('title', 'إضافة شعبة جديدة')

@section('content')
<div class="container-fluid">

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

  {{-- ✅ نموذج إدخال شعبة --}}
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
      <i class="bi bi-plus-circle"></i> إضافة شعبة جديدة
    </div>

    <div class="card-body">
      <form action="{{ route('sections.store', $course_number) }}" method="POST">
        @csrf

        {{-- رقم الدورة (مخفي) --}}
        <input type="hidden" name="course_number" value="{{ $course_number }}">

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="section_id" class="form-label">🔢 رقم الشعبة</label>
            <input type="text" name="section_id" id="section_id" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="start_date" class="form-label">📅 تاريخ البدء</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="room_number" class="form-label">🏫 رقم القاعة</label>
            <input type="text" name="room_number" id="room_number" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="instructor_name" class="form-label">👨‍🏫 اسم المدرّب</label>
            <input type="text" name="instructor_name" id="instructor_name" class="form-control" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="status" class="form-label">🛠️ حالة الشعبة</label>
          <select name="status" id="status" class="form-select" required>
            <option value="">— اختر الحالة —</option>
            <option value="مفتوحة">مفتوحة</option>
            <option value="ممتلئة">ممتلئة</option>
            <option value="مغلقة">مغلقة</option>
            <option value="جارية">جارية</option>
            <option value="منتهية">منتهية</option>
          </select>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill"></i> حفظ الشعبة
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
