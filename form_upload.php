<?php
include "header.php";

// Cek akses admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: tampil.php");
    exit();
}
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tampil.php" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active">Buat Berita Baru</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title text-white fw-bold mb-0">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Berita
                </h5>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="proses_upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">JUDUL BERITA</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3" placeholder="Apa judul berita hari ini?" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">ISI KONTEN</label>
                        <textarea name="content" class="form-control rounded-3" rows="12" placeholder="Tuliskan isi berita secara detail di sini..." required></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">PENULIS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="author" class="form-control border-start-0 bg-light rounded-end-3" value="<?= $_SESSION['username'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small">GAMBAR UNGGULAN</label>
                            <input type="file" name="image" class="form-control rounded-3" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                        <a href="tampil.php" class="btn btn-light px-4 me-md-2 rounded-3">Batal</a>
                        <button type="submit" class="btn btn-primary px-5 rounded-3 shadow-sm">
                            Terbitkan Sekarang <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    textarea.form-control {
        resize: none;
        line-height: 1.6;
    }
</style>

<?php include "footer.php"; ?>