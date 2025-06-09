<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM produits";
$where = [];
$params = [];

if (!empty($_GET['categorie'])) {
  $where[] = "categorie = ?";
  $params[] = $_GET['categorie'];
}

if (!empty($where)) {
  $query .= " WHERE " . implode(" AND ", $where);
}

if (!empty($_GET['tri'])) {
  if ($_GET['tri'] === 'prix_asc') {
    $query .= " ORDER BY prix ASC";
  } elseif ($_GET['tri'] === 'prix_desc') {
    $query .= " ORDER BY prix DESC";
  }
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Produits & Services</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
      padding: 20px;
      margin: 0;
    }

    h2 {
      text-align: center;
      color: #007BBD;
      margin-bottom: 30px;
    }

    .search-box {
      max-width: 500px;
      margin: 0 auto 30px auto;
      text-align: center;
    }

    .search-box input {
      padding: 10px;
      width: 100%;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .product-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 20px;
      width: 280px;
      text-align: center;
      position: relative;
    }

    .card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .card h3 {
      margin: 10px 0 5px 0;
      font-size: 18px;
      color: #1f2a37;
    }

    .card p {
      font-size: 14px;
      color: #555;
      margin-bottom: 6px;
    }

    .btn-panier {
      background-color: #007BBD;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }

    .compare-zone {
      text-align: center;
      margin-top: 30px;
    }

    .compare-zone button {
      background-color: #007BBD;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    .checkbox-compare {
      position: absolute;
      top: 15px;
      left: 15px;
      transform: scale(1.2);
    }

    @media screen and (max-width: 768px) {
      .card {
        width: 90%;
      }
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<h2>Produits & Services</h2>


<div class="search-box">
  <form method="GET" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
    <select name="categorie" style="padding: 8px; border-radius: 8px; font-size: 15px;">
      <option value="">Toutes les catégories</option>
      <?php
       $categories = ["Ordinateurs", "Périphériques", "Accessoires", "Cameras", "Réseau"];
foreach ($categories as $cat) {
  $selected = (isset($_GET['categorie']) && $_GET['categorie'] == $cat) ? 'selected' : '';
  echo '<option value="' . htmlspecialchars($cat) . '" ' . $selected . '>' . htmlspecialchars($cat) . '</option>';
}

      ?>
    </select>

    <select name="tri" style="padding: 8px; border-radius: 8px; font-size: 15px;">
      <option value="">Trier par</option>
      <option value="prix_asc" <?= isset($_GET['tri']) && $_GET['tri'] == 'prix_asc' ? 'selected' : '' ?>>Prix croissant</option>
      <option value="prix_desc" <?= isset($_GET['tri']) && $_GET['tri'] == 'prix_desc' ? 'selected' : '' ?>>Prix décroissant</option>
    </select>

    <button type="submit" style="padding: 8px 16px; background-color: #007BBD; color: white; border: none; border-radius: 8px;">Filtrer</button>
  </form>

  <input type="text" id="searchInput" placeholder="🔍 Rechercher un produit...">
</div>

<form method="POST" action="comparateur.php" onsubmit="return validerComparaison();">
  <div class="product-grid" id="productsGrid">
    <?php foreach ($produits as $produit): ?>
      <div class="card">
        <input type="checkbox" class="checkbox-compare" name="ids[]" value="<?= $produit['id'] ?>">
        <?php if (!empty($produit['image'])): ?>
          <img src="images/uploads/<?= $produit['image'] ?>" alt="Produit">
        <?php else: ?>
          <img src="images/default.jpg" alt="Pas d'image">
        <?php endif; ?>
        <h3><?= htmlspecialchars($produit['nom']) ?></h3>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <p><strong><?= htmlspecialchars($produit['prix']) ?> DH</strong></p>
        <p>Garantie : <?= htmlspecialchars($produit['garantie']) ?></p>
        <p>Catégorie : <?= htmlspecialchars($produit['categorie']) ?></p>
        <a href="ajouter_panier.php?id=<?= $produit['id'] ?>" class="btn-panier">Ajouter au panier</a>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="compare-zone">
    <button type="submit">🧮 Comparer les produits sélectionnés</button>
  </div>
</form>

<script>
  const searchInput = document.getElementById("searchInput");
  const cards = document.querySelectorAll(".card");

  searchInput.addEventListener("input", function () {
    const val = this.value.toLowerCase();
    cards.forEach(card => {
      const text = card.innerText.toLowerCase();
      card.style.display = text.includes(val) ? "" : "none";
    });
  });

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
