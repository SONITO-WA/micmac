<?php
require_once 'db/connexion.php';
$produits = $pdo->query("SELECT id, nom, prix, garantie FROM produits ORDER BY prix ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Comparateur - MicMac</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #f0f0f0);
      padding: 40px;
      margin: 0;
    }
    h2 {
      text-align: center;
      color: #008fc9;
      margin-bottom: 20px;
    }
    #search-bar {
      display: block;
      margin: 0 auto 30px auto;
      padding: 12px;
      width: 320px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
    }
    .produit {
      background: white;
      border: 1px solid #ddd;
      padding: 15px;
      margin: 10px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
      width: 260px;
      transition: transform 0.2s ease;
    }
    .produit:hover {
      transform: translateY(-5px);
    }
    .produit input {
      margin-right: 10px;
    }
    #produit-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    button {
      display: block;
      margin: 30px auto;
      padding: 12px 28px;
      background: #008fc9;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    #resultat-comparaison {
      margin-top: 40px;
      text-align: center;
    }
    table {
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      background: white;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 15px;
      border: 1px solid #ccc;
    }
    th {
      background-color: #008fc9;
      color: white;
      font-size: 16px;
    }
    .highlight {
      background-color: #fff3cd;
      color: #856404;
      font-weight: bold;
    }
    .product-name {
      font-weight: bold;
      color: #333;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

<h2>🔍 Comparateur de Prix & Garantie</h2>

<input type="text" id="search-bar" placeholder="Rechercher un produit..." onkeyup="filterProduits()">

<form method="POST" action="get_comparaison.php" onsubmit="return validerComparaison();">
  <div id="produit-list">
    <?php foreach ($produits as $produit): ?>
      <div class="produit">
        <label>
          <input type="checkbox" name="ids[]" value="<?= $produit['id'] ?>">
          <span class="product-name"><?= htmlspecialchars($produit['nom']) ?></span><br>
          <small><?= number_format($produit['prix'], 2, '.', ' ') ?> MAD</small><br>
          <small>Garantie : <?= htmlspecialchars($produit['garantie']) ?></small>
        </label>
      </div>
    <?php endforeach; ?>
  </div>
  <button type="submit">Comparer</button>
</form>

<div id="resultat-comparaison"></div>

<script>
function filterProduits() {
  const search = document.getElementById("search-bar").value.toLowerCase();
  const produits = document.querySelectorAll("#produit-list .produit");
  produits.forEach(p => {
    const name = p.querySelector(".product-name").textContent.toLowerCase();
    p.style.display = name.includes(search) ? "block" : "none";
  });
}

function validerComparaison() {
  const checked = document.querySelectorAll('input[name="ids[]"]:checked');
  if (checked.length < 2 || checked.length > 3) {
    alert("Veuillez sélectionner entre 2 et 3 produits à comparer.");
    return false;
  }
  return true;
}
</script>

</body>
</html>
