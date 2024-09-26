<?php
session_start();
require_once '../connect/config.php';

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit;
}

$total = 0;
foreach ($_SESSION['panier'] as $produit) {
    $total += $produit['prix'] * $produit['quantite'];
}

$_SESSION['total'] = $total;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cc_number = $_POST['cc-number'];
    $ex_month = $_POST['ex_month'];
    $ex_year = $_POST['ex_year'];
    $cvv = $_POST['cvv'];

    try {
        $client_id = $_SESSION['client_id']; 
        $panier = $_SESSION['panier'];

        if (empty($panier)) {
            throw new Exception("Votre panier est vide.");
        }

        $pdo->beginTransaction();  

        $stmt = $pdo->prepare('INSERT INTO commandes (client_id, date_commande, total) VALUES (?, NOW(), ?)');
        $stmt->execute([$client_id, $total]);
        $commande_id = $pdo->lastInsertId();  

        foreach ($panier as $id_produit => $produit) {
            $stmt = $pdo->prepare('INSERT INTO commandes_produits (commande_id, produit_id, quantite, prix) VALUES (?, ?, ?, ?)');
            $stmt->execute([$commande_id, $id_produit, $produit['quantite'], $produit['prix']]);

            $stmt = $pdo->prepare('UPDATE produits SET stock = stock - ? WHERE id = ?');
            $stmt->execute([$produit['quantite'], $id_produit]);
        }

        $pdo->commit();

        unset($_SESSION['panier']);
        $_SESSION['commande_success'] = true;

        header('Location: confirmation.php');
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erreur lors de la commande : " . $e->getMessage();
        exit;
    }
}
?>

<?php include ('header.php'); ?>

<div class="commande-container">
    <h1>Passer Commande</h1>
    <p>Montant total à payer : <strong><?= number_format($total, 2) ?> €</strong></p>

    <form method="POST" action="passer_commande.php" class="commande-form">

        <div class="input-group">
            <label for="cc-number">Numéro de carte bancaire :</label>
            <input type="text" name="cc-number" id="cc-number" maxlength="16" placeholder="1111 2222 3333 4444" required>
        </div>

        <div class="input-group expiry-group">
            <label for="expiry-month">Date d'expiration :</label>
            <div class="expiry-select">
                <select name="ex_month" id="expiry-month" required>
                    <option value="" selected>Mois</option>
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                    <?php endfor; ?>
                </select>
                <select name="ex_year" id="expiry-year" required>
                    <option value="" selected>Année</option>
                    <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label for="cvv">Code de sécurité (CVV) :</label>
            <input type="password" name="cvv" id="cvv" maxlength="3" placeholder="123" required>
        </div>

        <button type="submit" class="btn-commande">Confirmer le paiement</button>
    </form>
</div>

<?php include 'footer.php'; ?>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding-top: 70px;
}

.commande-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

p {
    font-size: 18px;
    text-align: center;
}

.commande-form {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
    color: #333;
}

.input-group input,
select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
}

.input-group input:focus,
select:focus {
    border-color: #007bff;
    outline: none;
}

.expiry-group {
    display: flex;
    justify-content: space-between;
}

.expiry-select select {
    width: 48%;
}

.btn-commande {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #e8491d;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-commande:hover {
    background-color: #ff9800;
}

</style>
</body>
</html>
