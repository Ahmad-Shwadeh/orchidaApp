@extends('layout')

@section('title', 'استيراد بيانات من Excel')

@push('styles')
<style>
  table.preview-table th,
  table.preview-table td {
    vertical-align: middle;
    text-align: center;
  }
</style>
@endpush

@section('content')
<div class="container-fluid">

  {{-- ✅ رسائل التنبيه --}}
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! session('success') !!}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif

  {{-- ✅ نموذج رفع ملف Excel --}}
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
      <i class="bi bi-upload"></i> رفع ملف Excel
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('network.importSimple') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="excel_file" class="form-label">📁 اختر ملف Excel من جهازك</label>
          <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xls,.xlsx,.csv" required>
        </div>

        <small class="text-muted mb-3 d-block">
          ⚠️ سيتم حفظ أسماء المستخدمين من العمود الأول فقط، مع تجاهل القيم الفارغة والمكررة.
        </small>

        <div class="d-flex justify-content-between gap-2 flex-wrap">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-cloud-upload-fill"></i> رفع ومعالجة الملف
          </button>

          <a class="btn btn-outline-secondary" href="{{ asset('storage/uploads') }}" target="_blank">
            <i class="bi bi-folder2-open"></i> فتح مجلد الملفات
          </a>

          {{-- ✅ زر عرض المستخدمين --}}
          <a class="btn btn-info text-white" href="{{ route('network.users') }}">
            <i class="bi bi-people-fill"></i> عرض المستخدمين
          </a>
        </div>
      </form>
    </div>
  </div>

  {{-- ✅ جدول المعاينة --}}
  @if(isset($headers) && isset($rows))
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-secondary text-white">
        <i class="bi bi-table"></i> معاينة المحتوى (أول 10 صفوف)
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered preview-table">
          <thead class="table-light">
            <tr>
              @foreach($headers as $header)
                <th>{{ $header }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach($rows as $row)
              <tr>
                @foreach($row as $cell)
                  <td>{{ $cell }}</td>
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif

</div>
@endsection
