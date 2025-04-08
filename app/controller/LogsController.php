<?php
function logAktivitas($action)
{
    global $pdo;
    if (!isset($_SESSION['user_id'])) return;

    $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, username, action) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_SESSION['username'], $action]);
}
