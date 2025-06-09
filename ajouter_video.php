<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

require_once 'db/connexion.php';

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars($_POST['titre']);
    $tags = htmlspecialchars($_POST['tags']);

    if ($_POST['theme'] === '__new__' && !empty($_POST['nouveau_theme'])) {
        $theme = htmlspecialchars($_POST['nouveau_theme']);
    } else {
        $theme = htmlspecialchars($_POST['theme']);
    }

    if (!empty($_FILES['fichier']['name'])) {
        $targetDir = "../videos/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = uniqid() . "_" . basename($_FILES["fichier"]["name"]);
        $targetFile = $targetDir . $filename;

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['mp4', 'webm', 'ogg'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $targetFile)) {
                $stmt = $pdo->prepare("INSERT INTO videos (titre, fichier, theme, tags) VALUES (?, ?, ?, ?)");
                $stmt->execute([$titre, $filename, $theme, $tags]);
                $success = "Vidéo ajoutée avec succès !";
            } else {
                $error = "Erreur lors de l'upload du fichier.";
            }
        } else {
            $error = "Format de fichier non autorisé.";
        }
    } else {
        $error = "Veuillez sélectionner une vidéo.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter une vidéo - Mic Mac Studio</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: rgb(110, 162, 214);
      padding: 30px;
    }

    .form-container {
      background: white;
      max-width: 600px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 30px;
    }

    h2 {
      text-align: center;
      color: #007BBD;
      margin-bottom: 30px;
    }

    input[type="text"],
    textarea,
    select,
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    button {
      background-color: #007BBD;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
    }

    .message {
      text-align: center;
      margin-bottom: 20px;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    body {
  margin-top: 0 !important;
}
body {
  margin-top: 0 !important;
}


  </style>
</head>
<?php include 'includes/header.php'; ?>
<body>
  

  <div class="form-container">
    <h2>Ajouter une vidéo</h2>

    <?php if ($success): ?>
      <p class="message success"><?= $success ?></p>
    <?php elseif ($error): ?>
      <p class="message error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Titre de la vidéo</label>
      <input type="text" name="titre" required>

      <label>Thème</label>
      <?php
      $themes = $pdo->query("SELECT DISTINCT theme FROM videos WHERE theme IS NOT NULL AND theme != ''")->fetchAll(PDO::FETCH_COLUMN);
      ?>
      <select name="theme" id="theme-select" onchange="toggleNewTheme()" required>
        <option value="">-- Sélectionner un thème --</option>
        <?php foreach ($themes as $t): ?>
          <option value="<?= htmlspecialchars($t) ?>"><?= htmlspecialchars($t) ?></option>
        <?php endforeach; ?>
        <option value="__new__">+ Nouveau thème</option>
      </select>

      <div id="new-theme-field" style="display: none; margin-top: 10px;">
        <input type="text" name="nouveau_theme" placeholder="Entrez le nouveau thème">
      </div>

      <label>Tags</label>
      <input type="text" name="tags" placeholder="Ex: Java, MySQL, POO...">

      <label>Fichier vidéo</label>
      <input type="file" name="fichier" accept="video/*" required>

      <button type="submit">Ajouter la vidéo</button>
    </form>
  </div>

  <script>
    function toggleNewTheme() {
      const select = document.getElementById('theme-select');
      const newField = document.getElementById('new-theme-field');
      if (select.value === '__new__') {
        newField.style.display = 'block';
      } else {
        newField.style.display = 'none';
      }
    }
  </script>
</body>
</html>
