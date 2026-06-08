<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $gambar_lama = $_POST['gambar_lama'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        // Jika ada gambar baru diupload
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($ext, $allowed)) {
            die("Format gambar tidak valid");
        }

        $image_baru = time() . '_' . basename($image);
        $target = "upload/" . $image_baru;

        if (move_uploaded_file($tmp, $target)) {
            // Hapus gambar lama
            if (file_exists("upload/" . $gambar_lama)) {
                unlink("upload/" . $gambar_lama);
            }
            $image_to_save = $image_baru;
        } else {
            die("Gagal upload gambar baru.");
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $image_to_save = $gambar_lama;
    }

    $sql = "UPDATE news SET title = ?, content = ?, author = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $content, $author, $image_to_save, $id);

    if ($stmt->execute()) {
        header("Location: detail.php?id=" . $id);
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: tampil.php");
}
?>