<!-- otp_form.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <!-- otp_form.php -->
    <form action="otp/otp_verifikasi.php" method="POST" class="border p-4 rounded shadow bg-white" style="width: 300px;">
        <?php if (isset($_GET['resend'])): ?>
            <div id="resend-alert" class="alert alert-success text-center py-2">
                OTP berhasil dikirim ulang.
            </div>

            <script>
                // Hilangkan alert setelah 5 detik (5000 ms)
                setTimeout(function() {
                    const alertBox = document.getElementById('resend-alert');
                    if (alertBox) {
                        alertBox.style.transition = 'opacity 0.5s ease';
                        alertBox.style.opacity = '0';
                        setTimeout(() => alertBox.remove(), 500); // Hapus dari DOM setelah fade out
                    }
                }, 5000);
            </script>
        <?php endif; ?>

        <h5 class="mb-3 text-center">Verifikasi OTP</h5>
        <div class="mb-3">
            <label>Kode OTP</label>
            <input type="text" name="otp" class="form-control" required autofocus>
        </div>
        <button class="btn btn-primary w-100">Verifikasi</button>

        <div class="text-center mt-3">
            <a href="../../views/auth/otp/resend_otp.php" class="btn btn-link text-decoration-none">Kirim ulang OTP</a>
        </div>
    </form>

</body>

</html>