<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM clients WHERE id = ?');
$stmt->execute([$id]);

header('Location: clients.php');
?>
