@extends('layout')

@section('title', 'تسجيل دخول المستخدم')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow p-4">
        <h4 class="text-center text-primary mb-4 fw-bold">🔐 تسجيل الدخول</h4>

        @if(session('error'))
          <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-bold">اسم المستخدم</label>
            <input type="text" name="username" class="form-control text-center" required>
          </div>
          <div class="mb-4">
            <label class="form-label fw-bold">كلمة المرور</label>
            <input type="password" name="password" class="form-control text-center" required>
          </div>
          <button type="submit" class="btn btn-primary w-100 fw-bold">دخول</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
