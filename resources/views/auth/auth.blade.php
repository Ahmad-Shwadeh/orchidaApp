<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'تسجيل الدخول')</title>

  {{-- ✅ Bootstrap RTL --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  {{-- ✅ Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  {{-- ✅ Custom Styles (إن وجدت إضافات لاحقاً) --}}
  @stack('styles')
</head>
<body class="bg-light">

  {{-- ✅ Main Container --}}
  <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    @yield('content')
  </main>

  {{-- ✅ Scripts Stack --}}
  @stack('scripts')

</body>
</html>
