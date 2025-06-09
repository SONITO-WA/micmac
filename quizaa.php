<?php
session_start();
require_once 'db/connexion.php';

// Simuler un utilisateur connecté si non défini
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'MicMacUser';
}

$username = $_SESSION['username'];

// Récupération des meilleurs scores par niveau
$stmt = $pdo->prepare("SELECT niveau, MAX(score) as highscore FROM scores WHERE pseudo = ? GROUP BY niveau");
$stmt->execute([$username]);
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

$highscores = ['facile' => '-', 'moyen' => '-', 'expert' => '-'];
foreach ($scores as $row) {
    $highscores[$row['niveau']] = $row['highscore'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Quiz Mic Mac</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #eef3f7;
      text-align: center;
      padding: 40px;
    }
    .container {
      background: white;
      padding: 30px;
      max-width: 600px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #007BBD;
    }
    .scoreboard {
      margin: 20px 0;
    }
    .scoreboard p {
      font-size: 1.1em;
    }
    .btn {
      margin: 10px 5px;
      padding: 12px 24px;
      font-size: 1.1em;
      border: none;
      background-color: #007BBD;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }
    .btn:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <div class="container">
    <h1>Bienvenue <strong><?= htmlspecialchars($username) ?></strong></h1>
    <h2>Choisissez votre mode de jeu :</h2>

    <div class="scoreboard">
      <p>🥉 Score facile : <?= $highscores['facile'] ?></p>
      <p>🥈 Score moyen : <?= $highscores['moyen'] ?></p>
      <p>🥇 Score expert : <?= $highscores['expert'] ?></p>
    </div>

    <div>
      <a href="quiz_micmac.php?niveau=facile" class="btn">Mode Facile</a>
      <a href="quiz_micmac.php?niveau=moyen" class="btn">Mode Moyen</a>
      <a href="quiz_micmac.php?niveau=expert" class="btn">Mode Expert</a>
    </div>

    <div style="margin-top: 20px;">
      <a href="classement.php" class="btn">🏆 Voir le classement</a>
    </div>
  </div>

</body>
</html>