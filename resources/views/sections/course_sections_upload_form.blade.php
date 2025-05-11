@extends('layouts.layout')


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

  {{-- ✅ نموذج إضافة شعبة --}}
  <div class="card shadow-sm mb-4 border-0 rounded-4">
    <div class="card-header bg-dark text-white fw-bold">
      <i class="bi bi-plus-circle"></i> إضافة شعبة جديدة
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('sections.store', $course_number) }}">
        @csrf

        {{-- 🔢 رقم الدورة (مخفي) --}}
        <input type="hidden" name="course_number" value="{{ $course_number }}">

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="section_id" class="form-label fw-bold">🔢 رقم الشعبة</label>
            <input type="text" id="section_id" name="section_id" class="form-control text-center" required>
          </div>

          <div class="col-md-6">
            <label for="start_date" class="form-label fw-bold">📅 تاريخ البدء</label>
            <input type="date" id="start_date" name="start_date" class="form-control text-center" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="room_number" class="form-label fw-bold">🏫 رقم القاعة</label>
            <input type="text" id="room_number" name="room_number" class="form-control text-center" required>
          </div>

          <div class="col-md-6">
            <label for="instructor_name" class="form-label fw-bold">👨‍🏫 اسم المدرّب</label>
            <input type="text" id="instructor_name" name="instructor_name" class="form-control text-center" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="status" class="form-label fw-bold">🛠️ حالة الشعبة</label>
          <select name="status" id="status" class="form-select text-center" required>
            <option value="">— اختر الحالة —</option>
            <option value="مفتوحة">مفتوحة</option>
            <option value="ممتلئة">ممتلئة</option>
            <option value="مغلقة">مغلقة</option>
            <option value="جارية">جارية</option>
            <option value="منتهية">منتهية</option>
          </select>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success fw-bold">
            <i class="bi bi-save-fill"></i> حفظ الشعبة
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
