<?php
require '../../app/database/connection.php';

// Ambil semua data obat
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM obat ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM obat WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data obat berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM obat WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Ambil data no_rumah dari tabel data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data obat
function create($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_obat' => trim($request['nama_obat']),
        'jumlah' => trim($request['jumlah']),
    ];

    $stmt = $pdo->prepare("INSERT INTO obat (no_rumah, nama_obat, jumlah) VALUES (:no_rumah, :nama_obat, :jumlah)");
    $stmt->execute($data);
}

// Update data obat
function edit($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_obat' => trim($request['nama_obat']),
        'jumlah' => trim($request['jumlah']),
        'id' => (int) $request['id']
    ];

    $stmt = $pdo->prepare("UPDATE obat SET no_rumah = :no_rumah, nama_obat = :nama_obat, jumlah = :jumlah WHERE id = :id");
    $stmt->execute($data);
}
