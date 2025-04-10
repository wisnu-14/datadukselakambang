<?php
// send_otp.php
session_start();
require '../../../app/config/mail/Mailer.php';


if (!isset($_SESSION['pending_user'])) {
    header("Location: ../login.php");
    exit;
}

$kodeOTP = rand(100000, 999999);
$_SESSION['otp'] = $kodeOTP;
$_SESSION['otp_expiry'] = time() + 300; // 5 menit

$email = $_SESSION['pending_user']['email'];

kirimOTP($email, $kodeOTP);
sleep(2);

// Redirect ke halaman form OTP
header("refresh:2; url=../form_otp.php");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Mengirim OTP...</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: sans-serif;
            background-color: #f8f9fa;
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3 fs-5">Mengirim kode OTP ke email kamu...<br><small>Mohon tunggu sebentar.</small></p>
    </div>
</body>

</html>