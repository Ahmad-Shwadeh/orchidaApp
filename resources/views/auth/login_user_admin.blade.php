@extends('auth.auth')

@section('title', 'تسجيل دخول الموظف')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

      <div class="card shadow border-0 p-4">
        <h4 class="text-center text-primary mb-4 fw-bold">🔐 تسجيل دخول الموظف</h4>

        {{-- ✅ رسالة خطأ --}}
        @if(session('error'))
          <div class="alert alert-danger text-center shadow-sm">{{ session('error') }}</div>
        @endif

        {{-- ⚠️ رسائل التحقق --}}
        @if ($errors->any())
          <div class="alert alert-warning shadow-sm">
            <ul class="mb-0 text-center list-unstyled">
              @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- 🔐 نموذج الدخول --}}
        <form method="POST" action="{{ route('login.submit') }}">
          @csrf

          {{-- 👤 اسم المستخدم --}}
          <div class="mb-3">
            <label class="form-label fw-bold">👤 اسم المستخدم</label>
            <input type="text" name="username" value="{{ old('username') }}"
                   class="form-control text-center fw-bold" placeholder="مثال: abofiras" required autofocus>
          </div>

          {{-- 🔑 كلمة المرور --}}
          <div class="mb-3">
            <label class="form-label fw-bold">🔑 كلمة المرور</label>
            <input type="password" name="password"
                   class="form-control text-center fw-bold" placeholder="******" required>
          </div>

          {{-- 🔒 خيار تذكرني --}}
          <div class="form-check text-center mb-4">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label fw-semibold" for="remember">🔒 تذكرني</label>
          </div>

          {{-- ✅ زر الدخول --}}
          <div class="d-grid">
            <button type="submit" class="btn btn-primary fw-bold">
              <i class="bi bi-box-arrow-in-right"></i> دخول
            </button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>
@endsection
