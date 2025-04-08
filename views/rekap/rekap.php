<?php
session_start();
error_reporting(1);
require '../../app/controller/RekapController.php';
require '../../app/middleware/Auth.php';
require '../../app/controller/CountController.php';
logUserVisit();
authMiddleware();


if (isset($_GET['no_rumah'])) {
    $no_rumah = $_GET['no_rumah'];

    $keluarga = getKeluarga($no_rumah);
    $kondisiRumah = getKondisiRumah($no_rumah);
    $kamarMandi = getKamarMandi($no_rumah);
    $listrik = getListrik($no_rumah);
    $barang = getBarang($no_rumah);
    $buah = getBuah($no_rumah);
    $ternak = getTernak($no_rumah);
    $usaha = getUsaha($no_rumah);
    $air = getAir($no_rumah);
    $pangan = getPangan($no_rumah);
    $obat = getObat($no_rumah);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap data keluarga</title>
    <?php require '../../app/config/cdn/css.php' ?>
    <link rel="icon" type="image/png" href="../../public/asset/logo/logo-title.png">

</head>
<style>
    <?php require '../../public/css/rekap.css'; ?>
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
                        <a class="nav-link" href="rekap.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle aktif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_penduduk">Data Penduduk</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_keluarga">Data Keluarga</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tempat tinggal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../layout/app.php?pages=kondisi_rumah">Rumah</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=kamar_mandi">Kamar Mandi</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_listrik">Listrik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kepemilikan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_barang">Barang</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_ternak">Ternak</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=tanaman_buah">Tanaman Buah</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=tanaman_pangan">Tanaman Pangan</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=tanaman_obat">Tanaman Obat</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_air">Sumber Air</a></li>
                            <li><a class="dropdown-item" href="../layout/app.php?pages=data_usaha">Usaha</a></li>
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
    <div class="container-fluid main">
        <h2 class="text-center mb-5">DESA SELAKAMBANG</h2>
        <form action="../rekap/rekap.php" method="get" class="mb-5">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-dark text-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="no_rumah" class="form-control" placeholder="Masukkan No Rumah" required>
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-arrow-right-circle"></i> Cari
                </button>
            </div>
        </form>
                <div class="p-3 bg-light rounded shadow-sm">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button class="btn btn-dark d-flex align-items-center gap-2" onclick="printPage()">
                    <i class="bi bi-printer-fill fs-5"></i> Cetak
                </button>

                <form method="GET" action="export_excel.php" class="d-flex flex-wrap align-items-center gap-2">
                    <label for="no_rumah" class="fw-semibold">Pilih:</label>
                    <select name="no_rumah" id="no_rumah" class="form-select w-auto">
                        <option value="">-- Semua --</option>
                        <?php
                        require '../../app/database/connection.php';
                        $query = $pdo->query("SELECT DISTINCT no_rumah FROM data_keluarga ORDER BY no_rumah");
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['no_rumah']}'>{$row['no_rumah']}</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-dark d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-arrow-down-fill fs-5"></i> Export
                    </button>
                </form>
            </div>
        </div>


        <div class="table-container">
            <h1 class="text-center mb-4">📋 Data Keluarga</h1>

            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No Rumah</th>
                        <th>Nama Pemilik</th>
                        <th>No KK1</th>
                        <th>Nama KK1</th>
                        <th>No KK2</th>
                        <th>Nama KK2</th>
                        <th>No KK3</th>
                        <th>Nama KK3</th>
                        <th>Alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>No Telp</th>
                        <th>Luas Tanah (m²)</th>
                        <th>Sertifikat (m²)</th>
                        <th>Belum Sertifikat (m²)</th>
                        <th>Pemukiman (m²)</th>
                        <th>Pertanian (m²)</th>
                        <th>Pekarangan (m²)</th>
                        <th>PKH</th>
                        <th>SEMBAKO</th>
                        <th>RTLH (Tahun)</th>
                        <th>BLT (Tahun)</th>
                        <th>LAINNYA</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php foreach ($keluarga as $row): ?>
                        <tr>
                            <td><?= $row['no_rumah'] ?></td>
                            <td><?= $row['nama_pemilik'] ?></td>
                            <td><?= $row['no_kk1'] ?></td>
                            <td><?= $row['nama_kk1'] ?></td>
                            <td><?= $row['no_kk2'] ?></td>
                            <td><?= $row['nama_kk2'] ?></td>
                            <td><?= $row['no_kk3'] ?></td>
                            <td><?= $row['nama_kk3'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['rt'] ?></td>
                            <td><?= $row['rw'] ?></td>
                            <td><?= $row['no_telp'] ?></td>
                            <td><?= $row['luas_tanah'] ?> M²</td>
                            <td><?= $row['sertifikat'] ?> M²</td>
                            <td><?= $row['belum_sertifikat'] ?> M²</td>
                            <td><?= $row['pemukiman'] ?> M²</td>
                            <td><?= $row['pertanian'] ?> M²</td>
                            <td><?= $row['pekarangan'] ?> M²</td>
                            <td><?= ($row['pkh'] ? 'Ya' : 'Tidak') ?></td>
                            <td><?= ($row['sembako'] ? 'Ya' : 'Tidak') ?></td>
                            <td><?= $row['rtlh'] ?></td>
                            <td><?= $row['blt'] ?></td>
                            <td><?= $row['lainnya'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Kondisi Rumah</h1>
            <table class="table table-bordered text-center table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Bangunan</th>
                        <th>Terbuat Dari</th>
                        <th>Keadaan</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($kondisiRumah as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['bangunan']; ?></td>
                            <td><?= $row['terbuat_dari']; ?></td>
                            <td><?= $row['keadaan']; ?></td>
                            <td>
                                <img src="../../public/asset/foto/<?= $row['foto']; ?>" width="50px"
                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                    onclick="document.getElementById('modalImage').src='../../public/asset/foto/<?= $row['foto']; ?>'">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center ">📋 Data Kondisi Kamar Mandi</h2>
                <table class="table table-bordered text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rumah</th>
                            <th>Bangunan</th>
                            <th>Jenis</th>
                            <th>Keadaan</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        <?php $no = 1;
                        foreach ($kamarMandi as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['no_rumah']; ?></td>
                                <td><?= $row['bangunan']; ?></td>
                                <td><?= $row['jenis']; ?></td>
                                <td><?= $row['keadaan']; ?></td>
                                <td>
                                    <img src="../../public/asset/foto/<?= $row['foto']; ?>" width="50px"
                                        data-bs-toggle="modal" data-bs-target="#imageModal"
                                        onclick="document.getElementById('modalImage').src='../../public/asset/foto/<?= $row['foto']; ?>'">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Kondisi Listrik</h1>
            <table class="table table-bordered text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Jenis</th>
                        <th>Daya</th>
                        <th>Sumber</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($listrik as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['jenis']; ?></td>
                            <td><?= $row['daya']; ?></td>
                            <td><?= $row['menyalur_ke']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="text-role">Login sebagai <span class="text-primary"><?= $_SESSION['role'] ?></span></p>
        <h1 class="text-center mt-5">Kepemilikan</h1>

        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Barang</h1>

            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($barang as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Tanaman Buah</h1>

            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Nama Buah</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($buah as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['nama_buah']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Tanaman Obat</h2>

                <table class="table table-bordered table-hover text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th class="no">No</th>
                            <th>No Rumah</th>
                            <th>Nama Tanaman</th>
                            <th>Jumlah/Lebar</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        <?php $no = 1;
                        foreach ($obat as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_rumah']; ?></td>
                                <td><?= $row['nama_obat']; ?></td>
                                <td><?= $row['jumlah']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Tanaman Pangan</h2>

                <table class="table table-bordered table-hover text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th class="no">No</th>
                            <th>No Rumah</th>
                            <th>Nama Tanaman</th>
                            <th>Jumlah/Lebar</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        <?php $no = 1;
                        foreach ($pangan as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_rumah']; ?></td>
                                <td><?= $row['nama_pangan']; ?></td>
                                <td><?= $row['jumlah']; ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Sumber Air</h1>

            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Sumber Air</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($air as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['sumber_air']; ?></td>
                            <td><?= !empty($row['keterangan']) ? $row['keterangan'] : 'Tidak ada keterangan'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Ternak</h1>
            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Nama Ternak</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($ternak as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['nama_ternak']; ?></td>
                            <td><?= $row['jumlah']; ?> Ekor</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-container ">
            <h1 class="mb-4 text-center">📋 Data Usaha</h2>

                <table class="table table-bordered table-hover text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th class="no">No</th>
                            <th>No Rumah</th>
                            <th>Usaha</th>
                            <th>keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        <?php $no = 1;
                        foreach ($usaha as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_rumah']; ?></td>
                                <td><?= $row['nama_usaha']; ?></td>
                                <td><?= !empty($row['keterangan']) ? $row['keterangan'] : 'Tidak ada keterangan'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
    <footer class="text-center py-2">
        <p class="mb-0">&copy; <?= date("Y"); ?> Selakambang. All Rights Reserved.</p>
    </footer>

    <script>
        function printPage() {
            window.print();
        }
    </script>
    <?php require '../../app/config/cdn/js.php' ?>
</body>

</html>