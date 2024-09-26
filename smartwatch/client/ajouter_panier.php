<?php
session_start();
require_once '../connect/config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM produits WHERE id = ?');
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: produit.php');
    exit;
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Vérifier si le produit est déjà dans le panier
if (isset($_SESSION['panier'][$id])) {
    $_SESSION['panier'][$id]['quantite']++;
    
} else {
    
    $_SESSION['panier'][$id] = [
        'image' =>$produit['image'],
        'nom' => $produit['nom'],
        'prix' => $produit['prix'],
        'quantite' => 1,
    ];
}


header('Location: produit.php');
exit;
?>
