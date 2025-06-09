<?php
session_start();
require_once 'db/connexion.php';

// Vérification de la session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $image = null;

    // Gestion de l'image
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_path = 'images/uploads/' . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image = $image_name;
        } else {
            $message = "❌ Échec de l'upload de l'image.";
        }
    }

    // Insertion du produit
    $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, categorie, image, date_ajout) VALUES (?, ?, ?, ?, ?, NOW())");
    if ($stmt->execute([$nom, $description, $prix, $categorie, $image])) {
        $message = "✅ Produit ajouté avec succès.";
    } else {
        $message = "❌ Erreur lors de l'ajout.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un produit</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
      padding: 40px 20px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    h2 {
      color: #007BBD;
      text-align: center;
      margin-bottom: 30px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #333;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #007BBD;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: #005f8a;
    }

    .message {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: green;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
      color: #007BBD;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>


<div class="container">
  <h2>Ajouter un produit</h2>

  <?php if (!empty($message)): ?>
    <p class="message"><?= $message ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label>Nom du produit :</label>
    <input type="text" name="nom" required>

    <label>Description :</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Prix (DH) :</label>
    <input type="number" step="0.01" name="prix" required>

    <label>Catégorie :</label>
    <select name="categorie" required>
      <option value="">-- Choisir une catégorie --</option>
      <option value="Ordinateurs">Ordinateurs</option>
      <option value="Périphériques">Périphériques</option>
      <option value="Accessoires">Accessoires</option>
      <option value="Cameras">Cameras</option>
      <option value="Réseau">Réseau</option>
    </select>
    <label for="garantie">Garantie :</label>
<input type="text" name="garantie" id="garantie" required>


    <label>Image du produit :</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">➕ Ajouter</button>
  </form>

  <a href="produits.php" class="back-link">⬅️ Retour à la liste des produits</a>
</div>

</body>
</html>
