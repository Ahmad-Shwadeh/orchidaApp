@extends('layout')

@section('title', 'تسجيل دخول')

@section('content')
<div class="card p-4">
  <div class="card-header bg-success text-white text-center">
    تسجيل دخول مشترك جديد
  </div>
  <div class="card-body">
    <form>
      <div class="mb-3">
        <label class="form-label">رقم الجوال</label>
        <input type="text" class="form-control" placeholder="أدخل رقم الجوال">
      </div>
      <div class="mb-3">
        <label class="form-label">البروفايل المقترح</label>
        <input type="text" class="form-control" placeholder="أدخل اسم البروفايل">
      </div>
      <button type="submit" class="btn btn-success w-100">تسجيل الدخول</button>
    </form>
  </div>
</div>
@endsection
