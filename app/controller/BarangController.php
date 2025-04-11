<?php
require '../../app/database/connection.php';

function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM barang");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
    $stmt->execute([$id]);
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

    $no_rumah     = $request['no_rumah'] ?? null;
    $nama_barang  = $request['nama_barang'] ?? null;
    $jumlah       = $request['jumlah'] ?? null;

    if (!$no_rumah || !$nama_barang || $jumlah === null) {
        throw new Exception("Data tidak lengkap.");
    }

    $stmt = $pdo->prepare("INSERT INTO barang (no_rumah, nama_barang, jumlah) VALUES (?, ?, ?)");
    $stmt->execute([$no_rumah, $nama_barang, $jumlah]);
}

function edit(array $request)
{
    global $pdo;

    $id           = $request['id'] ?? null;
    $no_rumah     = $request['no_rumah'] ?? null;
    $nama_barang  = $request['nama_barang'] ?? null;
    $jumlah       = $request['jumlah'] ?? null;

    if (!$id || !$no_rumah || !$nama_barang || $jumlah === null) {
        throw new Exception("Data tidak lengkap.");
    }

    $stmt = $pdo->prepare("UPDATE barang SET no_rumah = ?, nama_barang = ?, jumlah = ? WHERE id = ?");
    $stmt->execute([$no_rumah, $nama_barang, $jumlah, $id]);
}
