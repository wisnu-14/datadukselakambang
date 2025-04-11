<?php
require '../../app/database/connection.php';

function index()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM data_keluarga");
    $stmt->execute();
    return $stmt->fetchAll();
}
function getId($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM data_keluarga WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}
function delete($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM data_keluarga WHERE id=?");
    $stmt->execute([$id]);
}
function create($request)
{
    global $pdo;
    $request = [
        'no_rumah' => $_POST['no_rumah'],
        'nama_pemilik' => $_POST['nama_pemilik'],
        'no_kk1' => $_POST['no_kk1'],
        'nama_kk1' => $_POST['nama_kk1'],
        'no_kk2' => $_POST['no_kk2'],
        'nama_kk2' => $_POST['nama_kk2'],
        'no_kk3' => $_POST['no_kk3'],
        'nama_kk3' => $_POST['nama_kk3'],
        'alamat' => $_POST['alamat'],
        'rt' => $_POST['rt'],
        'rw' => $_POST['rw'],
        'no_telp' => $_POST['no_telp'],
        'luas_tanah' => $_POST['luas_tanah'],
        'sertifikat' => $_POST['sertifikat'],
        'belum_sertifikat' => $_POST['belum_sertifikat'],
        'pemukiman' => $_POST['pemukiman'],
        'pertanian' => $_POST['pertanian'],
        'pekarangan' => $_POST['pekarangan'],
        'pkh' => isset($_POST['pkh']) ? 1 : 0,
        'sembako' => isset($_POST['sembako']) ? 1 : 0,
        'rtlh' => $_POST['rtlh'],
        'blt' => $_POST['blt'],
        'lainnya' => $_POST['lainnya'],
    ];
    $stmt = $pdo->prepare("INSERT INTO data_keluarga (no_rumah, nama_pemilik, no_kk1, nama_kk1, no_kk2, nama_kk2, no_kk3, nama_kk3, alamat, rt, rw, no_telp, luas_tanah, sertifikat, belum_sertifikat, pemukiman, pertanian, pekarangan, pkh, sembako, rtlh, blt, lainnya)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array_values($request));
}
function edit($request)
{
    global $pdo;

    try {
        // Pastikan setiap input ada dan sesuai tipe datanya
        $request = [
            'no_rumah' => $_POST['no_rumah'] ?? '',
            'nama_pemilik' => $_POST['nama_pemilik'] ?? '',
            'no_kk1' => $_POST['no_kk1'] ?? '',
            'nama_kk1' => $_POST['nama_kk1'] ?? '',
            'no_kk2' => $_POST['no_kk2'] ?? '',
            'nama_kk2' => $_POST['nama_kk2'] ?? '',
            'no_kk3' => $_POST['no_kk3'] ?? '',
            'nama_kk3' => $_POST['nama_kk3'] ?? '',
            'alamat' => $_POST['alamat'] ?? '',
            'rt' => !empty($_POST['rt']) ? (int)$_POST['rt'] : NULL,
            'rw' => !empty($_POST['rw']) ? (int)$_POST['rw'] : NULL,
            'no_telp' => filter_var($_POST['no_telp'] ?? '', FILTER_SANITIZE_STRING),
            'luas_tanah' => !empty($_POST['luas_tanah']) ? (float)$_POST['luas_tanah'] : NULL,
            'sertifikat' => $_POST['sertifikat'] ?? '',
            'belum_sertifikat' => $_POST['belum_sertifikat'] ?? '',
            'pemukiman' => $_POST['pemukiman'] ?? '',
            'pertanian' => $_POST['pertanian'] ?? '',
            'pekarangan' => $_POST['pekarangan'] ?? '',
            'pkh' => isset($_POST['pkh']) ? 1 : 0,
            'sembako' => isset($_POST['sembako']) ? 1 : 0,
            'rtlh' => !empty($_POST['rtlh']) ? (int)$_POST['rtlh'] : NULL,
            'blt' => !empty($_POST['blt']) ? (int)$_POST['blt'] : NULL,
            'lainnya' => $_POST['lainnya'] ?? '',
            'id' => !empty($_POST['id']) ? (int)$_POST['id'] : NULL
        ];

        $stmt = $pdo->prepare("UPDATE data_keluarga 
            SET no_rumah = ?, nama_pemilik = ?, no_kk1 = ?, nama_kk1 = ?, 
                no_kk2 = ?, nama_kk2 = ?, no_kk3 = ?, nama_kk3 = ?, alamat = ?, 
                rt = ?, rw = ?, no_telp = ?, luas_tanah = ?, sertifikat = ?, 
                belum_sertifikat = ?, pemukiman = ?, pertanian = ?, pekarangan = ?, 
                pkh = ?, sembako = ?, rtlh = ?, blt = ?, lainnya = ? 
            WHERE id = ?");

        $stmt->execute(array_values($request));
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
