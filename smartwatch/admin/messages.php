<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../connect/config.php';


$messages = $pdo->query('
    SELECT messages.*, clients.nom AS client_nom, clients.prenom AS client_prenom 
    FROM messages 
    JOIN clients ON messages.client_id = clients.id
')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php');
?>
<div  class="container"></div>

    <h1>Liste des Messages</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) : ?>
                <tr>
                    <td><?= $message['id'] ?></td>
                    <td><?= $message['client_nom'] . ' ' . $message['client_prenom'] ?></td>
                    <td><?= $message['message'] ?></td>
                    <td><?= $message['date_envoi'] ?></td>
                    <td>
                        <a href="supprimer_message.php?id=<?= $message['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<</div>
</body>
</html>
