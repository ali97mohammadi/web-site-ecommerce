<?php
session_start();
require_once '../connect/config.php';

if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit;
}

$client_id = $_SESSION['client_id'];

$stmt = $pdo->prepare('SELECT * FROM commandes WHERE client_id = ? ORDER BY date_commande DESC');
$stmt->execute([$client_id]);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f9;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-title {
    text-align: center;
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #000000;
}

.empty-commandes {
    text-align: center;
    font-size: 1.2em;
    color: #888;
    margin-top: 50px;
}

.commande-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 20px;
    transition: box-shadow 0.3s ease;
}

.commande-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.commande-card h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #000000;
}

.commande-card .date {
    color: #888;
    font-size: 0.9em;
}

.commande-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.commande-table thead {
    background-color: #f4f7f9;
    text-align: left;
}

.commande-table th,
.commande-table td {
    padding: 12px;
    border-bottom: 1px solid #e0e0e0;
}

.commande-table th {
    color: #ffffff;
}

.commande-table td {
    font-size: 1em;
}

.commande-table td:last-child {
    font-weight: bold;
}

@media (max-width: 768px) {
    .commande-table, .commande-table thead, .commande-table tbody, .commande-table th, .commande-table td, .commande-table tr {
        display: block;
        width: 100%;
    }

    .commande-table td {
        padding: 10px;
        text-align: right;
    }

    .commande-table td:before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
    }

    .commande-table thead {
        display: none;
    }
}
.produit-image {
    width: 80px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


</style>
<?php include ('header.php'); ?>

<div class="container">
    <h1 class="page-title">Historique des commandes</h1>

    <?php if (empty($commandes)) : ?>
        <p class="empty-commandes">Vous n'avez pas encore passé de commande.</p>
    <?php else : ?>
        <?php foreach ($commandes as $commande) : ?>
            <div class="commande-card">
                <h2>Commande #<?= $commande['id'] ?> - <span class="date"><?= date('d/m/Y', strtotime($commande['date_commande'])) ?></span></h2>
                
                <table class="commande-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $stmt = $pdo->prepare('SELECT p.nom, p.image, cp.quantite, cp.prix FROM commandes_produits cp JOIN produits p ON cp.produit_id = p.id WHERE cp.commande_id = ?');
                        $stmt->execute([$commande['id']]);
                        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($produits as $produit) : ?>
                            <tr>
                                <td><img src="../images/<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="produit-image"></td>
                                <td><?= $produit['nom']?></td>
                                <td><?= $produit['quantite'] ?></td>
                                <td><?= $produit['prix'] ?> €</td>
                                <td><?= $produit['quantite'] * $produit['prix'] ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
