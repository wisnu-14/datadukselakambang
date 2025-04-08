<?php
require '../../app/controller/BarangController.php';
$id = $_GET['id'];
$barang = getId($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    edit($_POST);
    echo "<script>
    alert('Berhasil edit data');
    if (window.opener) {
        window.opener.location.reload(); // Refresh halaman utama
        window.close(); // Tutup tab edit
    } else {
        window.location.href = 'data_barang.php'; // Redirect jika tidak bisa close
    }
    </script>";
    exit;
}
$noRumah = showNoRumah();
?>
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Edit Data Barang</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <input type="hidden" name="id" value="<?= $barang['id'] ?>">
                <div class="col-md-4">
                    <label for="noRumah" class="fw-bold">No Rumah</label>
                    <select class="form-control" id="noRumah" name="no_rumah" required>
                        <option value="" selected disabled>Pilih</option>
                        <?php foreach ($noRumah as $item): ?>
                            <option value="<?= $item['no_rumah']; ?>" 
                                <?= ($item['no_rumah'] == $barang['no_rumah']) ? 'selected' : ''; ?>>
                                <?= $item['no_rumah']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="namaBarang" class="fw-bold">Kendaraan/Elektronik</label>
                    <input type="text" class="form-control" id="namaBarang" name="nama_barang" 
                        placeholder="Masukan Merek Barang" value="<?= $barang['nama_barang']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="jumlah" class="fw-bold">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" 
                        placeholder="Masukan Jumlah" value="<?= $barang['jumlah']; ?>" required>
                </div>
            </div>
            <div class="d-flex mt-4">
                <button type="submit" class="btn btn-dark  w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>
