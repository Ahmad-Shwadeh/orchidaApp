@extends('layout')

@section('title', 'تسجيل دخول مشترك')

@section('content')
<div class="container py-4">

  {{-- ✅ رسالة نجاح عند الدخول --}}
  @if(session('success'))
    <div class="alert alert-success text-center">
      ✅ {{ session('success') }}
    </div>
  @endif

  {{-- ⚠️ رسائل التحقق --}}
  @if ($errors->any())
    <div class="alert alert-warning text-center">
      <ul class="mb-0 list-unstyled">
        @foreach ($errors->all() as $error)
          <li>⚠️ {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- ✅ نموذج تسجيل دخول مشترك --}}
  <div class="card border-0 shadow-sm p-4 mb-5 bg-white rounded">
    <h5 class="text-center text-success mb-4 fw-bold">🔐 تسجيل دخول مشترك جديد</h5>

    <form method="POST" action="#">
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">📱 رقم الجوال</label>
          <input type="text" name="phone" class="form-control text-center" placeholder="059XXXXXXX" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">👤 البروفايل المقترح</label>
          <input type="text" name="profile" class="form-control text-center" placeholder="اسم البروفايل" required>
        </div>
      </div>
