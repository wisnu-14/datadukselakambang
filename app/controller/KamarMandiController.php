<?php
require '../../app/database/connection.php';
require '../../app/controller/UploadController.php';

function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM kamar_mandi");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kamar_mandi WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete($id)
{
    global $pdo;

    $data = getId($id);
    if ($data && !empty($data['foto'])) {
        $fotoPath = "../../public/asset/foto/" . $data['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }
    }

    $stmt = $pdo->prepare("DELETE FROM kamar_mandi WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}

function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function create(array $request)
{
    global $pdo;

    if (!empty($_FILES['foto']['name'])) {
        $foto = uploadFoto();
    } else {
        $foto = "tidak ada foto";
    }
    $no_rumah = $request['no_rumah'] ?? null;
    $bangunan = $request['bangunan'] ?? null;
    $jenis = $request['jenis'] ?? null;
    $keadaan = $request['keadaan'] ?? null;

    if (!$no_rumah || !$bangunan || !$jenis || !$keadaan || !$foto) {
        throw new Exception("Data tidak lengkap.");
    }

    $stmt = $pdo->prepare("INSERT INTO kamar_mandi (no_rumah, bangunan, jenis, keadaan, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$no_rumah, $bangunan, $jenis, $keadaan, $foto]);
}

function edit(array $request)
{
    global $pdo;

    $id = $request['id'] ?? null;
    $no_rumah = $request['no_rumah'] ?? null;
    $bangunan = $request['bangunan'] ?? null;
    $jenis = $request['jenis'] ?? null;
    $keadaan = $request['keadaan'] ?? null;

    if (!$id || !$no_rumah || !$bangunan || !$jenis || !$keadaan) {
        throw new Exception("Data tidak lengkap.");
    }

    // Ambil data lama
    $oldData = getId($id);
    $oldFoto = $oldData['foto'] ?? null;

    // Cek apakah user upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $newFoto = uploadFoto();

        // Hapus foto lama
        if ($oldFoto && file_exists("../../public/asset/foto/$oldFoto")) {
            unlink("../../public/asset/foto/$oldFoto");
        }
    } else {
        $newFoto = $oldFoto;
    }

    $stmt = $pdo->prepare("UPDATE kamar_mandi SET no_rumah = ?, bangunan = ?, jenis = ?, keadaan = ?, foto = ? WHERE id = ?");
    $stmt->execute([$no_rumah, $bangunan, $jenis, $keadaan, $newFoto, $id]);
}
