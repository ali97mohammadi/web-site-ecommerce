<?php
require_once ('../connect/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  

   
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = ?');
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        $error = "Cet email est déjà utilisé.";
    } else {
 
        $stmt = $pdo->prepare('INSERT INTO admins (nom, prenom, email, password) VALUES (?, ?, ?, ?)');
        if ($stmt->execute([$nom, $prenom, $email, $password])) {
            $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            $error = "Erreur lors de l'inscription.";
        }
    }
}
?>

<?php
    include ('header.php');
?>


    <form action="inscription.php" method="POST">
        <h1>Inscription Admin</h1>

        <?php if (isset($success)) : ?>
            <p class="alert success"><?= $success ?></p>
        <?php elseif (isset($error)) : ?>
            <p class="alert error"><?= $error ?></p>
        <?php endif; ?>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
