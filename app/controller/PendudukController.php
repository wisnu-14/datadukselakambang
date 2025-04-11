<?php
require '../../app/database/connection.php';

// Ambil semua data penduduk
function index()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM data_penduduk ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil satu data berdasarkan ID
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM data_penduduk WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM data_penduduk WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Tambah data penduduk
function create($request)
{
    global $pdo;

    $data = [
        'status' => trim($request['status']),
        'nama' => trim($request['nama']),
        'nik' => trim($request['nik']),
        'tempat' => trim($request['tempat']),
        'tanggal_lahir' => $request['tanggal_lahir'],
        'jenis_kelamin' => $request['jenis_kelamin'],
        'pendidikan_terakhir' => trim($request['pendidikan_terakhir']),
        'pekerjaan' => trim($request['pekerjaan']),
        'penghasilan_perbulan' => is_numeric($request['penghasilan_perbulan']) ? $request['penghasilan_perbulan'] : null,
        'penyakit_diderita' => trim($request['penyakit_diderita']),
        'penderita_cacat' => trim($request['penderita_cacat']),
    ];

    $stmt = $pdo->prepare("
        INSERT INTO data_penduduk (
            status, nama, nik, tempat, tanggal_lahir,
            jenis_kelamin, pendidikan_terakhir, pekerjaan,
            penghasilan_perbulan, penyakit_diderita, penderita_cacat
        )
        VALUES (
            :status, :nama, :nik, :tempat, :tanggal_lahir,
            :jenis_kelamin, :pendidikan_terakhir, :pekerjaan,
            :penghasilan_perbulan, :penyakit_diderita, :penderita_cacat
        )
    ");
    $stmt->execute($data);
}

// Edit data penduduk
function edit($request)
{
    global $pdo;

    $data = [
        'status' => trim($request['status']),
        'nama' => trim($request['nama']),
        'nik' => trim($request['nik']),
        'tempat' => trim($request['tempat']),
        'tanggal_lahir' => $request['tanggal_lahir'],
        'jenis_kelamin' => $request['jenis_kelamin'],
        'pendidikan_terakhir' => trim($request['pendidikan_terakhir']),
        'pekerjaan' => trim($request['pekerjaan']),
        'penghasilan_perbulan' => is_numeric($request['penghasilan_perbulan']) ? $request['penghasilan_perbulan'] : null,
        'penyakit_diderita' => trim($request['penyakit_diderita']),
        'penderita_cacat' => trim($request['penderita_cacat']),
        'id' => (int)$request['id']
    ];

    $stmt = $pdo->prepare("
        UPDATE data_penduduk SET
            status = :status,
            nama = :nama,
            nik = :nik,
            tempat = :tempat,
            tanggal_lahir = :tanggal_lahir,
            jenis_kelamin = :jenis_kelamin,
            pendidikan_terakhir = :pendidikan_terakhir,
            pekerjaan = :pekerjaan,
            penghasilan_perbulan = :penghasilan_perbulan,
            penyakit_diderita = :penyakit_diderita,
            penderita_cacat = :penderita_cacat
        WHERE id = :id
    ");
    $stmt->execute($data);
}
