<?php
require '../../app/database/connection.php';
// Ambil semua data listrik
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM listrik ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM listrik WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data listrik berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM listrik WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Ambil data no_rumah dari data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data listrik
function create($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'jenis' => trim($request['jenis']),
        'daya' => trim($request['daya']),
        'menyalur_ke' => trim($request['menyalur_ke']),
    ];

    $stmt = $pdo->prepare("INSERT INTO listrik (no_rumah, jenis, daya, menyalur_ke) VALUES (:no_rumah, :jenis, :daya, :menyalur_ke)");
    $stmt->execute($data);
}

// Update data listrik
function edit($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'jenis' => trim($request['jenis']),
        'daya' => trim($request['daya']),
        'menyalur_ke' => trim($request['menyalur_ke']),
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("UPDATE listrik SET no_rumah = :no_rumah, jenis = :jenis, daya = :daya, menyalur_ke = :menyalur_ke WHERE id = :id");
    $stmt->execute($data);
}
