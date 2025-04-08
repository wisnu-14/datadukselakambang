<?php
require '../../app/database/connection.php';

function getKeluarga($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM data_keluarga WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getKondisiRumah($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kondisi_rumah WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getKamarMandi($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kamar_mandi WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getListrik($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM listrik WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getBarang($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getBuah($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM buah WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getTernak($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM ternak WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getUsaha($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM usaha WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getAir($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM sumber_air WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getPangan($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM pangan WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
function getObat($no_rumah)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM obat WHERE no_rumah=?");
    $stmt->execute([$no_rumah]);
    return $stmt->fetchAll();
}
