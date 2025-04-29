<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <title>@yield('title', 'لوحة التحكم | أوركيدا')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('dist/css/orchida.css') }}">


  <style>
    body {
      font-family: 'Cairo', sans-serif;
    }
    .navbar-nav .nav-link,
    .sidebar-menu .nav-link {
      text-align: right;
    }
    .breadcrumb {
      direction: rtl;
    }
    .app-sidebar {
      background-color: #1D2B38 !important;
    }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

  {{-- الهيدر --}}
  <nav class="navbar navbar-expand" style="background-color: #FF6600;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <ul class="navbar-nav flex-row gap-3">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> الرئيسية</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><i class="bi bi-telephone-fill"></i> اتصل بنا</a>
        </li>
      </ul>

      <ul class="navbar-nav flex-row gap-3">
        <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-search fs-5"></i></a></li>
        <li class="nav-item position-relative">
          <a class="nav-link text-white" href="#"><i class="bi bi-chat-text fs-5"></i></a>
          <span class="position-absolute top-0 start-0 translate-middle badge bg-danger">3</span>
        </li>
        <li class="nav-item position-relative">
          <a class="nav-link text-white" href="#"><i class="bi bi-bell fs-5"></i></a>
          <span class="position-absolute top-0 start-0 translate-middle badge bg-warning text-dark">15</span>
        </li>
      </ul>
    </div>
  </nav>

  {{-- الشريط الجانبي --}}
  <aside class="app-sidebar shadow" data-bs-theme="dark">
    <div class="sidebar-brand text-end pe-3">
      <a href="{{ url('/') }}" class="brand-link d-flex align-items-center gap-2 pe-3">
      <img src="{{ asset('dist/assets/img/orchida-logo.png') }}" alt="Orchida Logo"
     style="max-height: 75px; max-width: auto; display: block; margin: 10px auto;" />

        <span class="brand-text fw-light fs-4 text-white">أوركيدا</span>
      </a>
    </div>

    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" role="menu">
          <li class="nav-item"><a href="{{ url('/') }}" class="nav-link"><i class="nav-icon bi bi-house-door-fill"></i><p>الرئيسية</p></a></li>
          <li class="nav-item"><a href="{{ url('/login') }}" class="nav-link"><i class="nav-icon bi bi-box-arrow-in-right"></i><p>تسجيل دخول المستخدمين</p></a></li>
          <li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link"><i class="nav-icon bi bi-box-arrow-right"></i><p>تسجيل خروج المستخدمين</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  {{-- المحتوى الرئيسي --}}
  <main class="app-main">
    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
