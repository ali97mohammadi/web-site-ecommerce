<?php
session_start();

if (!isset($_SESSION['commande_success'])) {
    header('Location: produit.php');
    exit;
}

unset($_SESSION['commande_success']); 

?>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.confirmation-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    margin-bottom: 30px;
}

.btn-retour {
    display: inline-block;
    padding: 12px 25px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-retour:hover {
    background-color: #0056b3;
    text-decoration: none;
}


</style>

<?php
include('header.php');
?>

<body>
    <div class="confirmation-container">
        <h1>Merci pour votre commande !</h1>
        <p>Votre commande a été passée avec succès. </p>
        <a href="produit.php" class="btn">Retour à la boutique</a>
    </div>

    <?php
        include 'footer.php';
    ?>
    
</body>
</html>
