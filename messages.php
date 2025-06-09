<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Traitement du changement de statut
if (isset($_GET['id']) && isset($_GET['statut'])) {
    $id = intval($_GET['id']);
    $nouveauStatut = $_GET['statut'] === 'traité' ? 'traité' : 'non traité';
    $stmt = $pdo->prepare("UPDATE messages_contact SET statut = ? WHERE id = ?");
    $stmt->execute([$nouveauStatut, $id]);
    header("Location: messages.php");
    exit();
}

// Récupération des messages
$stmt = $pdo->query("SELECT * FROM messages_contact ORDER BY date_envoi DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages Clients - Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f9ff;
      color: #003147;
      padding: 30px;
    }
    h1 {
      color: #008fc9;
    }
    .message {
      background: white;
      padding: 20px;
      margin-bottom: 20px;
      border-left: 5px solid #008fc9;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .message h3 {
      margin: 0;
      font-size: 18px;
    }
    .message p {
      margin: 5px 0;
    }
    .statut {
      font-weight: bold;
      color: #555;
    }
    .btn {
      padding: 6px 10px;
      background-color: #008fc9;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 13px;
      margin-top: 10px;
      display: inline-block;
    }
    .btn.red {
      background-color: #e74c3c;
    }
  </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

  <h1>📩 Messages reçus via le formulaire de contact</h1>

  <?php foreach ($messages as $msg): ?>
    <div class="message">
      <h3><?= htmlspecialchars($msg['nom_prenom']) ?> - <?= htmlspecialchars($msg['email']) ?></h3>
      <p><strong>Téléphone :</strong> <?= htmlspecialchars($msg['telephone']) ?></p>
      <p><strong>Sujet :</strong> <?= htmlspecialchars($msg['sujet']) ?></p>
      <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
      <p><strong>Statut :</strong> <span class="statut"><?= $msg['statut'] ?></span></p>
      <p><strong>Envoyé le :</strong> <?= $msg['date_envoi'] ?></p>
      <?php if ($msg['statut'] === 'non traité'): ?>
        <a class="btn" href="messages.php?id=<?= $msg['id'] ?>&statut=traité">Marquer comme traité</a>
      <?php else: ?>
        <a class="btn red" href="messages.php?id=<?= $msg['id'] ?>&statut=non traité">Revenir à non traité</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

</body>
</html>
