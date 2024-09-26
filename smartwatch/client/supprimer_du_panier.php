<?php
session_start();

$id_produit = $_GET['id'];

if (isset($_SESSION['panier'][$id_produit])) {
    unset($_SESSION['panier'][$id_produit]); 
}

header('Location: panier.php'); 
exit;
?>
