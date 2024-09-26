<?php
session_start();
require_once '../connect/config.php';

$produits = $pdo->query('SELECT * FROM produits WHERE stock > 0')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include 'header.php';
?>

    <div class="client-container">
        <h1>Produits</h1>
        <div class="produits-client">
            <div class="produits">
                <?php foreach ($produits as $produit) : ?>
                    <div class="produit">
                        <img src="../images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>">
                        <h2><?= $produit['nom'] ?></h2>
                        <p><?= $produit['description'] ?></p>
                        <p>Prix : <?= $produit['prix'] ?> €</p>
                        <p>Stock : <?= $produit['stock'] ?></p>
                        <a href="ajouter_panier.php?id=<?= $produit['id'] ?>" class="btn">Ajouter au panier</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body> 
</html>
