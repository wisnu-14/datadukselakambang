<?php
require 'connection.php';
try {

    // Data yang akan ditambahkan
    $data_users = [
        [
            'nik' => '123456789',
            'nama' => 'Widhiono',
            'email' => 'widhionokasmad@gmail.com',
            'username' => 'widiono',
            'password' => password_hash('widhi14_16', PASSWORD_BCRYPT), // Password terenkripsi
            'role' => 'SuperAdmin'
        ],
        [
            'nik' => '987654321',
            'nama' => 'wisnu',
            'email' => 'wisnudwippp12@gmail.com',
            'username' => 'wisnu',
            'password' => password_hash('wisnudwi14', PASSWORD_BCRYPT), // Password terenkripsi
            'role' => 'SuperAdmin'
        ]
    ];

    $query = "INSERT INTO users (nik, nama,email, username, password, role) VALUES (:nik, :nama,:email,:username, :password, :role)";
    $stmt = $pdo->prepare($query);

    foreach ($data_users as $user) {
        $stmt->execute([
            ':nik' => $user['nik'],
            ':nama' => $user['nama'],
            ':email' => $user['email'],
            ':username' => $user['username'],
            ':password' => $user['password'],
            ':role' => $user['role']
        ]);
    }

    echo "Data berhasil ditambahkan!";
} catch (PDOException $e) {
    die("Koneksi atau query gagal: " . $e->getMessage());
}
?>
