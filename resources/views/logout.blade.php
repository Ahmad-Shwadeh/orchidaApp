@extends('layout')

@section('title', 'تسجيل خروج مشترك')

@section('content')
<div class="container py-4">

  {{-- ✅ عنوان --}}  
  <div class="text-center mb-4">
    <h4 class="text-success fw-bold">✅ تم تسجيل الخروج بنجاح</h4>
    <div class="bg-light border p-3 rounded shadow-sm d-inline-block mt-3">
      <strong class="text-muted">رقم الجوال:</strong>
      <span class="fw-bold text-dark ms-2">0566225658</span>
    </div>
  </div>

  {{-- ✅ تفاصيل الوقت --}}
  <div class="row justify-content-center g-3 text-center mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-4 border-primary">
        <div class="card-body">
          <small class="text-muted">ساعة الدخول</small>
          <div class="fs-5 fw-bold">9:30 ص</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-4 border-danger">
        <div class="card-body">
          <small class="text-muted">ساعة الخروج</small>
          <div class="fs-5 fw-bold">6:36 م</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-4 border-secondary">
        <div class="card-body">
          <small class="text-muted">المدة الزمنية</small>
          <div class="fs-5 fw-bold">9:05</div>
        </div>
      </div>
    </div>
  </div>

  {{-- ✅ المبلغ المطلوب --}}
  <div class="text-center my-4">
    <div class="alert alert-success d-inline-block fs-5 shadow-sm">
      💰 <strong>المبلغ المطلوب:</strong> 25 شيكل
    </div>
  </div>

  {{-- ✅ الكاش المدفوع والباقي --}}
  <div class="row justify-content-center g-3 text-center mb-5">
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-4 border-info">
        <div class="card-body">
          <small class="text-muted">الكاش المدفوع</small>
          <div class="fs-5 fw-bold">100</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-4 border-warning">
        <div class="card-body">
          <small class="text-muted">باقي الحساب</small>
          <div class="fs-5 fw-bold">75</div>
        </div>
      </div>
    </div>
  </div>

  {{-- ✅ جدول الفئات --}}
  <div class="text-center mb-3">
    <h5 class="text-primary">التحقق من الفئات النقدية</h5>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered text-center table-striped w-75 mx-auto shadow-sm">
      <thead class="table-primary">
        <tr>
          <th>الفئة</th>
          <th>العدد</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>1</td><td>0</td></tr>
        <tr><td>2</td><td>0</td></tr>
        <tr><td>5</td><td>0</td></tr>
        <tr><td>20</td><td>0</td></tr>
        <tr><td>50</td><td>0</td></tr>
        <tr><td>100</td><td>1</td></tr>
        <tr class="table-secondary">
          <td><strong>المجموع</strong></td>
          <td class="text-danger fw-bold">0</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
