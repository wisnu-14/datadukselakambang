<?php
session_start();
require '../../app/database/connection.php';
require '../../app/controller/LogsController.php';

function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
function validateCsrfToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
function registerUser($nik, $nama, $email, $username, $password, $role)
{
    global $pdo;

    $nik = trim($nik);
    $nama = htmlspecialchars(trim($nama));
    $email = htmlspecialchars(trim($email));
    $username = trim($username);
    $role = strtolower(trim($role));

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $_SESSION['errors_message'] = "Password harus minimal 8 karakter, mengandung 1 huruf kapital, 1 angka, dan 1 karakter spesial.";
        return false;
    }

    $stmt = $pdo->prepare("SELECT nik, username, email FROM users WHERE nik = ? OR username = ? OR email = ?");
    $stmt->execute([$nik, $username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        if ($user['nik'] == $nik) {
            $_SESSION['errors_message'] = "NIK sudah terdaftar.";
            return false;
        } elseif ($user['username'] == $username) {
            $_SESSION['errors_message'] = "Username sudah terdaftar.";
            return false;
        } elseif ($user['email'] == $email) {
            $_SESSION['errors_message'] = "Email sudah terpakai.";
            return false;
        }
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (nik,nama,email,username, password, role) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->execute([$nik, $nama, $email, $username, $hashedPassword, $role]);

        logAktivitas("Menambahkan user baru: $username ($role)");
        return true;
    } catch (PDOException $e) {
        error_log("Register Error: " . $e->getMessage());
        return "Terjadi kesalahan saat registrasi.";
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
function loginUser($username, $password)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['pending_user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        $_SESSION['session_token'] = $token;
        $_SESSION['last_activity'] = time(); // 🕒 waktu login

        // Simpan ke database
        $stmt = $pdo->prepare("UPDATE users SET session_token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);
        header("Location: ../../views/auth/otp/send_otp.php");
        exit;
    } else {
        return "Username atau password salah.";
    }
}
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
