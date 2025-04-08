<?php
require '../../app/database/connection.php';
function jumlahBlt()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_blt FROM data_keluarga WHERE blt IS NOT NULL AND blt != ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function jumlahRtlh()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_rtlh FROM data_keluarga WHERE rtlh IS NOT NULL AND rtlh != ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function jumlahSembako()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_sembako FROM data_keluarga WHERE sembako = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function jumlahPkh()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_pkh FROM data_keluarga WHERE pkh = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function jumlahLainnya()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_lainnya FROM data_keluarga WHERE lainnya IS NOT NULL AND lainnya != ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function jumlahRumah()
{
    global $pdo;
    $sql = "SELECT COUNT(*) as total_rumah FROM data_keluarga WHERE no_rumah IS NOT NULL AND no_rumah != ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function logUserVisit()
{
    global $pdo;
    $ip_address = $_SERVER['REMOTE_ADDR']; 
    $device_info = $_SERVER['HTTP_USER_AGENT']; 
    $visit_time = date('Y-m-d H:i:s'); 

    // Perbaikan query
    $sql = "INSERT INTO visitors ( ip_address, device_info, visit_time) 
            VALUES ( :ip_address, :device_info, :visit_time) 
            ON DUPLICATE KEY UPDATE visit_time = VALUES(visit_time)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ip_address' => $ip_address,
        ':device_info' => $device_info,
        ':visit_time' => $visit_time
    ]);
}
