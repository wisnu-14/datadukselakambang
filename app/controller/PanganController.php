<?php
require '../../app/database/connection.php';

function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM pangan ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM pangan WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM pangan WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount() > 0;
}

function showNoRumah()
{
    global $pdo;
    $stmt = $pdo->query("SELECT no_rumah FROM data_keluarga ORDER BY no_rumah ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function create($request)
{
    global $pdo;
    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_pangan' => trim($request['nama_pangan']),
        'jumlah' => trim($request['jumlah']),
    ];

    $stmt = $pdo->prepare("INSERT INTO pangan (no_rumah, nama_pangan, jumlah) VALUES (:no_rumah, :nama_pangan, :jumlah)");
    return $stmt->execute($data);
}

function edit($request)
{
    global $pdo;
    $data = [
        'no_rumah' => trim($request['no_rumah']),
        'nama_pangan' => trim($request['nama_pangan']),
        'jumlah' => trim($request['jumlah']),
        'id' => (int)$request['id'],
    ];

    $stmt = $pdo->prepare("UPDATE pangan SET no_rumah = :no_rumah, nama_pangan = :nama_pangan, jumlah = :jumlah WHERE id = :id");
    return $stmt->execute($data);
}
