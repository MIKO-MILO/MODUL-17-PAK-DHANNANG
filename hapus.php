<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file gambar dulu untuk dihapus dari folder
    $sql_img = "SELECT image FROM news WHERE id = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $result_img = $stmt_img->get_result();
    
    if ($result_img->num_rows > 0) {
        $row = $result_img->fetch_assoc();
        $gambar = $row['image'];

        // Hapus dari database
        $sql_del = "DELETE FROM news WHERE id = ?";
        $stmt_del = $conn->prepare($sql_del);
        $stmt_del->bind_param("i", $id);

        if ($stmt_del->execute()) {
            // Hapus file fisik
            if (file_exists("upload/" . $gambar)) {
                unlink("upload/" . $gambar);
            }
            header("Location: tampil.php");
        } else {
            echo "Gagal menghapus data: " . $conn->error;
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    header("Location: tampil.php");
}
?>