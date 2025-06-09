<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $photo = $user['photo'];

    if (!empty($_FILES['photo']['name'])) {
        $photoDir = __DIR__ . "/images/profiles/";
        if (!is_dir($photoDir)) {
            mkdir($photoDir, 0777, true);
        }

        $photoName = uniqid() . "_" . basename($_FILES['photo']['name']);
        $uploadPath = $photoDir . $photoName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
            $photo = $photoName;
        } else {
            echo "<p style='color:red;'>Erreur lors de l'enregistrement de la photo.</p>";
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET name=?, sexe=?, date_naissance=?, photo=? WHERE id=?");
    $stmt->execute([$name, $sexe, $date_naissance, $photo, $id]);

    // Recharger les données mises à jour
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00b4db, #0083b0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .profile-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            color: #008fc9;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #008fc9;
            color: white;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin: 20px auto;
            display: block;
            border: 3px solid #008fc9;
        }
    </style>
    
</head>
<body>

    <div class="profile-box">
        <h2>Bonjour <?= htmlspecialchars($user['name']) ?> 👋</h2>
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
   <a href="index.php" style="padding: 10px 20px; background-color: #1abc9c; color: white; text-decoration: none; border-radius: 8px;">🏠 Accueil</a>

    <a href="logout.php" style="padding: 10px 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 8px;">🚪 Déconnexion</a>
</div>


        <?php if (!empty($user['photo'])): ?>
            <img src="images/profiles/<?= htmlspecialchars($user['photo']) ?>" alt="Photo de profil" class="profile-img">
        <?php else: ?>
            <div class="profile-img" style="display:flex;align-items:center;justify-content:center;color:gray;">Photo</div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Nom :</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label>Sexe :</label>
            <select name="sexe" required>
                <option value="">-- Choisir --</option>
                <option value="Homme" <?= $user['sexe'] === 'Homme' ? 'selected' : '' ?>>Homme</option>
                <option value="Femme" <?= $user['sexe'] === 'Femme' ? 'selected' : '' ?>>Femme</option>
                <option value="Autre" <?= $user['sexe'] === 'Autre' ? 'selected' : '' ?>>Autre</option>
            </select>

            <label>Date de naissance :</label>
            <input type="date" name="date_naissance" value="<?= $user['date_naissance'] ?>">

            <label>Photo de profil :</label>
            <input type="file" name="photo" accept="image/*">

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
