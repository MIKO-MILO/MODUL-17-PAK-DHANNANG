<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Informasi Terkini</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0f172a;
            --accent-color: #3b82f6;
            --bg-light: #f8fafc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: #1e293b;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }
        .btn-primary {
            background-color: var(--accent-color);
            border: none;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            border-radius: 8px;
        }
        .nav-link {
            font-weight: 500;
            color: #64748b !important;
        }
        .nav-link:hover {
            color: var(--accent-color) !important;
        }
        .main-content {
            padding-top: 100px;
            padding-bottom: 60px;
            min-height: calc(100vh - 160px);
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="tampil.php">
                <i class="bi bi-intersect fs-3 me-2 text-primary"></i>
                NewsPortal
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="tampil.php">Jelajahi</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="me-3 d-none d-lg-block">
                        <small class="text-muted d-block">Masuk sebagai</small>
                        <span class="fw-semibold text-dark"><?= $_SESSION['username'] ?></span>
                        <span class="badge bg-light text-primary ms-1"><?= ucfirst($_SESSION['role']) ?></span>
                    </div>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm px-3">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container main-content">