<?php
require '../../app/controller/KeluargaController.php';

$row = index();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    create($_POST);
    $_SESSION['sukses'] = "Berhasil tambah data!";
    header("Location: ?pages=data_keluarga");
    exit;
}
?>
<style>
    <?php require '../../public/css/keluarga.css'; ?>
</style>

<div class="container-fluid mt-4">
        <?php if (isset($_SESSION['sukses'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['sukses']); ?>
    <?php endif; ?>
    <h1 class="text-center mb-4">📋 Data Keluarga</h1>
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
                        <form method="POST" action="">
                            <div class="mb-3 row">
                                <label for="noRumah" class="col-sm-2 col-form-label">NO RUMAH:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noRumah" name="no_rumah" placeholder="..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="namaPemilik" class="col-sm-2 col-form-label">NAMA PEMILIK:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaPemilik" name="nama_pemilik" placeholder="..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="noKK1" class="col-sm-2 col-form-label">NO KK:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="noKK1" name="no_kk1" placeholder="1. ..............................">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="namaKK1" name="nama_kk1" placeholder="NAMA KK:..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" id="noKK2" name="no_kk2" placeholder="2. ..............................">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="namaKK2" name="nama_kk2" placeholder="NAMA KK:..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" id="noKK3" name="no_kk3" placeholder="3. ..............................">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="namaKK3" name="nama_kk3" placeholder="NAMA KK:..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">ALAMAT:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Desa Selakambang ">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="RT ....................">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="RW ................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="noTelp" class="col-sm-2 col-form-label">NO TELP:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noTelp" name="no_telp" placeholder="..............................">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kepemilikan Tanah:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="luasTanah" name="luas_tanah" placeholder="..........m²">
                                </div>
                                <label class="col-sm-1 col-form-label">Sertifikat:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="sertifikat" name="sertifikat" placeholder="..........m²">
                                </div>
                                <label class="col-sm-1 col-form-label">Belum:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="belumSertifikat" name="belum_sertifikat" placeholder="..........m²">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Penggunaan:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="pemukiman" name="pemukiman" placeholder="Pemukiman:..........m²">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="pertanian" name="pertanian" placeholder="Pertanian:..........m²">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="pekarangan" name="pekarangan" placeholder="Pekarangan:..........m²">
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
                                        <input type="text" class="form-control" id="rtlh" name="rtlh" placeholder="TAHUN ............">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="blt">BLT:</label>
                                        <input type="text" class="form-control" id="blt" name="blt" placeholder="TAHUN ............">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="lainnya">LAINNYA:</label>
                                        <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="............">
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text rounded-0">
                <i class="bi bi-search"></i> <!-- Ikon Bootstrap -->
            </span>
            <input type="text" id="searchInput" class="form-control rounded-0" placeholder="Cari data..." onkeyup="searchData()">
        </div>

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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataBody">
                <?php foreach ($row as $row): ?>
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
                        <td>
                            <button onclick="openEditPage(<?= $row['id']; ?>)" class="btn btn-dark">
                                ✏ Edit
                            </button>
                            <a href="../keluarga/delete.php?id=<?= $row['id'] ?>"
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
        window.open("?pages=edit_keluarga&id=" + id, "_blank", "width=1000,height=1000");
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