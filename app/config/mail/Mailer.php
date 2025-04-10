<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';

function kirimOTP($emailTujuan, $kodeOTP)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'wisnudwippp12@gmail.com'; // Ganti
        $mail->Password   = 'hjri rgll oplu pmqw';   // Ganti
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('wisnudwippp12@gmail.com', 'Website sensus');
        $mail->addAddress($emailTujuan);
        $mail->Subject = 'Verifikasi Kode OTP Login Anda';

        $mail->isHTML(true); // Aktifkan mode HTML
        $mail->Subject = 'Kode OTP Anda - Sensus Data';
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <style>
            body {
              font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
              background-color: #f4f4f4;
              padding: 20px;
              color: #333;
            }
            .container {
              background-color: #ffffff;
              border-radius: 8px;
              padding: 30px;
              max-width: 600px;
              margin: auto;
              box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .otp {
              font-size: 24px;
              font-weight: bold;
              color: #1a73e8;
              margin: 20px 0;
            }
            .footer {
              font-size: 12px;
              color: #777;
              margin-top: 30px;
            }
          </style>
        </head>
        <body>
            <div class="container">
            <p>Yth. Pengguna,</p>
        
            <p>Terima kasih telah menggunakan layanan kami.</p>
        
            <p>Kode OTP Anda untuk masuk ke akun adalah:</p>
        
            <p class="otp">🔐 ' . $kodeOTP . '</p>
        
            <p>Kode ini berlaku selama <strong>5 menit</strong>. Jangan bagikan kode ini kepada siapa pun, termasuk pihak yang mengatasnamakan kami.</p>
        
            <p>Jika Anda tidak meminta kode ini, silakan abaikan email ini.</p>
        
            <p>Hormat kami,<br><strong>Tim Keamanan Sensus Data</strong></p>
        
            <div class="footer">
              Email ini dikirim secara otomatis. Mohon untuk tidak membalas.
            </div>
          </div>
        </body>
        </html>
        ';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
