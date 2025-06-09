<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?msg=connect_required");
    exit();
}

$articles = [];
$total = 0;
$articles_array = [];

if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $articles = $stmt->fetchAll();

    foreach ($articles as $article) {
        $id = $article['id'];
        $qte = $_SESSION['panier'][$id];
        $articles_array[] = [
            'nom' => $article['nom'],
            'prix' => $article['prix'],
            'quantite' => $qte,
            'image' => $article['image'] ?? ''
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Votre Panier</title>
  <style>
    body { font-family: 'Poppins', sans-serif; padding: 40px; background-color: #f4f6f8; }
    h2 { color: #007BBD; text-align: center; margin-bottom: 20px; }
    table { width: 90%; margin: auto; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: center; }
    th { background-color: #007BBD; color: white; }
    .btn { background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>
<h2>🛒 Votre Panier</h2>

<?php if (!empty($articles)) : ?>
  <table>
    <tr>
      <th>Produit</th><th>Prix</th><th>Quantité</th><th>Sous-total</th>
    </tr>
    <?php foreach ($articles as $article): 
      $id = $article['id'];
      $quantite = $_SESSION['panier'][$id];
      $sous_total = $article['prix'] * $quantite;
      $total += $sous_total;
    ?>
    <tr>
      <td><?= htmlspecialchars($article['nom']) ?></td>
      <td><?= number_format($article['prix'], 2) ?> DH</td>
      <td><?= $quantite ?></td>
      <td><?= number_format($sous_total, 2) ?> DH</td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="3"><strong>Total</strong></td>
      <td><strong><?= number_format($total, 2) ?> DH</strong></td>
    </tr>
  </table>

  <div style="text-align: center;">
    <button type="button" class="btn">✅ Confirmer la commande</button>
  </div>

  <script>
    const data = <?= json_encode($articles_array ?? []); ?>;

    document.querySelector('.btn').addEventListener('click', function () {
      if (!Array.isArray(data) || data.length === 0) {
        alert("Le panier est vide !");
        return;
      }

      fetch('enregistrer_commande.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(res => {
        if (res.status === 'ok') {
          alert("Commande enregistrée !");
          window.open(res.pdf, '_blank'); // ouvre le PDF
          window.location.href = "merci.php"; // redirection vers page de remerciement
        } else {
          alert("Erreur : " + res.message);
        }
      })
      .catch(err => alert("Erreur réseau : " + err));
    });
  </script>
<?php else: ?>
  <p style="text-align:center;">Votre panier est vide.</p>
<?php endif; ?>
</body>
</html>
