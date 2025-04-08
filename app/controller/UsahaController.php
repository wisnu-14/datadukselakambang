<?php
require '../../app/database/connection.php';

// Ambil semua data usaha
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM usaha ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data usaha berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM usaha WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data usaha berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM usaha WHERE id = :id");
    $stmt->execute(['id' => $id]);
    logAktivitas('Menghapus data usaha');
}

// Ambil daftar no_rumah dari tabel data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data usaha
function create($request)
{
    global $pdo;
    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_usaha' => trim($request['nama_usaha']),
        'keterangan' => trim($request['keterangan'])
    ];

    $stmt = $pdo->prepare("INSERT INTO usaha (no_rumah, nama_usaha, keterangan) VALUES (:no_rumah, :nama_usaha, :keterangan)");
    $stmt->execute($data);
     logAktivitas('menambah data usaha');
}

// Edit data usaha
function edit($request)
{
    global $pdo;
    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_usaha' => trim($request['nama_usaha']),
        'keterangan' => trim($request['keterangan']),
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("UPDATE usaha SET no_rumah = :no_rumah, nama_usaha = :nama_usaha, keterangan = :keterangan WHERE id = :id");
    $stmt->execute($data);
    logAktivitas('mengedit data usaha');
}
