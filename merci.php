<?php
// Démarrer la session en premier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Merci pour votre commande</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 60px;
      background-color: #f0f8ff;
    }
    h1 {
      color: #008fc9;
    }
    a {
      color: #003147;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <h1>Merci pour votre commande !</h1>
  <p>Votre commande a bien été enregistrée. Nous vous contacterons sous peu pour la livraison.</p>
  <p><a href="index.html">Retour à l'accueil</a></p>
</body>
</html>
