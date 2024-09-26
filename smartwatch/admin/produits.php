<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';

$produits = $pdo->query('SELECT * FROM produits')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php');
?>
<div id="toast-container"></div>
    <h1>Liste des Produits</h1>
    <a href="ajouter_produit.php" class="btn">Ajouter un produit</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th> 
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit) : ?>
                <tr>
                    <td><?= $produit['id'] ?></td>
                    <td><?= $produit['nom'] ?></td>
                    <td><?= $produit['description'] ?></td>
                    <td><?= $produit['prix'] ?></td>
                    <td><?= $produit['stock'] ?></td> 
                    <td><img src="../images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>" width="100"></td>
                    <td>
                        <a href="modifier_produit.php?id=<?= $produit['id'] ?>" class="btn">Modifier</a>
                        <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" class="delete-btn">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>function showToast(message) {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;

    toastContainer.appendChild(toast);

    setTimeout(function() {
        toast.remove();
    }, 3000);  
}


if (window.location.href.includes('produit-ajoute')) {
    showToast('Produit ajouté avec succès.');
}
</script>
</body>
</html>
