<?php
if (isset($_GET['msg']) && $_GET['msg'] === 'must_register') {
  echo "<div style='color: red; text-align: center; font-weight: bold; margin-bottom: 15px;'>
    🔐 Vous devez créer un compte pour ajouter un produit au panier.
  </div>";
}

if (isset($_GET['error'])) {
  echo "<div style='color: red; text-align: center; font-weight: bold; margin-bottom: 15px;'>
    ❌ " . htmlspecialchars($_GET['error']) . "
  </div>";
}
?>

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
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('../images/bg-register.jpg') center/cover no-repeat;
      backdrop-filter: blur(8px);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .register-container {
      background-color: white;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      max-width: 900px;
      width: 100%;
    }
    .register-left {
      background-color: #008fc9;
      color: white;
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .register-left h2 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .register-left p {
      font-size: 16px;
    }
    .register-right {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .register-right h3 {
      margin-bottom: 20px;
      color: #008fc9;
      text-align: center;
    }
    .register-right input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }
    .register-right .row {
      display: flex;
      gap: 10px;
    }
    .register-right button {
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
    </style>
</head>
<body>
  <div class="register-container" style="animation: fadeInUp 0.7s ease-out;">
    <div class="register-left">
      <img src="images/logoo.png" alt="Logo" style="width:120px; margin-bottom: 20px;">
      <h2>Toujours intéressés ?<br>Rejoignez-nous maintenant.</h2>
      <p>Accédez à tous nos services et suivez facilement toutes vos commandes via notre tableau de bord. Connectez-vous dès maintenant pour tout gérer au même endroit.</p>
    </div>
    <div class="register-right">
      <h3>S'inscrire</h3>
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
