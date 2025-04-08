<?php
require '../../app/database/connection.php';

// Ambil semua data buah (dengan pagination bisa ditambahkan jika perlu)
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM buah ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data buah berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM buah WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data buah berdasarkan ID
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM buah WHERE id = :id");
    $stmt->execute(['id' => $id]);
    logAktivitas('Menghapus data buah');
}

// Ambil semua nomor rumah dari data_keluarga
function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah data buah
function create($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_buah' => trim($request['nama_buah']),
        'jumlah' => (int)$request['jumlah']
    ];

    $stmt = $pdo->prepare("INSERT INTO buah (no_rumah, nama_buah, jumlah) VALUES (:no_rumah, :nama_buah, :jumlah)");
    $stmt->execute($data);
    logAktivitas('menambah data buah');
}

// Edit/update data buah
function edit($request)
{
    global $pdo;

    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_buah' => trim($request['nama_buah']),
        'jumlah' => (int)$request['jumlah'],
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("UPDATE buah SET no_rumah = :no_rumah, nama_buah = :nama_buah, jumlah = :jumlah WHERE id = :id");
    $stmt->execute($data);
    logAktivitas('mengedit data buah');
}
