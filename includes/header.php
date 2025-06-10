<?php
  session_start();

?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
  .navbar-micmac {
    background: #007BBD;
    color: white;
    font-family: 'Poppins', sans-serif;
    padding: 10px 30px;
  }

  .nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .logo a {
    font-size: 1.6em;
    font-weight: bold;
    color: white;
    text-decoration: none;
  }

  .nav-center {
    display: flex;
    align-items: center;
    list-style: none;
    gap: 20px;
    margin: 0;
    padding: 0;
  }

  .nav-center li {
    position: relative;
  }

  .nav-center a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 5px 8px;
    transition: 0.3s;
  }

  .nav-center a:hover {
    color:rgb(66, 131, 163);
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    padding: 10px;
    border-radius: 6px;
    top: 35px;
    left: 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 999;
    min-width: 160px;
  }

  .dropdown-menu li {
    margin-bottom: 6px;
  }

  .dropdown-menu a {
    color: #003366 !important;
  }

  .dropdown-menu a:hover {
    color: #007BBD !important;
  }

  .btn-admin {
    background: transparent;
    border: 1px solid white;
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s;
    margin-right: 10px;
  }

  .btn-admin:hover {
    background-color: rgba(255, 255, 255, 0.15);
  }

  .btn-login {
    background-color:rgb(25, 25, 132) ;
    color: #007BBD;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: 600;
    text-decoration: none;
  }

  .btn-deco {
    background-color: #e74c3c;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: 600;
    text-decoration: none;
    margin-left: 10px;
  }

  .admin-badge {
    background: #004477;
    color: white;
    font-size: 0.75em;
    padding: 3px 8px;
    border-radius: 5px;
    margin-left: 6px;
    font-weight: bold;
  }

  .user-section {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .user-section img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
  }

  @media (max-width: 768px) {
    .nav-container {
      flex-direction: column;
      align-items: flex-start;
    }

    .nav-center {
      flex-wrap: wrap;
      gap: 10px;
    }

    .user-section {
      margin-top: 10px;
    }
    .main-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 9999;
}
body {
  padding-top: 80px; /* Ajuste selon la hauteur de ta navbar */
}

  }

</style>

<header class="navbar-micmac">
  <div class="nav-container">

    <div class="logo">
      <a href="index.php">MIC MAC</a>
    </div>

    <ul class="nav-center">
      <li><a href="index.php">Accueil</a></li>
      <li>
        <a href="#">Produits ▾</a>
        <ul class="dropdown-menu">
          <li><a href="categorie.php?type=Ordinateurs">Ordinateurs</a></li>
          <li><a href="categorie.php?type=Périphériques">Périphériques</a></li>
          <li><a href="categorie.php?type=Accessoires">Accessoires</a></li>
          <li><a href="categorie.php?type=Cameras">Cameras</a></li>
          <li><a href="categorie.php?type=Réseau">Réseau</a></li>
        </ul>
      </li>
      <li><a href="apropos.php">À propos</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="panier.php">Panier 🛒</a></li>
      <li>
        <a href="#">⋮</a>
        <ul class="dropdown-menu">
          <li><a href="quizaa.php">Quiz Mic Mac</a></li>
          <li><a href="comparateur.php">Comparateur</a></li>
          <li><a href="studio.php">MicMac Studio</a></li>
        </ul>
      </li>
    </ul>

    <div class="user-section">
      <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
        <a href="dashboard.php" class="btn-admin">♔</a>
      <?php endif; ?>

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profil.php" style="display: flex; align-items: center; gap: 6px; text-decoration: none; color: white;">
          <img src="images/profiles/<?= htmlspecialchars($_SESSION['photo'] ?? 'default.png') ?>" alt="Profil">
          <?= htmlspecialchars($_SESSION['username'] ?? 'Profil') ?>
        </a>
        <a href="logout.php" class="btn-deco">Déconnexion</a>
      <?php else: ?>
        <a href="login.php" class="btn-login">Se connecter</a>
      <?php endif; ?>
    </div>
  </div>
  <script src="js/theme.js"></script>

</header>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".nav-center > li").forEach(li => {
      li.addEventListener("mouseenter", () => {
        const submenu = li.querySelector(".dropdown-menu");
        if (submenu) submenu.style.display = "block";
      });
      li.addEventListener("mouseleave", () => {
        const submenu = li.querySelector(".dropdown-menu");
        if (submenu) submenu.style.display = "none";
      });
    });
  });
</script>
