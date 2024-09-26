<?php
session_start();

$id_produit = $_POST['id_produit'];
$nouvelle_quantite = (int)$_POST['quantite'];

if (isset($_SESSION['panier'][$id_produit]) && $nouvelle_quantite > 0) {
    $_SESSION['panier'][$id_produit]['quantite'] = $nouvelle_quantite; 
}

header('Location: panier.php'); 
exit;
?>
<form action="modifier_quantite.php" method="post">
    <input type="hidden" name="id_produit" value="<?= $id ?>">
    <input type="number" name="quantite" value="<?= $produit['quantite'] ?>" min="1">
    <button type="submit">Modifier</button>
</form>
