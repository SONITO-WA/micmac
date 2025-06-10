<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'db/connexion.php';

$errorMessage = "";

// Seulement si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["login_email"]);
    $password = $_POST["login_password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["name"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["admin"] = ($user["role"] === "admin");

        if ($user["role"] === "admin") {
            header("Location: dashboard.php");
        } else {
            header("Location: profil.php");
        }
        exit();
    } else {
        $errorMessage = "❌ Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - MicMac</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('../images/bg-login.jpg') center/cover no-repeat;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,0.4);
      backdrop-filter: blur(10px);
      z-index: 0;
    }
    .login-container {
      position: relative;
      background-color: white;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      width: 90%;
      max-width: 900px;
      z-index: 1;
    }
    .login-left {
      background-color: #008fc9;
      color: white;
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .login-left h2 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .login-left p {
      font-size: 16px;
    }
    .login-right {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .login-right .top-button {
      text-align: center;
      margin-bottom: 20px;
    }
    .login-right .top-button a {
      display: inline-block;
      background-color: white;
      border: 2px solid #008fc9;
      color: #008fc9;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: bold;
      text-decoration: none;
    }
    .login-right input[type="email"],
    .login-right input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }
    .login-right button {
      background-color: #008fc9;
      color: white;
      font-weight: bold;
      padding: 12px;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
    }
    .login-right .extra {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 14px;
    }
    .login-right .extra a {
      color: #008fc9;
      text-decoration: none;
    }
    .login-right .register-link {
      margin-top: 15px;
      text-align: center;
    }
    .login-right .register-link a {
      color: #d60000;
      font-weight: bold;
      text-decoration: none;
    }
    .error-message {
      background-color: #ffe6e6;
      color: #d60000;
      padding: 12px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
    }
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(40px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .password-wrapper {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #777;
    }
  </style>
</head>
<body>

<div class="overlay"></div>
<div class="login-container" style="animation: fadeInUp 0.7s ease-out;">
  <div class="login-left">
    <img src="images/logoo.png" alt="Logo" style="width:120px; margin-bottom: 20px;">
    <h2>Toujours intéressés ?<br>Rejoignez-nous maintenant.</h2>
    <p>Accédez à tous nos services et suivez facilement toutes vos commandes via notre tableau de bord. Connectez-vous dès maintenant pour tout gérer au même endroit.</p>
  </div>
  <div class="login-right">
    <?php if (!empty($errorMessage)) : ?>
      <div class="error-message"><?= $errorMessage ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'connect_required'): ?>
      <div style='color: red; text-align: center; font-weight: bold; margin-bottom: 20px;'>
        🔒 Veuillez vous connecter pour ajouter un article au panier.
      </div>
    <?php endif; ?>

    <form action="login.php" method="POST" autocomplete="off">
      <input type="email" name="login_email" placeholder="Votre email" required autocomplete="off">
      
      <div class="password-wrapper">
        <input type="password" name="login_password" id="password" placeholder="Mot de passe" required autocomplete="new-password">
        <span class="toggle-password" onclick="togglePassword()">👁️</span>
      </div>

      <div class="extra">
        <label><input type="checkbox"> Souviens-toi de moi</label>
        <a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a>
      </div>
      <button type="submit">Se connecter</button>
      <div class="register-link">
        <p>Pas encore inscrit ? <a href="register.php">Créer un nouveau compte !</a></p>
      </div>
    </form>
  </div>
</div>

<script>
function togglePassword() {
  const pwd = document.getElementById("password");
  pwd.type = pwd.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
