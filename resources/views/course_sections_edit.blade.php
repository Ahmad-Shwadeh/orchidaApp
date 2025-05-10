@extends('layout')

@section('title', '🛠️ تعديل بيانات الشعبة')

@section('content')
<div class="container-fluid">

  {{-- ✅ العنوان وزر الرجوع --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">
      🛠️ تعديل الشعبة رقم {{ $section->section_id }}
    </h4>
    <a href="{{ route('sections.byCourse', ['course_number' => $section->course_number]) }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle"></i> الرجوع إلى قائمة الشعب
    </a>
  </div>

  {{-- ✅ التنبيهات --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! session('success') !!}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>⚠️ {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- ✅ نموذج التعديل --}}
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-dark text-white fw-bold">
      <i class="bi bi-pencil-square"></i> تعديل بيانات الشعبة
    </div>
    <div class="card-body">
      {{-- ✅ استخدم route الصحيح مع section_id --}}
      <form method="POST" action="{{ route('sections.update', $section->section_id) }}">
        @csrf
        @method('PUT')

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">📅 تاريخ البدء</label>
            <input type="date" name="start_date" class="form-control" value="{{ $section->start_date }}" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">🏫 رقم القاعة</label>
            <input type="text" name="room_number" class="form-control" value="{{ $section->room_number }}" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">👨‍🏫 اسم المدرب</label>
            <input type="text" name="instructor_name" class="form-control" value="{{ $section->instructor_name }}" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">🔖 الحالة</label>
            <select name="status" class="form-select" required>
              <option value="مفتوحة"  {{ $section->status == 'مفتوحة' ? 'selected' : '' }}>مفتوحة</option>
              <option value="مغلقة"   {{ $section->status == 'مغلقة' ? 'selected' : '' }}>مغلقة</option>
              <option value="ممتلئة"  {{ $section->status == 'ممتلئة' ? 'selected' : '' }}>ممتلئة</option>
              <option value="جارية"   {{ $section->status == 'جارية' ? 'selected' : '' }}>جارية</option>
              <option value="منتهية"  {{ $section->status == 'منتهية' ? 'selected' : '' }}>منتهية</option>
            </select>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check2-circle"></i> تحديث الشعبة
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
