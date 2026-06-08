<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];

    $image = $_FILES["image"]["name"];
    $tmp = $_FILES["image"]["tmp_name"];
    
    // Validasi file
    if (empty($image)) {
        die("Silakan pilih gambar terlebih dahulu.");
    }

    $image_baru = time() . '_' . basename($image);
    $target = "upload/" . $image_baru;

    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($ext, $allowed)) {
        die("Format gambar tidak valid");
    }

    // Pastikan folder upload ada
    if (!is_dir("upload")) {
        mkdir("upload");
    }

    if (move_uploaded_file($tmp, $target)) {
        $sql = "INSERT INTO news (title, content, author, image)
                VALUES ('$title', '$content', '$author', '$image_baru')";

        if ($conn->query($sql) === TRUE) {
            header("Location: tampil.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Gagal upload gambar ke server.";
    }
} else {
    header("Location: form_upload.php");
}
?>
