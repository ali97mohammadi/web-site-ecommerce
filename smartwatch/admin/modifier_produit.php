<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock']; 
    $stmt = $pdo->prepare('UPDATE produits SET nom = ?, description = ?, prix = ?, stock = ? WHERE id = ?');
    $stmt->execute([$nom, $description, $prix, $stock, $id]);

    header('Location: produits.php');
}

$produit = $pdo->prepare('SELECT * FROM produits WHERE id = ?');
$produit->execute([$id]);
$produit = $produit->fetch(PDO::FETCH_ASSOC);
?>

<?php
include ('header.php');
?>
    <h1>Modifier le produit</h1>
    <form action="modifier_produit.php?id=<?= $id ?>" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $produit['nom'] ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= $produit['description'] ?></textarea>

        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" value="<?= $produit['prix'] ?>" required>

        <label for="stock">Stock :</label> 
        <input type="number" id="stock" name="stock" value="<?= $produit['stock'] ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
