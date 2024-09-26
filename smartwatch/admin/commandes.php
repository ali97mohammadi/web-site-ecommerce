<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';


$commandes = $pdo->query('
    SELECT commandes.id, commandes.date_commande, clients.nom AS client_nom, clients.prenom AS client_prenom, 
           produits.nom AS produit_nom, commandes_produits.quantite 
    FROM commandes 
    JOIN clients ON commandes.client_id = clients.id 
    JOIN commandes_produits ON commandes.id = commandes_produits.commande_id 
    JOIN produits ON commandes_produits.produit_id = produits.id
')->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
include ('header.php');
?>
    <h1>Liste des Commandes</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Date de commande</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande) : ?>
                <tr>
                    <td><?= $commande['id'] ?></td>
                    <td><?= $commande['client_nom'] . ' ' . $commande['client_prenom'] ?></td>
                    <td><?= $commande['produit_nom'] ?></td>
                    <td><?= $commande['quantite'] ?></td>
                    <td><?= $commande['date_commande'] ?></td>
                    <td>
                        <a href="supprimer_commande.php?id=<?= $commande['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
