<?php
require '../../app/controller/ListrikController.php';
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
                            <label class="form-label fw-bold">Jenis</label>
                            <select class="form-control" name="jenis" >
                                <option value="" selected disabled>Pilih</option>
                                <option value="Pasca Bayar">Pasca Bayar</option>
                                <option value="Pra Bayar">Pra Bayar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label fw-bold">Daya</label>
                                <input type="text" class="form-control" id="" name="daya" placeholder="Contoh 100 watt" value="<?= $data['daya'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label fw-bold">Sumber</label>
                                <input type="text" class="form-control" id="" name="menyalur_ke" placeholder="Sebutkan menyalur darimana" value="<?= $data['menyalur_ke'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="no_rumah" value="<?= $data['no_rumah'] ?>">
                    <input type="hidden" name="jenis" value="<?= $data['jenis'] ?>">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-dark w-100">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>