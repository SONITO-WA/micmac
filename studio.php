<?php
// Démarrer la session en premier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db/connexion.php';

$theme = isset($_GET['theme']) ? $_GET['theme'] : '';
$sql = $theme ? "SELECT * FROM videos WHERE theme = ?" : "SELECT * FROM videos ORDER BY theme, date_ajout DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($theme ? [$theme] : []);
$videos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mic Mac Studio - Vidéos</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f1f5f9;
      padding: 30px;
    }
    h1 {
      text-align: center;
      color: #003366;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .video-card {
      width: 320px;
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    video {
      width: 100%;
      border-radius: 6px;
    }
  </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
  <h1>🎥 Mic Mac Studio – Galerie de vidéos tutorielles</h1>

  <form method="GET" style="text-align:center; margin-bottom:20px;">
    <select name="theme" onchange="this.form.submit()">
      <option value="">-- Tous les thèmes --</option>
      <option value="Réseau">Réseau</option>
      <option value="Périphériques">Périphériques</option>
      <option value="Sécurité">Sécurité</option>
      <option value="Logiciels">Logiciels</option>
      <option value="Maintenance">Maintenance</option>
    </select>
  </form>

  <div class="gallery">
    <?php foreach ($videos as $v): ?>
      <div class="video-card">
        <video controls>
          <source src="videos/<?= htmlspecialchars($v['fichier']) ?>" type="video/mp4">
        </video>
        <h3><?= htmlspecialchars($v['titre']) ?></h3>
        <p><strong>Thème :</strong> <?= htmlspecialchars($v['theme']) ?></p>
        <p><strong>Tags :</strong> <?= htmlspecialchars($v['tags']) ?></p>
        <p><?= htmlspecialchars($v['description']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
