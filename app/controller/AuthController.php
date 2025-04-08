<?php
session_start();
require '../../app/database/connection.php';
require '../../app/controller/LogsController.php';

// Fungsi untuk membuat CSRF token
// Fungsi untuk membuat CSRF token
if (!function_exists('generateCsrfToken')) {
    function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }
}

// Fungsi untuk validasi CSRF token
if (!function_exists('validateCsrfToken')) {
    function validateCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}


// Fungsi registrasi user
function registerUser($nik, $nama, $username, $password, $role)
{
    global $pdo;

    if (!preg_match('/^\d{16}$/', $nik)) {
        return "NIK harus 16 digit angka.";
    }

    if (strlen($password) < 8) {
        return "Password minimal 8 karakter.";
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (nik, nama, username, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nik, $nama, $username, $hashedPassword, $role]);
        logAktivitas('Menambahkan user');
        return true;
    } catch (PDOException $e) {
        return "Username atau NIK sudah terdaftar.";
    }
}

function editUser($request)
{
    global $pdo;

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $request = [
            'nik' => $request['nik'],
            'nama' => $request['nama'],
            'username' => $request['username'],
            'role' => $request['role'],
            'password' => $hashedPassword['password'],
            'id' => $request['id'],
        ];
        $query = "UPDATE users SET nik=?, nama=?, username=?, role=?, password=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array_values($request));
        logAktivitas('Edit user');
    } else {
        $request = [
            'nik' => $request['nik'],
            'nama' => $request['nama'],
            'username' => $request['username'],
            'role' => $request['role'],
            'id' => $request['id'],
        ];
        $query = "UPDATE users SET nik=?, nama=?, username=?, role=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array_values($request));
        logAktivitas('Edit user');
    }
}
// Fungsi login user
function loginUser($username, $password)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        // Cek apakah akun sudah login di perangkat lain
        if (!empty($user['session_token'])) {
            return "Akun sedang digunakan di perangkat lain.";
        }

        // Generate session token baru
        $token = bin2hex(random_bytes(32));

        // Simpan ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['session_token'] = $token;
        $_SESSION['last_activity'] = time(); // 🕒 waktu login

        // Simpan ke database
        $stmt = $pdo->prepare("UPDATE users SET session_token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);
        logAktivitas('Login ke sistem');
        return true;
    }

    return "Username atau password salah.";
}


// Fungsi logout user
function logoutUser()
{
    global $pdo;
    
    if (isset($_SESSION['user_id'])) {
     $userId = $_SESSION['user_id'];

     $stmt = $pdo->prepare("UPDATE users SET session_token = NULL WHERE id = ?");
     $stmt->execute([$userId]);
    }
    session_unset();
    session_destroy();
    logAktivitas('Logout dari sistem');
}


function deleteUser($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    logAktivitas('Menghapus user');
    return true;
}


