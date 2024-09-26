<?php
session_start();
require_once '../connect/config.php';

if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit;
}

$client_id = $_SESSION['client_id'];


$stmt = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
$stmt->execute([$client_id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare('UPDATE clients SET nom = ?, prenom = ?, email = ?, adresse = ?, tel = ?, sexe = ?, age = ? WHERE id = ?');
    $stmt->execute([$nom, $prenom, $email, $adresse, $tel, $sexe, $age, $client_id]);

    header('Location: profil.php');
    exit;
}
?>

<?php
    include ('header.php');
?>
    <div class="container">
        
        <form action="profil.php" method="POST">
            <h1>Modifier Profil</h1>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $client['nom'] ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $client['prenom'] ?>" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= $client['email'] ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?= $client['adresse'] ?>" required>

            <label for="tel">Téléphone :</label>
            <input type="text" id="tel" name="tel" value="<?= $client['tel'] ?>" required>

            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="H" <?= $client['sexe'] == 'H' ? 'selected' : '' ?>>Homme</option>
                <option value="F" <?= $client['sexe'] == 'F' ? 'selected' : '' ?>>Femme</option>
                <option value="Autre" <?= $client['sexe'] == 'Autre' ? 'selected' : '' ?>>Autre</option>
            </select>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" value="<?= $client['age'] ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
    <?php
        include 'footer.php';
    ?>
    
</body>
</html>
