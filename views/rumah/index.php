<?php
require '../../app/controller/RumahController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    createRumah($_POST);
    $_SESSION['sukses'] = "Berhasil tambah data!";
    header("Location: ?pages=kondisi_rumah");
    exit;

}

$data = showNoRumah();
$row = index();
?>

<style>
    <?php require '../../public/css/rumah.css'; ?>
</style>


<div class="container mt-5">
    <?php if (isset($_SESSION['sukses'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['sukses']); ?>
    <?php endif; ?>
    <div class="card p-4 shadow-sm">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Input Data
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <h2 class="mb-4 text-center">Input Kondisi Rumah</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">No Rumah</label>
                                    <select class="form-control" name="no_rumah" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <?php foreach ($data as $item): ?>
                                            <option value="<?= htmlspecialchars($item['no_rumah']); ?>"><?= htmlspecialchars($item['no_rumah']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="bangunan" class="form-label fw-bold">Bangunan</label>
                                        <select class="form-control" id="bangunan" name="bangunan" required>
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Atap">Atap</option>
                                            <option value="Lantai">Lantai</option>
                                            <option value="Dinding">Dinding</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Terbuat Dari</label>
                                    <input type="text" class="form-control" name="terbuat_dari" placeholder="Masukkan bahan" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Keadaan</label>
                                    <select class="form-control" name="keadaan" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="rusak">Rusak</option>
                                        <option value="rusakParah">Rusak Parah</option>
                                        <option value="bagus">Bagus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Upload Foto Rumah</label>
                                <input type="file" class="form-control" name="foto" accept="image/*" >
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
        <h2 class="mb-4 text-center">Data Kondisi Rumah</h2>
        <div class="table-responsive">
            <div class="input-group mb-3">
                <span class="input-group-text rounded-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control rounded-0" placeholder="Cari data..." onkeyup="searchData()">
            </div>
            <table class="table table-bordered text-center" id="dataTable">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th>No Rumah</th>
                        <th>Bangunan</th>
                        <th>Terbuat Dari</th>
                        <th>Keadaan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataBody">
                    <?php $no = 1; foreach ($row as $r): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($r['no_rumah']); ?></td>
                            <td><?= htmlspecialchars($r['bangunan']); ?></td>
                            <td><?= htmlspecialchars($r['terbuat_dari']); ?></td>
                            <td><?= htmlspecialchars($r['keadaan']); ?></td>
                            <td>
                                <img src="../../public/asset/foto/<?= htmlspecialchars($r['foto']); ?>" width="50px"
                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                    onclick="document.getElementById('modalImage').src='../../public/asset/foto/<?= htmlspecialchars($r['foto']); ?>'">
                            </td>
                            <td>
                                <button onclick="openEditPage(<?= $r['id']; ?>)" class="btn btn-dark btn-sm">✏ Edit</button>
                                <a href="../rumah/delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-dark btn-sm">🗑 Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Preview Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Gambar" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    function openEditPage(id) {
        window.location.href = "?pages=edit_kondisi_rumah&id=" + id;
    }

    function searchData() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#dataBody tr");

        rows.forEach(row => {
            let found = false;
            let cells = row.getElementsByTagName("td");

            for (let i = 1; i < cells.length - 1; i++) {
                let text = cells[i].textContent.toLowerCase();
                if (text.includes(input)) {
                    found = true;
                }
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
