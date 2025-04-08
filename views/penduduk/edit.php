<?php
require '../../app/controller/PendudukController.php';
$id = $_GET['id'];
$data = getId($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    edit($_POST);
    echo "<script>
    alert('Berhasil edit data');
    if (window.opener) {
        window.opener.location.reload(); // Refresh halaman utama
        window.close(); // Tutup tab edit
    } else {
        window.location.href = 'data_keluarga.php'; // Redirect jika tidak bisa close
    }
    </script>";
    exit;
}
?>
<div class="container-fluid mt-5">
        <h2>Form Edit Data</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= $data['status'] ?>">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">Nik</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>">
            </div>

            <div class="mb-3">
                <label for="tempat" class="form-label">Tempat</label>
                <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $data['tempat'] ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="<?= $data['pendidikan_terakhir'] ?>">
            </div>

            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $data['pekerjaan'] ?>">
            </div>

            <div class="mb-3">
                <label for="penghasilan_perbulan" class="form-label">Penghasilan Perbulan</label>
                <input type="text" class="form-control" id="penghasilan_perbulan" name="penghasilan_perbulan" value="<?= $data['penghasilan_perbulan'] ?>">
            </div>

            <div class="mb-3">
                <label for="penyakit" class="form-label">Penyakit yang Diderita</label>
                <input type="text" class="form-control" id="penyakit" name="penyakit_diderita" value="<?= $data['penyakit_diderita'] ?>">
                <small class="text-danger fst-italic">
                    *jika tidak ada tulis <b> sehat</b>
                </small>
            </div>

            <div class="mb-3">
                <label for="penderita_cacat" class="form-label">Penderita Cacat</label>
                <input type="text" class="form-control" id="penderita_cacat" name="penderita_cacat" value="<?= $data['penderita_cacat'] ?>">
                <small class="text-danger fst-italic">
                    *jika tidak ada tulis <b> sehat</b>
                </small>
            </div>
            <small class="text-danger fs-italic">*data yang tidak diisi harap diisi dengan strip(-)</small>
            <div class="col mt-4">
                <button type="submit" class="btn btn-dark">Update</button>
                <a href="table_penduduk.php" class="btn btn-dark">Kembali</a>
            </div>
        </form>
    </div>