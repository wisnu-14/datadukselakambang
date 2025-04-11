<?php
require '../../app/database/connection.php';

// Ambil semua data sumber air
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM sumber_air ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data sumber air berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM sumber_air WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data sumber air berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM sumber_air WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Ambil semua no_rumah dari data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data sumber air
function create($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'sumber_air' => trim($request['sumber_air']),
        'keterangan' => trim($request['keterangan'])
    ];

    $stmt = $pdo->prepare("INSERT INTO sumber_air (no_rumah, sumber_air, keterangan) VALUES (:no_rumah, :sumber_air, :keterangan)");
    $stmt->execute($data);
}

// Edit/update data sumber air
function edit($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'sumber_air' => trim($request['sumber_air']),
        'keterangan' => trim($request['keterangan']),
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("UPDATE sumber_air SET no_rumah = :no_rumah, sumber_air = :sumber_air, keterangan = :keterangan WHERE id = :id");
    $stmt->execute($data);
}
