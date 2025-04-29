@extends('layout')

@section('title', 'تسجيل خروج')

@section('content')
<div class="card p-4">
  <div class="card-header bg-danger text-white text-center">
    تسجيل خروج مشترك
  </div>
  <div class="card-body">
    <form>
      <div class="mb-3">
        <label class="form-label">رقم الجوال</label>
        <input type="text" class="form-control" placeholder="أدخل رقم الجوال للخروج">
      </div>
      <button type="submit" class="btn btn-danger w-100">تسجيل الخروج</button>
    </form>
  </div>
</div>
@endsection
