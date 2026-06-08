<?php
include "header.php";
include "koneksi.php";

// Cek akses admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: tampil.php");
    exit();
}

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
    <div class="col-lg-8">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tampil.php" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="detail.php?id=<?= $id ?>" class="text-decoration-none">Detail Berita</a></li>
                <li class="breadcrumb-item active">Sunting Berita</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-warning py-3">
                <h5 class="card-title text-dark fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i> Sunting Berita
                </h5>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="proses_edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $row['image']; ?>">

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">JUDUL BERITA</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3" value="<?= $row['title']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">ISI KONTEN</label>
                        <textarea name="content" class="form-control rounded-3" rows="12" required><?= $row['content']; ?></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">PENULIS</label>
                            <input type="text" name="author" class="form-control bg-light rounded-3" value="<?= $row['author']; ?>" required>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small">GANTI GAMBAR (OPSIONAL)</label>
                            <input type="file" name="image" class="form-control rounded-3">
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded-4 mb-4 d-flex align-items-center">
                        <img src="upload/<?= $row['image']; ?>" class="rounded-3 shadow-sm me-3" width="120" height="80" style="object-fit: cover;">
                        <div>
                            <small class="text-muted d-block">Gambar Saat Ini</small>
                            <span class="small fw-medium text-dark"><?= $row['image'] ?></span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                        <a href="detail.php?id=<?= $id ?>" class="btn btn-light px-4 me-md-2 rounded-3">Batal</a>
                        <button type="submit" class="btn btn-warning px-5 rounded-3 shadow-sm fw-bold">
                            Simpan Perubahan <i class="bi bi-check-circle-fill ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }
    textarea.form-control {
        resize: none;
        line-height: 1.6;
    }
</style>

<?php include "footer.php"; ?>