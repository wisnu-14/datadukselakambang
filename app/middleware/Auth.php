<?php
function authMiddleware()
{
    global $pdo;

    if (!isset($_SESSION['user_id'], $_SESSION['session_token'])) {
        header("Location: ../../views/auth/login.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT session_token FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    $timeout = 600; // 10 menit = 600 detik
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        logoutUser();
        header('Location: ../../views/auth/login.php?message=session_timeout');
        exit;
    }

    $_SESSION['last_activity'] = time();
    // Jika token tidak cocok, berarti akun dipakai di tempat lain
    if (!$user || $user['session_token'] !== $_SESSION['session_token']) {
        logoutUser();
        echo "<script>alert('Akun ini sedang digunakan di perangkat lain.'); window.location.href = '../../views/auth/login.php';</script>";
        exit;
    }
}


/**
 * Middleware untuk halaman yang membutuhkan login.
 * Jika tidak ada sesi pengguna, redirect ke halaman login.
 */
// function authMiddleware() {
//     if (!isset($_SESSION['user_id'])) {
//         header("Location: ../../views/auth/login.php");
//         exit();
//     }
// }

/**
 * Middleware untuk halaman khusus admin.
 * Jika bukan admin, redirect ke halaman lain.
 */
function adminMiddleware()
{
    authMiddleware(); // Pastikan pengguna sudah login

    if ($_SESSION['role'] == 'pengisi' ) {
        echo "<script>alert('Anda tidak memiliki hak untuk mengakses halaman ini!');window.location.href='../../views/rekap/rekap.php';</script>";
        exit();
    }
}
