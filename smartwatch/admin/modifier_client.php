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
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];

    $stmt = $pdo->prepare('UPDATE clients SET nom = ?, prenom = ?, email = ?, age = ?, sexe = ?, tel = ?, adresse = ? WHERE id = ?');
    $stmt->execute([$nom, $prenom, $email, $age, $sexe, $tel, $adresse, $id]);
    
    header('Location: clients.php');
}

$client = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
$client->execute([$id]);
$client = $client->fetch(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php');
?>

    <h1>Modifier le Client</h1>
    <form action="modifier_client.php?id=<?= $id ?>" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $client['nom'] ?>" required>
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $client['prenom'] ?>" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= $client['email'] ?>" required>
        
        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" value="<?= $client['age'] ?>" required>
        
        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
            <option value="Homme" <?= $client['sexe'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
            <option value="Femme" <?= $client['sexe'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
        </select>
        
        <label for="tel">Téléphone :</label>
        <input type="text" id="tel" name="tel" value="<?= $client['tel'] ?>" required>
        
        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse" required><?= $client['adresse'] ?></textarea>
        
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
