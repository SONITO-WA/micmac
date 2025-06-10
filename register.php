<?php
require_once 'db/connexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        header("Location: register.php?error=Les mots de passe ne correspondent pas.");
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        header("Location: register.php?error=Cet email est déjà utilisé.");
        exit();
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $passwordHash])) {
            header("Location: login.php");
            exit();
        } else {
            header("Location: register.php?error=Erreur lors de l'inscription.");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription - MicMac</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('../images/bg-register.jpg') center/cover no-repeat fixed;
      backdrop-filter: blur(5px);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .register-container {
      display: flex;
      flex-direction: row;
      background-color: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      max-width: 1000px;
      width: 100%;
      animation: fadeInUp 0.7s ease-out;
    }

    .register-left, .register-right {
      flex: 1;
      padding: 40px;
    }

    .register-left {
      background-color: #008fc9;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .register-left img {
      width: 100px;
      margin-bottom: 20px;
    }

    .register-left h2 {
      font-size: 26px;
      margin-bottom: 10px;
    }

    .register-left p {
      font-size: 16px;
    }

    .register-right h3 {
      text-align: center;
      margin-bottom: 25px;
      color: #008fc9;
      font-size: 24px;
    }

    form input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .row {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    button[type="submit"] {
      width: 100%;
      padding: 14px;
      background-color: #008fc9;
      color: white;
      border: none;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
    }

    .alert {
      width: 100%;
      text-align: center;
      padding: 10px;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .alert.error {
      color: #b30000;
    }

    .alert.info {
      color: #00529B;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
      }

      .register-left {
        padding: 30px 20px;
      }

      .register-right {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-left">
      <img src="images/logoo.png" alt="Logo">
      <h2>Toujours intéressé ?</h2>
      <p>Rejoignez-nous maintenant pour gérer vos commandes et services.</p>
    </div>
    <div class="register-right">
      <h3>S'inscrire</h3>

      <?php if (isset($_GET['msg']) && $_GET['msg'] === 'must_register'): ?>
        <div class="alert info">🔐 Vous devez créer un compte pour ajouter un produit au panier.</div>
      <?php endif; ?>

      <?php if (isset($_GET['error'])): ?>
        <div class="alert error">❌ <?= htmlspecialchars($_GET['error']) ?></div>
      <?php endif; ?>

      <form action="register.php" method="POST" onsubmit="return validerFormulaire();">
        <div class="row">
          <input type="text" name="name" placeholder="Nom complet" required>
        </div>
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'inscrire</button>
      </form>

      <script>
        function validerFormulaire() {
          const pass = document.getElementById("password").value;
          const confirm = document.getElementById("confirm_password").value;
          if (pass !== confirm) {
            alert("❌ Les mots de passe ne correspondent pas !");
            return false;
          }
          return true;
        }
      </script>
    </div>
  </div>
</body>
</html>
