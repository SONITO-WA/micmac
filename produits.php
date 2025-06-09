<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM produits");
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
      padding: 40px 20px;
    }
    h2 {
      text-align: center;
      color: #007BBD;
      margin-bottom: 20px;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      max-width: 900px;
      margin-inline: auto;
    }
    .button-add {
      background-color: #007BBD;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
    }
    .button-add:hover {
      background-color: #005f8a;
    }
    .search-box input {
      padding: 10px;
      width: 250px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    table {
      width: 100%;
      max-width: 1000px;
      margin: auto;
      background-color: white;
      border-collapse: collapse;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      overflow: hidden;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #007BBD;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .actions a {
      margin: 0 5px;
      text-decoration: none;
      color: #007BBD;
      font-size: 18px;
    }
    img {
      width: 70px;
      border-radius: 6px;
    }
    .compare-btn {
      display: block;
      margin: 20px auto 0 auto;
      padding: 10px 20px;
      background-color: #007BBD;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }
    @media screen and (max-width: 768px) {
      .top-bar {
        flex-direction: column;
        gap: 15px;
      }
      .search-box input {
        width: 100%;
      }
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<h2>Produits & Services</h2>

<div class="top-bar">
  <a href="ajouter_produit.php" class="button-add">➕ Ajouter un produit</a>
  <div class="search-box">
    <input type="text" id="searchInput" placeholder="🔍 Rechercher un produit...">
  </div>
</div>

<form method="POST" action="comparateur.php" onsubmit="return validerComparaison();">
<table id="productsTable">
  <thead>
    <tr>
      <th>Comparer</th>
      <th>Image</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Prix (DH)</th>
      <th>Garantie</th>
      <th>Catégorie</th>
      <th>Actions</th>
      <th>Panier</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($produits as $produit): ?>
      <tr>
        <td><input type="checkbox" name="ids[]" value="<?= $produit['id'] ?>"></td>
        <td>
          <?php if (!empty($produit['image'])): ?>
            <img src="images/uploads/<?= $produit['image'] ?>" alt="Image produit">
          <?php else: ?>
            <span style="color: gray;">—</span>
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($produit['nom']) ?></td>
        <td><?= htmlspecialchars($produit['description']) ?></td>
        <td><?= htmlspecialchars($produit['prix']) ?></td>
        <td><?= htmlspecialchars($produit['garantie']) ?></td>
        <td><?= htmlspecialchars($produit['categorie']) ?></td>
        <td class="actions">
          <a href="modifier_produit.php?id=<?= $produit['id'] ?>">✏️</a>
          <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" onclick="return confirm('Supprimer ce produit ?')">🗑️</a>
        </td>
        <td>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="ajouter_panier.php?id=<?= $produit['id'] ?>" class="btn">Ajouter au panier</a>
          <?php else: ?>
            <a href="register.php?msg=must_register" class="btn" onclick="alert('Vous devez créer un compte pour ajouter un produit au panier.')">Ajouter au panier</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<button type="submit" class="compare-btn">🧮 Comparer les produits sélectionnés</button>
</form>

<script>
  const searchInput = document.getElementById("searchInput");
  const tableRows = document.querySelectorAll("#productsTable tbody tr");

  searchInput.addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    tableRows.forEach(row => {
      const rowText = row.innerText.toLowerCase();
      row.style.display = rowText.includes(searchValue) ? "" : "none";
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
