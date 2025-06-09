<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['username']) || !isset($_GET['score']) || !isset($_GET['niveau'])) {
    header("Location: quizaa.php");
    exit();
}

$pseudo = $_SESSION['username'];
$score = intval($_GET['score']);
$niveau = $_GET['niveau'];

// Enregistrement du score avec pseudo
$stmt = $pdo->prepare("INSERT INTO scores (pseudo, score, niveau, date_joue) VALUES (?, ?, ?, NOW())");
$stmt->execute([$pseudo, $score, $niveau]);

// Récupération du meilleur score
$stmt = $pdo->prepare("SELECT MAX(score) FROM scores WHERE pseudo = ? AND niveau = ?");
$stmt->execute([$pseudo, $niveau]);
$best = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultat - Quiz Mic Mac</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #eaf4fc;
      text-align: center;
      padding: 40px;
    }
    .container {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #007BBD;
    }
    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 1em;
      background-color: #007BBD;
      color: white;
      text-decoration: none;
      border-radius: 6px;
    }
    .btn:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <div class="container">
    <h1>👏 Bien joué, <?= htmlspecialchars($pseudo) ?> !</h1>
    <p>Ton score : <strong><?= $score ?></strong></p>
    <p>🏆 Ton meilleur score en mode <strong><?= htmlspecialchars($niveau) ?></strong> : <strong><?= $best ?></strong></p>

    <a href="quizaa.php" class="btn">Revenir à l'accueil</a>
  </div>

</body>
</html>