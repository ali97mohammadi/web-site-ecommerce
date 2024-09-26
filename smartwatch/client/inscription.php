<?php
require_once '../connect/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare('INSERT INTO clients (nom, prenom, email, password, adresse, tel, sexe, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nom, $prenom, $email, $password, $adresse, $tel, $sexe, $age]);

    header('Location: login.php');
    exit;
}
?>
<?php
    include ('header.php');
?>

<body>
    
    <form action="inscription.php" method="POST">
        <h1>Inscription</h1>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>

        <label for="tel">Téléphone :</label>
        <input type="text" id="tel" name="tel" required>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
            <option value="H">Homme</option>
            <option value="F">Femme</option>
            
        </select>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" required>

        <button type="submit">S'inscrire</button>
    </form>
    <?php
        include 'footer.php';
    ?>
</body>
</html>
