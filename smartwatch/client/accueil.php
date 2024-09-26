<?php
session_start();

 

?>

<?php
include('header.php');
?>

<section class="intro">
    <div class="container">
        <div class="intro-image">
            <img src="../images/slider-img.png" alt="Smartwatch Image">
        </div>
        <div class="intro-content">
            <h2>Explorez nos meilleures Smartwatchs</h2>
            <p>Découvrez une large gamme de montres intelligentes avec des fonctionnalités avancées et un design moderne.</p>
            <button onclick="location.href='produit.php'">Voir Plus</button> <!-- Redirect to product page -->
        </div>
    </div>
</section>



<section class="client-container">
    <h1>Nos Smartwatchs Populaires</h1>
    <div class="produits">
        
        <div class="produit">
            <img src="../images/w3.png" alt="Smartwatch 1">
            <h3>Smartwatch 1</h3>
            <p>Prix : 199,99 €</p>
            <a href="produit.php?" class="btn">acheter maintenant</a>        </div>
        <div class="produit">
            <img src="../images/w1.png" alt="Smartwatch 2">
            <h3>Smartwatch 2</h3>
            <p>Prix : 249,99 €</p>
            <a href="produit.php?" class="btn">acheter maintenant</a>
        </div>
    </div>
</section>
<section class="about">
    <div class="container">
        <div class="about-content">
            <h1>À propos de notre boutique</h1>
            <p>Nous sommes passionnés par les montres intelligentes et nous nous engageons à vous fournir les meilleures options pour améliorer votre quotidien avec style et technologie.</p>
        </div>
        <div class="about-image">
            <img src="../images/about-img.png" alt="À propos de nous">
        </div>
    </div>
</section>


<section class="contact">
    <h1>Contactez-nous</h1>
    <div class="container">
        
       
        <p>Pour toute question, n'hésitez pas à nous contacter via le formulaire ci-dessous.</p>
        <?php if (isset($_SESSION['client_id'])): ?>   
    <form action="contact.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['client_nom']); ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_SESSION['client_prenom']); ?>" readonly>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['client_email']); ?>" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <input type="submit" value="Envoyer">
    </form>
<?php else: ?>
    <p>Vous devez <a href="login.php">vous connecter</a> pour envoyer un message.</p>
<?php endif; ?>

    </div>
</section>
<?php
        include 'footer.php';
    ?>


</body>
</html>
