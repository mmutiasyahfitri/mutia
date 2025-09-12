<?php
session_start();
include 'config.php'; // Menghubungkan ke database


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial pengguna
    $sql = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 
    $user = $result->fetch_assoc();

    // Simpan session
    $_SESSION['username'] = $user['nama'];
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['role_id'] = $user['role_id'];

    // Redirect sesuai role
    if ($user['role_id'] == 1) {
        header("Location: dashboard_admin.php");
    } elseif ($user['role_id'] == 2) {
        header("Location: proseslogin.php");
    } else {
        echo "<script>alert('Gagal Login'); window.location.href='login.php';</script>";
    }
    exit;
}

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Kedai Kopi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #a47149 0%, #f3e9dc 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-container {
      background: #fffbe9cc;
      border-radius: 20px;
      box-shadow: 0 8px 32px 0 rgba(44, 29, 18, 0.2);
      padding: 2.5rem 2rem 2rem 2rem;
      max-width: 400px;
      width: 100%;
      margin: 2rem auto;
    }
    .coffee-logo {
      width: 80px;
      display: block;
      margin: 0 auto 1rem auto;
    }
    .kopi-title {
      font-family: 'Pacifico', cursive;
      color: #a47149;
      text-align: center;
      font-size: 2.2rem;
      margin-bottom: 0.5rem;
    }
    .kopi-subtitle {
      text-align: center;
      color: #6d4c2b;
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }
    .form-label {
      color: #6d4c2b;
    }
    .btn-coffee {
      background: #a47149;
      color: #fff;
      border: none;
      width: 100%;
      font-weight: bold;
      transition: background 0.2s;
    }
    .btn-coffee:hover {
      background: #6d4c2b;
    }
    .form-control:focus {
      border-color: #a47149;
      box-shadow: 0 0 0 0.2rem #a4714940;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <img src="https://img.icons8.com/ios-filled/100/coffee.png" alt="Coffee Logo" class="coffee-logo">
    <div class="kopi-title">terass coffee </div>
    <div class="kopi-subtitle">Selamat datang! Silakan login untuk melanjutkan.</div>
    <form action="" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="username" class="form-control" id="email" placeholder="Masukkan email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn btn-coffee mt-3">Login</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>