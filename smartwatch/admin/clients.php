<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';

// Récupérer tous les clients
$clients = $pdo->query('SELECT * FROM clients')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php');
?>

    <h1>Liste des Clients</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Âge</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= $client['id'] ?></td>
                    <td><?= $client['nom'] ?></td>
                    <td><?= $client['prenom'] ?></td>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['age'] ?></td>
                    <td><?= $client['sexe'] ?></td>
                    <td><?= $client['tel'] ?></td>
                    <td><?= $client['adresse'] ?></td>
                    <td>
                        <a href="modifier_client.php?id=<?= $client['id'] ?>">Modifier</a>
                        <a href="supprimer_client.php?id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
