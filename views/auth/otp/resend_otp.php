<?php
// resend_otp.php
session_start();
require '../../../app/config/mail/mailer.php';

if (!isset($_SESSION['pending_user'])) {
    header("Location: ../login.php");
    exit;
}

// Cek cooldown resend (misal 30 detik sekali)
if (isset($_SESSION['last_otp_sent']) && time() - $_SESSION['last_otp_sent'] < 30) {
    die("Tunggu beberapa detik sebelum mengirim ulang.");
}

$kodeOTP = rand(100000, 999999);
$_SESSION['otp'] = $kodeOTP;
$_SESSION['otp_expiry'] = time() + 300;
$_SESSION['last_otp_sent'] = time(); 

$email = $_SESSION['pending_user']['email'];

if (kirimOTP($email, $kodeOTP)) {
    header("Location: ../../auth/form_otp.php?resend=1");
    exit;
} else {
    echo "Gagal mengirim ulang OTP.";
}
