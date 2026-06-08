<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    header("Location: tampil.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: tampil.php");
            exit();
        } else {
            $error = "Kata sandi yang Anda masukkan salah.";
        }
    } else {
        $error = "Nama pengguna tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - NewsPortal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        .login-header {
            background-color: #0f172a;
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f1f5f9;
        }
        .form-control:focus {
            background-color: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-login {
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            background-color: #3b82f6;
            border: none;
            transition: all 0.2s;
        }
        .btn-login:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-card card">
        <div class="login-header">
            <i class="bi bi-intersect fs-1 mb-2"></i>
            <h4 class="fw-bold mb-0">Selamat Datang</h4>
            <p class="text-white-50 small">Masuk ke NewsPortal untuk melanjutkan</p>
        </div>
        <div class="card-body p-4 p-md-5">
            <?php if ($error): ?>
                <div class="alert alert-danger border-0 small d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= $error ?></div>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">NAMA PENGGUNA</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold text-muted">KATA SANDI</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login w-100 mb-3">Masuk Sekarang</button>
            </form>
            
            <div class="text-center">
                <p class="text-muted small mb-0">Butuh bantuan? Hubungi admin</p>
            </div>
        </div>
        <div class="bg-light p-3 text-center border-top">
            <small class="text-muted">admin: <b>admin123</b> | user: <b>user123</b></small>
        </div>
    </div>
</body>
</html>