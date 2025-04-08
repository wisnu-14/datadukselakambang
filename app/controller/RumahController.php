<?php
require '../../app/database/connection.php';
require '../../app/controller/UploadController.php';

function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM kondisi_rumah ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kondisi_rumah WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete($id)
{
    global $pdo;

    // Ambil data lama untuk hapus foto
    $stmt = $pdo->prepare("SELECT foto FROM kondisi_rumah WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data && !empty($data['foto'])) {
        $fotoPath = "../../public/asset/foto/" . $data['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath); // Hapus file foto dari folder
        }
    }

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM kondisi_rumah WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount(); // Bisa digunakan untuk validasi apakah sukses/gagal
    logAktivitas('Menghapus data rumah');
}

function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createRumah($request)
{
    global $pdo;

    // Upload foto
    $foto = uploadFoto();

    // Data yang akan disimpan
    $data = [
        'no_rumah' => trim($_POST['no_rumah']),
        'bangunan' => trim($_POST['bangunan']),
        'terbuat_dari' => trim($_POST['terbuat_dari']),
        'keadaan' => trim($_POST['keadaan']),
        'foto' => $foto
    ];

    $stmt = $pdo->prepare("INSERT INTO kondisi_rumah (no_rumah, bangunan, terbuat_dari, keadaan, foto) VALUES (:no_rumah, :bangunan, :terbuat_dari, :keadaan, :foto)");
    $stmt->execute($data);
     logAktivitas('menambah data rumah');
}

function edit($request)
{
    global $pdo;

    // Ambil data lama
    $stmt = $pdo->prepare("SELECT foto FROM kondisi_rumah WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $oldData = $stmt->fetch(PDO::FETCH_ASSOC);
    $old_foto = $oldData['foto'] ?? null;

    // Jika user upload foto baru, hapus yang lama
    if (!empty($_FILES['foto']['name'])) {
        $new_foto = uploadFoto();
        if ($old_foto && file_exists("../../public/asset/foto/$old_foto")) {
            unlink("../../public/asset/foto/$old_foto");
        }
    } else {
        $new_foto = $old_foto;
    }

    $data = [
        'no_rumah' => trim($_POST['no_rumah']),
        'bangunan' => trim($_POST['bangunan']),
        'terbuat_dari' => trim($_POST['terbuat_dari']),
        'keadaan' => trim($_POST['keadaan']),
        'foto' => $new_foto,
        'id' => $_POST['id']
    ];

    $stmt = $pdo->prepare("UPDATE kondisi_rumah SET no_rumah = :no_rumah, bangunan = :bangunan, terbuat_dari = :terbuat_dari, keadaan = :keadaan, foto = :foto WHERE id = :id");
    $stmt->execute($data);
    logAktivitas('mengedit data rumah');
}
