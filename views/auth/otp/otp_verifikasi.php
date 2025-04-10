<?php
// verify_otp.php
session_start();

if (!isset($_SESSION['otp'], $_SESSION['pending_user'])) {
    die("Akses tidak sah.");
}

if (time() > $_SESSION['otp_expiry']) {
    session_destroy();
    die("Kode OTP telah kedaluwarsa.");
}

if ($_POST['otp'] == $_SESSION['otp']) {
    $_SESSION['user_id'] = $_SESSION['pending_user']['id'];
    $_SESSION['username'] = $_SESSION['pending_user']['username'];
    $_SESSION['role'] = $_SESSION['pending_user']['role'];

    unset($_SESSION['otp'], $_SESSION['otp_expiry'], $_SESSION['pending_user']);

    header("Location: ../redirect.php");
    exit;
} else {
    echo "Kode OTP salah.";
}
