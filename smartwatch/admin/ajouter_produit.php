<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock']; 
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);

    $target_dir = "../images/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true); 
}

$target_file = $target_dir . basename($_FILES['image']['name']);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare('INSERT INTO produits (nom, description, prix, image, stock) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nom, $description, $prix, $image, $stock]);
        
        header('Location: produits.php');
    } else {
        $error = "Erreur lors de l'upload de l'image.";
    }


}
?>

<?php
include ('header.php');
?>
    <h1>Ajouter un produit</h1>
    <form action="ajouter_produit.php" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" required>

        <label for="stock">Stock :</label> 
        <input type="number" id="stock" name="stock" required>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
