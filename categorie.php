<?php
session_start();
require_once 'db/connexion.php';

$type = isset($_GET['type']) ? trim($_GET['type']) : '';

if ($type === '') {
    echo "<p style='text-align:center;color:red;'>❌ Aucune catégorie sélectionnée.</p>";
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM produits WHERE categorie = ?");
$stmt->execute([$type]);
$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($type) ?> - Mic Mac</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
      padding: 40px 20px;
    }

    h2 {
      text-align: center;
      color: #007BBD;
      margin-bottom: 30px;
    }

    .grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 250px;
      text-align: center;
      padding: 20px;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card img {
      max-width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .card h4 {
      color: #1f2a37;
      margin: 10px 0;
    }

    .card p {
      color: #666;
      font-size: 14px;
      min-height: 50px;
    }

    .price {
      font-weight: bold;
      color: #007BBD;
      margin: 10px 0;
    }

    .btn-add {
      background-color: #007BBD;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s;
    }

    .btn-add:hover {
      background-color: #005f8a;
    }

    .vide {
      text-align: center;
      font-size: 18px;
      color: gray;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

<h2>Catégorie : <?= htmlspecialchars($type) ?></h2>

<div class="grid">
  <?php if (!empty($produits)): ?>
    <?php foreach ($produits as $produit): ?>
      <div class="card">
        <?php if (!empty($produit['image'])): ?>
          <img src="images/uploads/<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
        <?php else: ?>
          <img src="images/placeholder.jpg" alt="Aucune image">
        <?php endif; ?>

        <h4><?= htmlspecialchars($produit['nom']) ?></h4>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <div class="price"><?= $produit['prix'] ?> DH</div>

        <button class="btn-add" onclick="ajouterAuPanier(<?= $produit['id'] ?>)">
          🛒 Ajouter au panier
        </button>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="vide">Aucun produit trouvé dans cette catégorie.</p>
  <?php endif; ?>
</div>

<script>
function ajouterAuPanier(id) {
  fetch("ajouter_panier.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: id })
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'ok') {
      alert("Produit ajouté au panier !");
    } else {
      alert("Erreur : " + data.message);
    }
  })
  .catch(() => alert("Erreur serveur"));
}
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
