<?php
session_start();
// حماية الصفحة: فقط الأدمن يدخلها
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: examples/login.php");
    exit();
}

include '../../../db.php'; // تأكد من المسار الصحيح لملف الاتصال
$activeCount = 0;
$sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'secretary'";
$result = $conn->query($sql);
if ($row = $result->fetch_assoc()) {
    $activeCount = $row['total'];
}
$inactiveCount = 0;
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الرئيسية - Orchida</title>
  <link rel="stylesheet" href="../../css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- الترويسة -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <span class="navbar-brand"><b>Orchida</b> Dashboard</span>
  </nav>

  <!-- الشريط الجانبي -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
      <img src="../../assets/img/orchida-logo.png" alt="Logo" class="brand-image" style="opacity: .9">
      <span class="brand-text font-weight-light">Orchida</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>الرئيسية</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logins.php" class="nav-link">
              <i class="nav-icon fas fa-sign-in-alt"></i>
              <p>سجل الدخول</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>إدارة المستخدمين</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>تسجيل الخروج</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- المحتوى الرئيسي -->
  <div class="content-wrapper p-4">
    <div class="content-header text-center">
      <img src="../../assets/img/orchida-logo.png" style="max-height: 90px; margin-bottom: 10px;">
      <h2 class="mt-3">Orchida Workspace Dashboard</h2>
      <p style="font-size: 16px; color: #666;">نظام إدارة المساحات المكتبية</p>
    </div>

    <div class="row mt-4">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><?= $activeCount ?></h3>
            <p>الحسابات الفعالة</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-check"></i>
          </div>
          <a href="#" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $inactiveCount ?></h3>
            <p>الحسابات المنتهية</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-times"></i>
          </div>
          <a href="#" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><i class="fas fa-sign-in-alt"></i></h3>
            <p>تسجيل دخول</p>
          </div>
          <a href="#" class="small-box-footer">دخول <i class="fas fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><i class="fas fa-sign-out-alt"></i></h3>
            <p>تسجيل خروج</p>
          </div>
          <a href="#" class="small-box-footer">خروج <i class="fas fa-arrow-circle-left"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- الفوتر -->
  <footer class="main-footer text-center">
    <strong>Orchida © 2025</strong> جميع الحقوق محفوظة.
  </footer>

</div>

<!-- سكربتات AdminLTE -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
