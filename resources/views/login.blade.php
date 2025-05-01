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
  <div class="card border-0 shadow-sm p-4 mb-5 bg-white rounded">
    <h5 class="text-center text-success mb-4 fw-bold">🔐 تسجيل دخول مشترك جديد</h5>

    <form>
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">📱 رقم الجوال</label>
          <input type="text" class="form-control text-center" placeholder="059XXXXXXX">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">👤 البروفايل المقترح</label>
          <input type="text" class="form-control text-center" placeholder="اسم البروفايل">
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label fw-bold">⏰ ساعة الدخول</label>
        <input type="text" class="form-control text-center" placeholder="{{ date('g:i A') }}">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success btn-lg">✅ تسجيل الدخول</button>
      </div>
    </form>
  </div>

  {{-- ✅ جدول إحصائيات الشبكات --}}
  <div class="card shadow-sm border-0 rounded">
    <div class="card-header bg-primary text-white text-center fw-bold">
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
        <tr class="table-secondary">
          <td><strong>المجموع</strong></td>
          <td class="text-danger fw-bold">12</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
