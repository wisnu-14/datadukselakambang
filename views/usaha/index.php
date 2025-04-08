<?php
require '../../app/controller/UsahaController.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    create($_POST);
    $_SESSION['sukses'] = "Berhasil tambah data!";
    header("Location: ?pages=data_usaha");
    exit;
}
$data = showNoRumah();
$row = index();
?>
<style>
    <?php require '../../public/css/usaha.css'; ?>
</style>

<div class="container mt-5">
        <?php if (isset($_SESSION['sukses'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['sukses']); ?>
    <?php endif; ?>
    <div class="form-container">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Input Data
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <h2 class="mb-4 text-center">Input Data Usaha</h2>
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="noRumah" class="form-label fw-bold">No Rumah</label>
                                    <select class="form-control" id="noRumah" name="no_rumah" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <?php foreach ($data as $data): ?>
                                            <option value="<?= $data['no_rumah']; ?>">
                                                <?= $data['no_rumah']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="namaBarang" class="form-label fw-bold">Usaha</label>
                                    <input type="text" class="form-control" id="namaBarang" name="nama_usaha" placeholder="Masukan nama usaha">
                                </div>
                                <div class="col-md-4">
                                    <label for="jumlah" class="form-label fw-bold">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan keterangan">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark mt-3 w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 text-center">Data Usaha</h2>
        <div class="table-container">
            <div class="input-group mb-3">
                <span class="input-group-text rounded-0">
                    <i class="bi bi-search"></i> <!-- Ikon Bootstrap -->
                </span>
                <input type="text" id="searchInput" class="form-control rounded-0" placeholder="Cari data..." onkeyup="searchData()">
            </div>
            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Usaha</th>
                        <th>keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1;
                    foreach ($row as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['no_rumah']; ?></td>
                            <td><?= $row['nama_usaha']; ?></td>
                            <td><?= !empty($row['keterangan']) ? $row['keterangan'] : 'Tidak ada keterangan'; ?></td>
                            <td>
                                <button onclick="openEditPage(<?= $row['id']; ?>)" class="btn btn-dark btn-custom">✏ Edit</button>
                                <a href="../usaha/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-dark btn-custom">🗑 Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function openEditPage(id) {
        window.open("?pages=edit_data_usaha&id=" + id, "_blank", "width=1000,height=400");
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