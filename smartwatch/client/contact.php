<?php
session_start();


if (!isset($_SESSION['client_id'])) {
    header("Location: login.php"); 
    exit();
}


if (isset($_SESSION['client_nom']) && isset($_SESSION['client_prenom']) && isset($_SESSION['client_email'])) {
    $client_nom = $_SESSION['client_nom'];
    $client_prenom = $_SESSION['client_prenom'];
    $client_email = $_SESSION['client_email'];
} 


require_once '../connect/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $client_id = $_SESSION['client_id'];

  
    $stmt = $pdo->prepare("INSERT INTO messages (client_id, message, date_envoi) VALUES (?, ?, NOW())");
    $stmt->execute([$client_id, $message]);

    echo "Votre message a bien été envoyé.";
}
?>

<?php include 'header.php'; ?>
<section class="contact">
    <h1>Contactez-nous</h1>
    <div class="container">
    <form action="contact.php" method="POST">
    <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['client_nom']); ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_SESSION['client_prenom']); ?>" readonly>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['client_email']); ?>" required>
        <label for="message">Votre message :</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
    </div>
</section>
<?php
    include 'footer.php';
?>

</body>
</html>
