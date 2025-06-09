<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

$id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
$nom_admin = $user ? $user['name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Mic Mac</title>
  <link rel="stylesheet" href="css/style.css"> <!-- si tu as un fichier style.css -->
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      color: #003147;
      margin: 0;
    }
    .dashboard {
      padding: 40px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: scale(1.02);
    }
    .card h2 {
      color: #008fc9;
      margin-bottom: 10px;
    }
    .card a {
      text-decoration: none;
      color: #003147;
      font-weight: bold;
    }
    .logout {
      margin: 30px;
      display: inline-block;
      padding: 10px 20px;
      background: #ff4d4d;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }
    .topbar, .main-header {
      padding: 15px 30px;
      background-color: #e8f4fa;
    }
    .topbar-left a, .topbar-right a {
      margin-right: 15px;
      color: #003147;
      text-decoration: none;
    }
    .nav-links {
      list-style: none;
      padding: 0;
      display: flex;
      gap: 20px;
    }
    .nav-links a {
      text-decoration: none;
      color: #003147;
      font-weight: bold;
    }
    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #d9f1fb;
    }
    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: white;
      border: 1px solid #ccc;
      padding: 10px;
      list-style: none;
    }
    .dropdown:hover .dropdown-menu {
      display: block;
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<!-- Contenu principal -->
<div style="padding: 30px;">
  <h1>Bonjour Admin : <?= htmlspecialchars($nom_admin) ?></h1>
  <p>Bienvenue dans votre espace de gestion sécurisé.</p>
</div>

<div class="dashboard">

  <div class="card">
    <div class="card-icon">📦</div>
    <h2>Produits & Services</h2>
    <p><a href="produits.php">Ajouter, modifier ou supprimer un produit.</a></p>
  </div>

  <div class="card">
    <div class="card-icon">📩</div>
    <h2>Demandes clients</h2>
    <p><a href="messages.php">Voir et traiter les messages envoyés via le site.</a></p>
  </div>

  <div class="card">
  <div class="card-icon">🎥</div>
  <h2>Ajouter une vidéo</h2>
  <p><a href="ajouter_video.php">Gérez les vidéos tutorielles ou ajoutez-en de nouvelles.</a></p>
</div>


  <div class="card">
    <div class="card-icon">🧾</div>
    <h2>Devis & Factures</h2>
    <p> <a href="admin_commandes.php" class="card-btn">Consultez et téléchargez vos reçus de commandes enregistrées.</a></p>
  </div>

</div>

</body>
</html>
