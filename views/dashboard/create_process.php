<?php
error_reporting(1);
require '../../app/controller/AuthController.php';
require '../../app/middleware/Auth.php';
generateCsrfToken();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die("CSRF token tidak valid.");
    }
    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = registerUser($_POST['nik'], $_POST['nama'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['role']);
        if ($result === true) {
            $_SESSION['success_message'] = "Berhasil tambah data!";
            header('Location: index.php');
        } else {
            header('Location: index.php');
        }
    }
}
