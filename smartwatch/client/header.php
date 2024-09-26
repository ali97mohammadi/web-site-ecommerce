<?php

$nbProduitsPanier = 0;

if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $produit) {
        $nbProduitsPanier += $produit['quantite'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M&A Smartwatch</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="nav-bar">
        <div id="branding">
            <h1><a href="accueil.php">M&A Smartwatch</a></h1>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="produit.php">Produits</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li>
                    <a href="panier.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <?php if ($nbProduitsPanier > 0): ?>
                            <span class="panier-badge"><?= $nbProduitsPanier ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
            <div class="menu-toggle" id="mobile-menu">&#9776; 
            <?php if ($nbProduitsPanier > 0): ?>
                            <span class="panier-badge"><?= $nbProduitsPanier ?></span>
                        <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
<script>
const menuToggle = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');
menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('nav-active');
});
</script>
<style>
    .panier-badge {
    background-color: #ff0000;
    color: white;
    border-radius: 50%;
    padding: 5px ;
    font-size: 10px;
    position: relative;
    top: -10px;
    left: -10px;
}

</style>
</body>
</html>
