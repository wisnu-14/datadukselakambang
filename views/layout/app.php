<?php
ob_start();
session_start();
require '../../app/middleware/Auth.php';
require '../../app/controller/CountController.php';
logUserVisit();
authMiddleware();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sensus data</title>
    <link rel="icon" type="image/png" href="../../public/asset/logo/logo-title.png">
    <?php require '../../app/config/cdn/css.php'; ?>
</head>
<style>
    <?php require '../../public/css/app.css'; ?>
</style>

<body>
    <nav class="navbar navbar-expand-lg fixed-top pt-3 pb-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../public/asset/logo/logopemerintahpbg.png" alt="Logo" width="50" height="34" class="d-inline-block align-text-top">
                <div>Desa Selakambang</div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../rekap/rekap.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle aktif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?pages=data_penduduk">Data Penduduk</a></li>
                            <li><a class="dropdown-item" href="?pages=data_keluarga">Data Keluarga</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tempat tinggal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?pages=kondisi_rumah">Rumah</a></li>
                            <li><a class="dropdown-item" href="?pages=kamar_mandi">Kamar Mandi</a></li>
                            <li><a class="dropdown-item" href="?pages=data_listrik">Listrik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kepemilikan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?pages=data_barang">Barang</a></li>
                            <li><a class="dropdown-item" href="?pages=data_ternak">Ternak</a></li>
                            <li><a class="dropdown-item" href="?pages=tanaman_buah">Tanaman Buah</a></li>
                            <li><a class="dropdown-item" href="?pages=tanaman_pangan">Tanaman Pangan</a></li>
                            <li><a class="dropdown-item" href="?pages=tanaman_obat">Tanaman Obat</a></li>
                            <li><a class="dropdown-item" href="?pages=data_air">Sumber Air</a></li>
                            <li><a class="dropdown-item" href="?pages=data_usaha">Usaha</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php">Logout</a>
                    </li>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a href="../dashboard/index.php" class="nav-link">
                           <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                 <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                 <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
                            </svg>
                        </a>
                    </li>
                    <?php else: ?>
                    <?php endif; ?>
                    </ul>
            </div>
        </div>
    </nav>
    <main class="mt-5">
        <?php require '../../app/config/pages.php';?>
        <p class="text-role">Login sebagai <span class="text-primary"><?= $_SESSION['role'] ?></span></p>
    </main>
    <footer class="text-center py-2">
        <p class="mb-0">&copy; <?= date("Y"); ?> Selakambang. All Rights Reserved.</p>
    </footer>

    <?php require '../../app/config/cdn/js.php'; ?>
</body>
<?php ob_flush(); ?>
</html>