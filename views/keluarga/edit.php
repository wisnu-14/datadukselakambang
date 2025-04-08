<?php
require '../../app/controller/KeluargaController.php';
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
<div class="container-fluid mt-4">
    <h1 class="mb-5">Input Data Keluarga</h1>
    <form method="POST" action="">
        <div class="mb-3 row">
            <label for="noRumah" class="col-sm-2 col-form-label">NO RUMAH:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="noRumah" name="no_rumah" placeholder=".............................." value="<?= $data['no_rumah'] ?>">
            </div>
            <div class="col-sm-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="milikSendiri" name="milik_sendiri">
                    <label class="form-check-label" for="milikSendiri">Milik Sendiri</label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="numpang" name="numpang">
                    <label class="form-check-label" for="numpang">Numpang</label>
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="namaPemilik" class="col-sm-2 col-form-label">NAMA PEMILIK:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namaPemilik" name="nama_pemilik" placeholder=".............................." value="<?= $data['nama_pemilik'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="noKK1" class="col-sm-2 col-form-label">NO KK:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="noKK1" name="no_kk1" placeholder="1. .............................." value="<?= $data['no_kk1'] ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="namaKK1" name="nama_kk1" placeholder="NAMA KK:.............................." value="<?= $data['nama_kk1'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-4 offset-sm-2">
                <input type="text" class="form-control" id="noKK2" name="no_kk2" placeholder="2. .............................." value="<?= $data['no_kk2'] ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="namaKK2" name="nama_kk2" placeholder="NAMA KK:.............................." value="<?= $data['nama_kk2'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-4 offset-sm-2">
                <input type="text" class="form-control" id="noKK3" name="no_kk3" placeholder="3. .............................." value="<?= $data['no_kk'] ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="namaKK3" name="nama_kk3" placeholder="NAMA KK:.............................." value="<?= $data['nama_kk3'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">ALAMAT:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Desa Selakambang " value="<?= $data['alamat'] ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="rt" name="rt" placeholder="RT ...................." value="<?= $data['rt'] ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="rw" name="rw" placeholder="RW ................" value="<?= $data['rw'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="noTelp" class="col-sm-2 col-form-label">NO TELP:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp" name="no_telp" placeholder=".............................." value="<?= $data['no_telp'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Kepemilikan Tanah:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="luasTanah" name="luas_tanah" placeholder="..........m2" value="<?= $data['luas_tanah'] ?>">
            </div>
            <label class="col-sm-1 col-form-label">Sertifikat:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="sertifikat" name="sertifikat" placeholder="..........m2" value="<?= $data['sertifikat'] ?>">
            </div>
            <label class="col-sm-1 col-form-label">Belum:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="belumSertifikat" name="belum_sertifikat" placeholder="..........m2" value="<?= $data['belum_sertifikat'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Penggunaan:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="pemukiman" name="pemukiman" placeholder="Pemukiman:..........m2" value="<?= $data['pemukiman'] ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="pertanian" name="pertanian" placeholder="Pertanian:..........m2" value="<?= $data['pertanian'] ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="pekarangan" name="pekarangan" placeholder="Pekarangan:..........m2" value="<?= $data['pekarangan'] ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Bantuan Sosial:</label>
            <div class="col-sm-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="pkh" name="pkh">
                    <label class="form-check-label" for="pkh">PKH</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sembako" name="sembako">
                    <label class="form-check-label" for="sembako">SEMBAKO</label>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="rtlh">RTLH:</label>
                    <input type="text" class="form-control" id="rtlh" name="rtlh" placeholder="TAHUN ............" value="<?= $data['rlth'] ?>">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="blt">BLT:</label>
                    <input type="text" class="form-control" id="blt" name="blt" placeholder="TAHUN ............" value="<?= $data['blt'] ?>">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="lainnya">LAINNYA:</label>
                    <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="............" value="<?= $data['lainnya'] ?>">
                </div>
            </div>
        </div>
        <p class="text-danger fst-italic">data yang tidak diisi harap diisi dengan strip (-) </p>
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="col">
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="data_keluarga.php" class="btn btn-dark">Kembali</a>
        </div>
    </form>
</div>