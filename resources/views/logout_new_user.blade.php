@extends('layout')

@section('title', 'تسجيل دخول مشترك')

@section('content')
<div class="container py-4">

  {{-- ✅ رسالة نجاح --}}
  <div class="text-center mb-4">
    <div class="alert alert-success d-inline-block shadow-sm">
      ✅ تم تسجيل الدخول بنجاح عند الساعة <strong>{{ date('H:i') }}</strong>
    </div>
  </div>

  {{-- ✅ نموذج تسجيل الدخول --}}
  <div class="card border-0 shadow p-4 mb-5 rounded-4">
    <h4 class="text-center text-success fw-bold mb-4">🔐 تسجيل دخول مشترك جديد</h4>

    @if ($errors->any())
      <div class="alert alert-warning text-center">
        <ul class="mb-0 list-unstyled">
          @foreach ($errors->all() as $error)
            <li>⚠️ {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="#">
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">📱 رقم الجوال</label>
          <input type="text" name="phone" class="form-control text-center fw-bold" placeholder="059XXXXXXX"
                 value="{{ old('phone') }}" required autocomplete="tel">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">👤 البروفايل المقترح</label>
          <input type="text" name="profile" class="form-control text-center fw-bold" placeholder="اسم البروفايل"
                 value="{{ old('profile') }}" required autocomplete="nickname">
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label fw-bold">⏰ ساعة الدخول</label>
        <input type="text" name="login_time" class="form-control text-center fw-bold"
               value="{{ date('g:i A') }}" readonly>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success btn-lg fw-bold">✅ تسجيل الدخول</button>
      </div>
    </form>
  </div>

  {{-- ✅ جدول إحصائيات الشبكات --}}
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-primary text-white text-center fw-bold fs-5">
      📊 عدد المشتركين حسب الشبكة
    </div>

    <table class="table table-bordered text-center mb-0">
      <thead class="table-light">
        <tr>
          <th>اسم الشبكة</th>
          <th>عدد المشتركين</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Orchida</td><td>12</td></tr>
        <tr><td>Orchida-B</td><td>0</td></tr>
        <tr class="table-secondary fw-bold">
          <td>المجموع</td>
          <td class="text-danger">12</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
