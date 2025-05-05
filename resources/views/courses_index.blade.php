@extends('layout')

@section('title', 'عرض جميع الدورات')

@section('content')
<div class="container py-4">

  {{-- ✅ عنوان الصفحة وزر إضافة --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-primary fw-bold mb-0">📋 قائمة الدورات</h4>
    <a href="{{ route('courses.create') }}" class="btn btn-success">
      ➕ إضافة دورة جديدة
    </a>
  </div>

  {{-- ✅ جدول الدورات --}}
  <div class="card shadow rounded-4 p-4 border-0">
    @if($courses->isEmpty())
      <p class="text-center text-muted">لا توجد دورات مسجلة حالياً.</p>
    @else
      <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
          <tr>
            <th>🔢 رقم الدورة</th>
            <th>📘 اسم الدورة</th>
            <th>⏱ عدد الساعات</th>
            <th>📝 الوصف</th>
            <th>⚙️ الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courses as $course)
            <tr>
              <td>{{ $course->course_number }}</td>
              <td>{{ $course->name }}</td>
              <td>{{ $course->hours }}</td>
              <td>{{ $course->description }}</td>
              <td>
              <a href="{{ route('courses.edit', $course->course_number) }}" class="btn btn-sm btn-warning">✏️ تعديل</a>

              <form action="{{ route('courses.destroy', $course->course_number) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف الدورة؟');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">🗑 حذف</button>
  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

</div>
@endsection
