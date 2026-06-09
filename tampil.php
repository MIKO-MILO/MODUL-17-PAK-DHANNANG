<?php
include "header.php";
include "koneksi.php";

$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $conn->query($sql);
?>

<header class="mb-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fw-bold mb-1">Berita Terbaru</h1>
            <p class="text-muted">Temukan informasi terpercaya hari ini</p>
        </div>
        <div class="col-md-6 text-md-end">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="form_upload.php" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Buat Berita
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="row g-4">
    <?php
    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
        <div class="col-md-6 col-lg-4">
            <article class="card h-100 overflow-hidden card-news">
                <div class="position-relative">
                    <img src="upload/<?= $row['image']; ?>" class="card-img-top" alt="<?= $row['title']; ?>" style="height: 220px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-dark shadow-sm">
                            <i class="bi bi-calendar3 me-1"></i> <?= date('d M Y', strtotime($row['date'])) ?>
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-2">
                        <span class="badge bg-soft-primary text-primary" style="background-color: rgba(59, 130, 246, 0.1);">Warta</span>
                    </div>
                    <h5 class="card-title fw-bold mb-3 line-clamp-2">
                        <a href="detail.php?id=<?= $row['id']; ?>" class="text-decoration-none text-dark">
                            <?= $row['title']; ?>
                        </a>
                    </h5>
                    <p class="card-text text-muted small line-clamp-3 mb-4">
                        <?= strip_tags($row['content']); ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between mt-auto">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="bi bi-person text-secondary"></i>
                            </div>
                            <small class="fw-medium"><?= $row['author']; ?></small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                <li><a class="dropdown-item" href="detail.php?id=<?= $row['id']; ?>"><i class="bi bi-eye me-2"></i> Baca Selengkapnya</a></li>
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-warning" href="edit.php?id=<?= $row['id']; ?>"><i class="bi bi-pencil me-2"></i> Edit Berita</a></li>
                                    <li><a class="dropdown-item text-danger" href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus berita ini?')"><i class="bi bi-trash me-2"></i> Hapus</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    <?php 
        endwhile; 
    else:
    ?>
        <div class="col-12 text-center py-5">
            <div class="bg-white p-5 rounded-4 shadow-sm">
                <i class="bi bi-journal-x fs-1 text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada berita yang diterbitkan</h4>
                <p class="text-muted mb-0">Silakan kembali lagi nanti atau buat berita baru jika Anda admin.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-news:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>

<?php include "footer.php"; ?>
