<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="../css/style.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="nav-bar">
            <div id="branding">
                <h1>M&A Smartwatch</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    
                    <li><a href="produits.php">Produits</a></li>
                    <li><a href="clients.php">Clients</a></li>
                    <li><a href="commandes.php">Commandes</a></li>
                    <li><a href="messages.php"><i class="fa-solid fa-message"></i></a></li>
                    <li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>             
                    <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a></li>
                </ul>
                <div class="menu-toggle" id="mobile-menu">&#9776;</div>
            </nav>
        </div>
    </header>
    <script >  
        const menuToggle = document.getElementById('mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('nav-active');
        });
    </script>