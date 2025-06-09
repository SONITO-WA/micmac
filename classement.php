<?php
require_once 'db/connexion.php';
require_once 'includes/header.php';

// Récupération des 20 meilleurs scores par pseudo
$stmt = $pdo->query("
    SELECT pseudo, niveau, score, date_joue
    FROM scores
    ORDER BY score DESC, date_joue ASC
    LIMIT 20
");
$classement = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Classement - Quiz Mic Mac</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f1f5f9;
      padding: 40px;
      text-align: center;
    }
    h1 {
      color: #007BBD;
    }
    table {
      margin: 20px auto;
      width: 90%;
      max-width: 800px;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
    }
    th {
      background-color: #007BBD;
      color: white;
    }
    tr:hover {
      background-color: #f0f8ff;
    }
  </style>
</head>
<body>


  <h1>🏆 Classement Global - Quiz Mic Mac</h1>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Pseudo</th>
        <th>Niveau</th>
        <th>Score</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($classement as $index => $entry): ?>
      <tr>
        <td><?= $index + 1 ?></td>
        <td><?= htmlspecialchars($entry['pseudo']) ?></td>
        <td><?= htmlspecialchars($entry['niveau']) ?></td>
        <td><?= $entry['score'] ?></td>
        <td><?= date('d/m/Y H:i', strtotime($entry['date_joue'])) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="quizaa.php">⬅️ Retour à l'accueil</a>

</body>
</html>