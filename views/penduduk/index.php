<?php
require '../../app/controller/PendudukController.php';
$data = index();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    create($_POST);
    $_SESSION['sukses'] = "Berhasil tambah data!";
    header("Location: ?pages=data_penduduk");
    exit;
}
?>
<style>
    <?php require '../../public/css/penduduk.css'; ?>
</style>

<div class="container-fluid mt-4">
        <?php if (isset($_SESSION['sukses'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['sukses']); ?>
    <?php endif; ?>
    <h1>📋 Data Penduduk</h1>
    <div class="table-container">
        <button type="button" class="btn btn-primary mb-3 border-0 rounded-0" data-bs-toggle="modal" data-bs-target="#inputDataModal">
            + Tambah Data
        </button>
        <div class="modal fade" id="inputDataModal" tabindex="-1" aria-labelledby="inputDataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputDataModalLabel">Input Data Keluarga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="">
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="">
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nik</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="">
                            </div>

                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat" name="tempat" value="">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="">
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
                                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="" placeholder="SD,SMP,SMA/SMK...">
                            </div>

                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="">
                            </div>

                            <div class="mb-3">
                                <label for="penghasilan_perbulan" class="form-label">Penghasilan Perbulan</label>
                                <input type="text" class="form-control" id="penghasilan_perbulan" name="penghasilan_perbulan" value="">
                            </div>

                            <div class="mb-3">
                                <label for="penyakit" class="form-label">Penyakit yang Diderita</label>
                                <input type="text" class="form-control" id="penyakit" name="penyakit_diderita" value="">
                                <small class="text-danger fst-italic">
                                    *jika tidak ada tulis <b> sehat</b>
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="penderita_cacat" class="form-label">Penderita Cacat</label>
                                <input type="text" class="form-control" id="penderita_cacat" name="penderita_cacat" value="">
                                <small class="text-danger fst-italic">
                                    *jika tidak ada tulis <b> sehat</b>
                                </small>
                                <br>
                                <br>
                                <small class="text-danger fs-italic">*data yang tidak diisi harap diisi dengan strip(-)</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text rounded-0">
                <i class="bi bi-search"></i> <!-- Ikon Bootstrap -->
            </span>
            <input type="text" id="searchInput" class="form-control rounded-0" placeholder="Cari data..." onkeyup="searchData()">
        </div>
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th>Status</th>
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Penghasilan</th>
                    <th>Penyakit</th>
                    <th>Cacat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataBody">
                <?php
                $no = 1;
                foreach ($data as $row):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['status'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['tempat'] ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['pendidikan_terakhir'] ?></td>
                        <td><?= $row['pekerjaan'] ?></td>
                        <td><?= $row['penghasilan_perbulan'] ?></td>
                        <td><?= $row['penyakit_diderita'] ?></td>
                        <td><?= $row['penderita_cacat'] ?></td>
                        <td>
                            <button onclick="openEditPage(<?= $row['id']; ?>)" class="btn btn-dark">
                                ✏ Edit
                            </button>
                            <a href="../penduduk/delete.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?');"
                                class="btn btn-dark">
                                🗑 Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
    function openEditPage(id) {
        window.open("?pages=edit_penduduk&id=" + id, "_blank", "width=1000,height=1000");
    }
</script>
<script>
    function searchData() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#dataBody tr");

        rows.forEach(row => {
            let found = false;
            let cells = row.getElementsByTagName("td");

            for (let i = 1; i < cells.length - 1; i++) { // Semua kolom kecuali "No" dan "Aksi"
                let text = cells[i].textContent.toLowerCase();
                if (text.includes(input)) {
                    found = true;
                }
                // Highlight teks yang cocok
                cells[i].innerHTML = highlightText(cells[i].textContent, input);
            }

            row.style.display = found ? "" : "none";
        });
    }

    function highlightText(text, search) {
        if (!search) return text;
        let regex = new RegExp(`(${search})`, "gi");
        return text.replace(regex, `<span style="background-color: yellow; color: black; padding: 2px; border-radius: 3px;">$1</span>`);
    }
</script>