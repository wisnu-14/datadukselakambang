<?php

/**
 * Middleware untuk halaman yang hanya boleh diakses oleh tamu (belum login).
 * Jika pengguna sudah login, redirect ke dashboard.
 */
function guestMiddleware() {
    if (isset($_SESSION['user_id'])) {
        header("Location: ../../views/layout/app.php?pages=rekap");
        exit();
    }
}
?>
