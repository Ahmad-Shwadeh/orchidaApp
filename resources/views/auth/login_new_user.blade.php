@extends('auth.auth') {{-- استدعاء الواجهة المعدّلة الجديدة --}}

@section('title', 'تسجيل دخول مشترك')

@section('content')
<div class="container">

  {{-- ✅ رسالة نجاح --}}
  @if(session('success'))
    <div class="alert alert-success text-center shadow-sm">
      ✅ {{ session('success') }}
    </div>
  @endif

  {{-- ⚠️ رسائل الأخطاء --}}
  @if ($errors->any())
    <div class="alert alert-warning shadow-sm text-center">
      <ul class="mb-0 list-unstyled">
        @foreach ($errors->all() as $error)
          <li>⚠️ {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- 🔐 نموذج الدخول --}}
  <div class="card border-0 shadow p-4 mb-4 rounded-4 bg-white">
    <h5 class="text-center text-success mb-4 fw-bold">
      🔐 تسجيل دخول مشترك جديد
    </h5>

    <form method="POST" action="#"> {{-- 👈 عدّل الـ action لاحقاً عند ربطه --}}
      @csrf

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">📱 رقم الجوال</label>
          <input type="text" name="phone" class="form-control text-center fw-bold" placeholder="059XXXXXXX" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold">👤 البروفايل المقترح</label>
          <input type="text" name="profile" class="form-control text-center fw-bold" placeholder="اسم البروفايل" required>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success fw-bold">
          <i class="bi bi-person-check-fill"></i> تسجيل الدخول
        </button>
      </div>
    </form>
  </div>

</div>
@endsection
