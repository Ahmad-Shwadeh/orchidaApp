// <!-- login.php -->
// <?php
// session_start();
// $error = '';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     include '../../db.php'; // عدل حسب مكان ملف الاتصال بقاعدة البيانات

//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
//     $stmt->bind_param("ss", $username, $password); // لاحقاً سنستخدم تشفير
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($row = $result->fetch_assoc()) {
//         $_SESSION['username'] = $username;
//         $_SESSION['role'] = $row['role']; // admin أو secretary

//         if ($row['role'] === 'admin') {
//             header("Location: ../dashboard-admin.php");
//         } else {
//             header("Location: ../dashboard-secretary.php");
//         }
//         exit;
//     } else {
//         $error = "Invalid credentials!";
//     }
// }
// ?>

// <!-- HTML -->
// <!DOCTYPE html>
// <html>
// <head>
//   <title>Login</title>
//   <link rel="stylesheet" href="../../css/adminlte.min.css">
// </head>
// <body class="hold-transition login-page">
// <div class="login-box">
//   <div class="login-logo"><b>Orchida</b> Workspace</div>
//   <div class="card">
//     <div class="card-body login-card-body">
//       <p class="login-box-msg">Sign in to start your session</p>

//       <?php if ($error): ?>
//         <p style="color: red;"><?= $error ?></p>
//       <?php endif; ?>

//       <form method="POST">
//         <div class="input-group mb-3">
//           <input type="text" name="username" class="form-control" placeholder="Username" required>
//         </div>
//         <div class="input-group mb-3">
//           <input type="password" name="password" class="form-control" placeholder="Password" required>
//         </div>
//         <button type="submit" class="btn btn-primary btn-block">Login</button>
//       </form>
//     </div>
//   </div>
// </div>
// </body>
// </html>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../../db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: ../dashboard-admin.php");
            } else {
                header("Location: ../dashboard-secretary.php");
            }
            exit;
        } else {
            $error = "❌ كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "❌ اسم المستخدم غير موجود.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول - Orchida</title>
  <link rel="stylesheet" href="../../../css/adminlte.min.css">
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"><b>Orchida</b> Workspace</div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">سجّل دخولك لإدارة النظام</p>

      <?php if ($error): ?>
        <p style="color: red; font-weight: bold;"><?= $error ?></p>
      <?php endif; ?>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">دخول</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
