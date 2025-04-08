<?php
error_reporting(1);
require '../../app/controller/AuthController.php';
require '../../app/middleware/Auth.php';
adminMiddleware();
generateCsrfToken();
// Mengambil data user dari database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Cek apakah password diubah atau tidak
    editUser($_POST);

    $_SESSION['success_message'] = "Data berhasil diperbarui!";
    header("Location: index.php");
    exit;
}
