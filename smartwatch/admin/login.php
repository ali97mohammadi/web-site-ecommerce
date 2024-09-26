<?php
session_start();
require_once '../connect/config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: produits.php');
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
?>
<?php
include ('header.php');
?>
    <form action="login.php" method="POST">
        <h2>Admin Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login">Se connecter</button>
        <p>Pas encore inscrit ? <a href="inscription.php">S'inscrire</a></p>
    </form>
</body>
</html>
