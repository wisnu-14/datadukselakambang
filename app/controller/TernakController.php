<?php
require '../../app/database/connection.php';
// Ambil semua data ternak
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM ternak ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM ternak WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM ternak WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Tampilkan no_rumah dari data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data ternak
function create($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_ternak' => trim($request['nama_ternak']),
        'jumlah' => (int)$request['jumlah']
    ];

    $stmt = $pdo->prepare("INSERT INTO ternak (no_rumah, nama_ternak, jumlah) VALUES (:no_rumah, :nama_ternak, :jumlah)");
    $stmt->execute($data);
}

// Edit data ternak
function edit($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_ternak' => trim($request['nama_ternak']),
        'jumlah' => (int)$request['jumlah'],
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("UPDATE ternak SET no_rumah = :no_rumah, nama_ternak = :nama_ternak, jumlah = :jumlah WHERE id = :id");
    $stmt->execute($data);
}
