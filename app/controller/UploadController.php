<?php
function uploadFoto()
{
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];
    $dir  = __DIR__ . '/../../public/asset/foto/';
    $ext  = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    // Validasi ekstensi
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
        echo "<script>alert('Format file tidak valid!')</script>";
        return false;
    }

    // Validasi ukuran (maks 500KB)
    if ($size > 1024 * 500) {
        echo "<script>alert('Ukuran file terlalu besar! Maks 500KB.')</script>";
        return false;
    }

    $newName = uniqid() . "." . $ext;

    // Pindahkan file dan cek apakah berhasil
    if (move_uploaded_file($tmp, $dir . $newName)) {
        return $newName;
    } else {
        echo "<script>alert('Gagal upload gambar!')</script>";
        return false;
    }
}
