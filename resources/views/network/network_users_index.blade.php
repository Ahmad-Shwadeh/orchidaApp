@extends('layouts.layout')


@section('title', 'عرض المستخدمين')

@section('content')
<div class="container-fluid">

  {{-- ✅ كرت عرض المستخدمين --}}
  <div class="card shadow-sm mb-4 border-0 rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
      <div>
        <i class="bi bi-people-fill"></i> قائمة المستخدمين المسجلين
      </div>

      {{-- 🔘 زر حذف الكل --}}
      <form action="{{ route('network.users.clear') }}" method="POST"
            onsubmit="return confirm('⚠️ هل أنت متأكد من حذف جميع المستخدمين؟ هذا الإجراء لا يمكن التراجع عنه!')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger fw-bold">
          <i class="bi bi-trash3"></i> حذف الكل
        </button>
      </form>
    </div>

    <div class="card-body table-responsive">
      @if($users->isEmpty())
        <div class="alert alert-warning text-center fs-5 fw-bold rounded-3">
          <i class="bi bi-exclamation-circle-fill"></i> لا يوجد بيانات لعرضها حاليًا.
        </div>
      @else
        <table class="table table-bordered table-hover text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>👤 اسم المستخدم</th>
              <th>⚙️ الحالة</th>
              <!-- <th>⏰ تاريخ التخصيص</th>
              <th>📅 آخر تحديث</th> -->
            </tr>
          </thead>
          <tbody>
            @foreach($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td class="fw-bold">{{ $user->username }}</td>
                <td>
                  <span class="badge bg-{{ $user->status == 0 ? 'secondary' : 'success' }}">
                    {{ $user->status == 0 ? 'غير مستخدم' : 'مستخدم' }}
                  </span>
                </td>
                <!-- <td>{{ $user->assigned_at ?? '—' }}</td>
                <td>{{ $user->last_update ?? '—' }}</td> -->
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
</div>
@endsection
