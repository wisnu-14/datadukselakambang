<?php
require '../../app/controller/KamarMandiController.php';

$id = $_GET['id'];
$data = getId($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    edit($_POST);
    echo "<script>
    alert('Berhasil edit data');
    if (window.opener) {
        window.opener.location.reload(); 
        window.close(); 
    }
    </script>";
    exit;
}
$noRumah = showNoRumah();
?>
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 text-center">Edit Kondisi Kamar Mandi</h2>
        <div class="row">
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="noRumah" class="form-label fw-bold">No Rumah</label>
                                <select class="form-control" id="noRumah" name="no_rumah">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php foreach ($noRumah as $row): ?>
                                        <option value="<?= $row['no_rumah']; ?>"><?= $row['no_rumah']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Bangunan</label>
                            <select class="form-control" name="bangunan" >
                                <option value="" selected disabled>Pilih</option>
                                <option value="Dinding">Dinding</option>
                                <option value="Wc">Wc</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenisDinding" class="form-label fw-bold">Jenis Dinding</label>
                                <input type="text" class="form-control" id="terbuatDariAtap" name="jenis" placeholder=" Masukkan jenis dinding">
                                <p class="text-danger fst-italic">*jenis dinding diisi hanya untuk jenis dinding!!</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="keadaanAtap" class="form-label fw-bold">Jenis WC</label>
                                <select class="form-control" id="keadaanAtap" name="jenis" required>
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="WC Luar">WC Luar</option>
                                    <option value="WC Dalam">WC Dalam</option>
                                </select>
                                <p class="text-danger fst-italic">*jenis WC diisi hanya untuk WC!!</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="keadaan" class="form-label fw-bold">Keadaan</label>
                                <select class="form-control" id="keadaan" name="keadaan" >
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Rusak Parah">Rusak Parah</option>
                                    <option value="Bagus">Bagus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-2 mb-2">
                        <img src="../../public/asset/foto/<?= $data['foto'] ?>" width="200px" class="img-thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto Rumah</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="no_rumah" value="<?= $data['no_rumah'] ?>">
                    <input type="hidden" name="bangunan" value="<?= $data['bangunan'] ?>">
                    <input type="hidden" name="foto" value="<?= $data['foto'] ?>">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-dark w-100">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>