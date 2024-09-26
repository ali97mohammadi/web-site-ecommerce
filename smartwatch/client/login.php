<?php 
session_start();
require_once '../connect/config.php';

$errors = []; 

if (isset($_SESSION['client_id'])) {
    header('Location: accueil.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        $errors[] = "Adresse email invalide.";
    }

    $password = $_POST['password'];

   

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
        $stmt->execute([$email]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client && password_verify($password, $client['password'])) {
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_nom'] = $client['nom']; 
            $_SESSION['client_prenom'] = $client['prenom'];
            $_SESSION['client_email'] = $client['email'];

            header('Location: accueil.php');
            exit;
        } else {
            $errors[] = 'Email ou mot de passe incorrect';
        }
    }
}
?>

<?php include ('header.php'); ?>
 
        <form action="login.php" method="POST">
            <h1>Connexion</h1>

        
            <?php if (!empty($errors)): ?>
                <div style="color:red;">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
            
            <p>Pas encore inscrit ? <a href="inscription.php">S'inscrire</a></p>
        </form>
    
<?php
        include 'footer.php';
    ?>
</body>
</html>
