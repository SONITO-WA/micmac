<?php 
// Démarrer la session en premier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'db/connexion.php'; // contient la variable $pdo

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);

    $sql = "INSERT INTO messages_contact (nom_prenom, email, telephone, sujet, message)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $telephone, $sujet, $message]);

    // Redirection vers merci.php après envoi du formulaire
    header("Location: merci.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mic Mac Informatique - Contact</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      AOS.init();
    });
  </script>
  <style>
    .contact-section {
      background-color: #e8f4fa;
      padding: 60px 20px;
      color: #003147;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .contact-wrapper {
      width: 100%;
      max-width: 1200px;
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      justify-content: center;
      align-items: center;
    }
    .contact-info {
      flex: 1;
      min-width: 280px;
    }
    .contact-form {
      flex: 1;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .form-row {
      display: flex;
      gap: 10px;
    }
    .form-row input,
    .contact-form textarea {
      flex: 1;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-family: inherit;
    }
    .contact-form button {
      width: 150px;
      padding: 10px;
      background-color: #008fc9;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<!-- Section Contact -->
<section class="contact-section">
  <div class="contact-wrapper">
    <div class="contact-info">
      <h2 data-aos="fade-up" style="color:#008fc9;">Contactez-nous</h2>
      <h3 data-aos="fade-up" style="font-weight: 400;">MICMAC Informatique - Toujours à votre service</h3>
      <p data-aos="fade-right">Contactez-nous pour toute question technique ou commerciale. Nous sommes là pour vous aider.</p>
      <p data-aos="fade-right">Vous ne trouvez pas un produit ou service spécifique sur notre site ? N’hésitez pas à nous le signaler via ce formulaire. Si nous pouvons vous le fournir, nous le ferons avec plaisir !</p>
    </div>

    <form data-aos="zoom-in" class="contact-form" method="POST" action="contact.php">
      <div class="form-row">
        <input type="text" name="nom" placeholder="Nom et Prénom" required>
        <input type="email" name="email" placeholder="Adresse e-mail" required>
      </div>
      <div class="form-row">
        <input type="text" name="telephone" placeholder="Numéro de téléphone" required>
        <input type="text" name="sujet" placeholder="Sujet" required>
      </div>
      <textarea name="message" placeholder="Message" required rows="5"></textarea>
      <button type="submit">Envoyer</button>
    </form>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
