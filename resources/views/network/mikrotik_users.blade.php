@extends('layouts.layout')


@section('title', 'إدارة مستخدمي المايكروتك')

@section('content')
<div class="container py-4">

  {{-- ✅ العنوان --}}
  <div class="text-center mb-4">
    <h4 class="fw-bold text-primary">👥 إدارة مستخدمي المايكروتك</h4>
    <p class="text-muted">ارفع ملف Excel لاستعراض المستخدمين قبل حفظهم.</p>
  </div>

  {{-- ✅ تنبيهات الجلسة --}}
  @if(session('success'))
    <div class="alert alert-success text-center fw-bold shadow-sm">
      {{ session('success') }}
    </div>
  @endif

  {{-- ✅ نموذج رفع الملف --}}
  <div class="card shadow p-4 mb-4 border-0 rounded-4">
    <form action="{{ route('mikrotik.preview') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-bold">📂 ملف Excel</label>
        <input type="file" name="excel_file" class="form-control text-center" accept=".xlsx,.xls,.csv" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-success fw-bold">
          👁️ استعراض البيانات
        </button>
      </div>
    </form>
  </div>

  {{-- ✅ جدول معاينة المستخدمين بعد رفع الملف --}}
  @isset($previewUsers)
    <div class="card shadow p-4 border-0 rounded-4">
      <h5 class="text-center text-info fw-bold mb-3">📝 معاينة المستخدمين</h5>

      <form action="{{ route('mikrotik.import') }}" method="POST">
        @csrf
        <input type="hidden" name="confirmed_users" value="{{ json_encode(array_column($previewUsers, 0)) }}">

        <div class="table-responsive">
          <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>اسم المستخدم</th>
              </tr>
            </thead>
            <tbody>
              @foreach($previewUsers as $index => $row)
                @if($index !== 0 && isset($row[0]))
                  <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $row[0] }}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="text-center mt-3">
          <button type="submit" class="btn btn-primary fw-bold">
            ✅ تأكيد وحفظ في قاعدة البيانات
          </button>
        </div>
      </form>
    </div>
  @endisset

</div>
@endsection
