<?php
include "header.php";
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: tampil.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>Berita tidak ditemukan!</div>";
    include "footer.php";
    exit();
}

$row = $result->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tampil.php" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active">Detail Berita</li>
            </ol>
        </nav>

        <article class="bg-white rounded-4 shadow-sm overflow-hidden mb-5">
            <div class="position-relative">
                <img src="upload/<?= $row['image']; ?>" class="w-100" style="max-height: 500px; object-fit: cover;">
                <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                    <span class="badge bg-primary mb-2">Informasi Terkini</span>
                    <h1 class="text-white fw-bold mb-0"><?= $row['title']; ?></h1>
                </div>
            </div>
            
            <div class="p-4 p-md-5">
                <div class="d-flex align-items-center justify-content-between mb-5 pb-3 border-bottom">
                    <div class="d-flex align-items-center text-muted small">
                        <div class="d-flex align-items-center me-4">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="bi bi-person"></i>
                            </div>
                            <span>Oleh: <b><?= $row['author']; ?></b></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <span><?= date('d F Y', strtotime($row['date'])) ?></span>
                        </div>
                    </div>
                    
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <div class="btn-group">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus berita ini?')">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="news-content" style="font-size: 1.15rem; line-height: 2; color: #334155; text-align: justify;">
                    <?= nl2br($row['content']); ?>
                </div>
            </div>
            
            <div class="card-footer bg-light p-4 border-0 d-flex justify-content-center">
                <a href="tampil.php" class="btn btn-outline-primary px-4">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </article>
    </div>
</div>

<style>
    .news-content p {
        margin-bottom: 1.5rem;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "•";
        color: #cbd5e1;
    }
</style>

<?php include "footer.php"; ?>