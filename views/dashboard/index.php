<?php
session_start();
// error_reporting(1);
// require '../../app/controller/AuthController.php';
require '../../app/middleware/Auth.php';
require '../../app/controller/CountController.php';
logUserVisit();
adminMiddleware();
generateCsrfToken();
// Mengambil data user dari database
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM activity_logs ORDER BY timestamp DESC");
$logs = $stmt->fetchAll();
// Mengambil data pengunjung dari database
// Ambil data yang belum dihapus
$visitors = $pdo->query("SELECT * FROM visitors WHERE deleted_at IS NULL ORDER BY visit_time DESC")->fetchAll(PDO::FETCH_ASSOC);

// Cek jumlah data
if (count($visitors) > 100) {
    // Hitung berapa yang perlu dihapus (soft delete)
    $excess = count($visitors) - 100;

    // Ambil ID data tertua yang akan disoft delete
    $stmt = $pdo->prepare("SELECT id FROM visitors WHERE deleted_at IS NULL ORDER BY visit_time ASC LIMIT :limit");
    $stmt->bindValue(':limit', $excess, PDO::PARAM_INT);
    $stmt->execute();
    $oldIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Soft delete data dengan update kolom deleted_at
    if (!empty($oldIds)) {
        $in  = str_repeat('?,', count($oldIds) - 1) . '?';
        $sql = "UPDATE visitors SET deleted_at = NOW() WHERE id IN ($in)";
        $pdo->prepare($sql)->execute($oldIds);
    }
}


// superAdmin();

$blt = jumlahBlt();
$rtlh = jumlahRtlh();
$sembako = jumlahSembako();
$pkh = jumlahPkh();
$lainnya = jumlahLainnya();
$rumah = jumlahRumah();

$id = $_GET['id'];
if (isset($id)) {
    deleteUser($id);
    header('Location: index.php');
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die("CSRF token tidak valid.");
    }

    $result = registerUser($_POST['nik'], $_POST['nama'], $_POST['username'], $_POST['password'], $_POST['role']);
    if ($result === true) {
        echo "<script>alert('Berhasil menambah akun!');window.location.href='index.php';</script>";
        exit();
    } else {
        $_SESSION['error'] = $result;
    }
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="../../public/asset/logo/logo-title.png">

    <?php require '../../app/config/cdn/css.php'; ?>
</head>
<style>
    <?php require '../../public/css/dashboard.css'; ?>
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
                    <?php if ($_SESSION['role'] == 'admin'): ?>
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
    <div class="container main">
        <h1 class="text-center">Dashboard Menu</h1>
        <div class="table-container mt-5">
            <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card bg-primary text-white text-center p-3">
                    <h5>Total Penerima BLT</h5>
                    <h2><?= $blt['total_blt'] ?></h2>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-success text-white text-center p-3">
                    <h5>Total Penerima RTLH</h5>
                    <h2><?= $rtlh['total_rtlh'] ?></h2>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-warning text-white text-center p-3">
                    <h5>Total Penerima PKH</h5>
                    <h2><?= $pkh['total_pkh'] ?></h2>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-danger text-white text-center p-3">
                    <h5>Total Penerima Sembako</h5>
                    <h2><?= $sembako['total_sembako'] ?></h2>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-secondary text-white text-center p-3">
                    <h5>Total Rumah</h5>
                    <h2><?= $rumah['total_rumah'] ?></h2>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-info text-white text-center p-3">
                    <h5>Lainnya</h5>
                    <h2><?= $lainnya['total_lainnya'] ?></h2>
                </div>
            </div>
        </div>
        </div>

        <div class="container mt-5 table-container">
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success" id='loginSuccess'>
                    <?php
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']);
                    ?>
                </div>
            <?php endif; ?>
            <h2>Manage Users</h2>
            <button type="button" class="btn btn-primary mb-3 border-0" data-bs-toggle="modal" data-bs-target="#inputDataModal">
                <i class="bi bi-plus-square"></i> Add
            </button>
            <table class="table table-bordered table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Users</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $user):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['nik']; ?></td>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['role']; ?></td>
                            <td><?= str_repeat('*', strlen($user['password'])); ?></td>
                            <td class="d-flex">
                                <button class="btn btn-sm btn-outline-primary mx-1" data-bs-toggle="collapse" data-bs-target="#editForm<?= $user['id']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="index.php?id=<?= $user['id']; ?>" class="btn mx-1 btn-outline-primary" onclick="return confirm('YAKIN HAPUS DATA?!!');" class="">
                                    <i class="bi bi-trash" style="align-items: center; justify-content: center; display: flex;"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Data Modal -->
                        <tr id="editForm<?= $user['id']; ?>" class="collapse">
                            <td colspan="8">
                                <div class="card p-3">
                                    <h5>Edit Akun</h5>
                                    <form action="edit_process.php" method="POST">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                        <div class="mb-2">
                                            <label class="form-label">Nik</label>
                                            <input type="text" name="nik" class="form-control" required maxlength="16" value="<?= $user['nik']; ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="nama" required value="<?= $user['nama']; ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" required value="<?= $user['username']; ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="pengisi" <?= ($user['role'] == 'pengisi') ? 'selected' : ''; ?>>Pengisi</option>
                                                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update User</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="container py-5">
    <h3 class="mb-4 text-center fw-bold">📋 Riwayat Aktivitas Pengguna</h3>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Aksi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php if (count($logs) > 0): ?>
                    <?php foreach ($logs as $i => $log): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($log['username']) ?></td>
                            <td><?= htmlspecialchars($log['action']) ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($log['timestamp'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada aktivitas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
        
        <div class="table-container mt-5">
            <h3 class="mt-5">Data Pengunjung</h3>
            <table class="table table-bordered">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Alamat IP</th>
                        <th>Device</th>
                        <th>Waktu Kunjungan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($visitors as $visitor): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $visitor['ip_address'] ?></td>
                            <td><?= $visitor['device_info'] ?></td>
                            <td><?= $visitor['visit_time'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="inputDataModal" tabindex="-1" aria-labelledby="inputDataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputDataModalLabel">Tambah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <div class="mb-3">
                                    <input type="text" name="nik" class="form-control rounded-0" placeholder="Nik" required maxlength="16">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="nama" class="form-control rounded-0" placeholder="Nama" required>
                                </div>
                                <div class="mb-3">
                                    <select name="role" class="form-control rounded-0">
                                        <option value="" selected disabled>Role</option>
                                        <option value="pengisi">Pengisi</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="username" name="username" class="form-control rounded-0" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control rounded-0" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <?php require '../../app/config/cdn/js.php'; ?>
</body>

</html>