<?php
session_start();
$panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
$total_general = 0;
if (isset($_POST['produit_id']) && isset($_POST['quantite'])) {
    $id = $_POST['produit_id'];
    $nouvelle_quantite = (int)$_POST['quantite'];

    if ($nouvelle_quantite > 0 && isset($panier[$id])) {
        
        $_SESSION['panier'][$id]['quantite'] = $nouvelle_quantite;

    
        $total_produit = $_SESSION['panier'][$id]['prix'] * $nouvelle_quantite;

        
        $total_general = 0;
        foreach ($_SESSION['panier'] as $produit) {
            $total_general += $produit['prix'] * $produit['quantite'];
        }


        echo json_encode([
            'total_produit' => $total_produit,
            'total_general' => $total_general
        ]);
        exit; 
    }
}
?>
<style>
  
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

h1 {
    text-align: center;
    margin-top: 20px;
    color: #333;
}


.cart-container {
    max-width: 1200px;
    margin: 80px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}


.empty-cart {
    text-align: center;
    font-size: 1.2rem;
    color: #666;
}


.cart-items {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    justify-content: center;
}

.cart-item {
    display: flex;
    align-items: center;
    background-color: #fafafa;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    justify-content: center;
}

.cart-item img {
    width: 100px;
    height: auto;
    border-radius: 5px;
    margin-right: 20px;
}

.cart-item-details {
    flex: 1;
}

.cart-item-details h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.cart-item-details p {
    margin: 5px 0;
    color: #555;
}


.remove-btn {
    background-color: #e8491d;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.remove-btn:hover {
    background-color: #c0392b;
}


.cart-summary {
    text-align: center;
    margin-top: 20px;
}

.cart-summary h3 {
    font-size: 1.8rem;
    color: #333;
}

.checkout-btn {
    display: inline-block;
    background-color: #e8491d;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2rem;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.checkout-btn:hover {
    background-color: #e8491d;
}

@media (max-width: 768px) {
    .cart-items {
        grid-template-columns: 1fr;
    }

    .cart-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .cart-item-img {
        width: 100%;
        margin-bottom: 15px;
    }
}



input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-left: 10px;
}


</style>

<?php include('header.php'); ?>

<div class="cart-container">
    <h1>Votre Panier</h1>

    <?php if (empty($panier)) : ?>
        <p class="empty-cart">Votre panier est vide.</p>
    <?php else : ?>
        <div class="cart-items">
            <?php foreach ($panier as $id => $produit) : 
                $total_produit = $produit['prix'] * $produit['quantite'];
                $total_general += $total_produit;
            ?>
            <div class="cart-item" data-id="<?= $id ?>">
                <img src="../images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>" class="cart-item-img">
                <div class="cart-item-details">
                    <h2><?= $produit['nom'] ?></h2>
                    <p>Prix: <?= $produit['prix'] ?> €</p>

                   
                    <label for="quantite_<?= $id ?>">Quantité :</label>
                    <input type="number" id="quantite_<?= $id ?>" name="quantite" class="quantite" value="<?= $produit['quantite'] ?>" min="1">
                    
                    <p>Total: <span class="total-produit"><?= $total_produit ?></span> €</p>
                </div>
                <a href="supprimer_du_panier.php?id=<?= $id ?>" class="remove-btn">Supprimer</a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h3>Total Général: <span id="total-general"><?= $total_general ?></span> €</h3>
            <a href="passer_commande.php" class="checkout-btn">Passer commande</a>
        </div>
    <?php endif; ?>
</div>

<script>
document.querySelectorAll('.quantite').forEach(function(input) {
    input.addEventListener('change', function() {
        const produitId = this.closest('.cart-item').getAttribute('data-id');
        const nouvelleQuantite = this.value;

        fetch('panier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `produit_id=${produitId}&quantite=${nouvelleQuantite}`
        })
        .then(response => response.json())
        .then(data => {
            const cartItem = document.querySelector(`.cart-item[data-id='${produitId}']`);
            cartItem.querySelector('.total-produit').textContent = data.total_produit;
            document.getElementById('total-general').textContent = data.total_general;
        });
    });
});
</script>
<?php include('footer.php'); ?>
</body>
</html>
