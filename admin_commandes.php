<?php
session_start();
require_once 'db/connexion.php';

$commandes = $pdo->query("SELECT * FROM commandes ORDER BY date_commande DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Commandes - Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
      line-height: 1.6;
    }

    /* Styles pour le header inclus - pour éviter les conflits */
    .main-content {
      margin-top: 80px; /* Ajustez selon la hauteur de votre header */
      padding: 20px;
      min-height: calc(100vh - 80px);
    }

    /* Si le header a une position fixed, ajustez le margin-top */
    @media (max-width: 768px) {
      .main-content {
        margin-top: 60px;
        padding: 15px;
      }
    }

    .page-title {
      text-align: center;
      color: #007BBD;
      margin-bottom: 30px;
      font-size: 1.8em;
      font-weight: 600;
    }

    .cards-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 20px;
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 10px;
    }

    .commande-card {
      background: white;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border-left: 4px solid #007BBD;
    }

    .commande-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .commande-card h3 {
      color: #007BBD;
      margin-bottom: 16px;
      font-size: 1.2em;
      font-weight: 600;
    }

    .commande-card p {
      margin: 8px 0;
      color: #555;
      display: flex;
      align-items: center;
    }

    .commande-card p span {
      margin-right: 8px;
    }

    .pdf-link {
      display: inline-block;
      margin-top: 15px;
      color: #28a745;
      text-decoration: none;
      font-weight: 600;
      padding: 8px 16px;
      background-color: #f8f9fa;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .pdf-link:hover {
      background-color: #28a745;
      color: white;
    }

    .error {
      color: #dc3545;
      font-weight: 600;
      margin-top: 15px;
      display: inline-block;
      padding: 8px 16px;
      background-color: #f8d7da;
      border-radius: 6px;
    }

    /* Responsive design */
    @media (max-width: 1200px) {
      .cards-container {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 18px;
      }
    }

    @media (max-width: 768px) {
      .cards-container {
        grid-template-columns: 1fr;
        gap: 15px;
      }
      
      .commande-card {
        padding: 20px;
      }
      
      .page-title {
        font-size: 1.5em;
        margin-bottom: 20px;
      }
    }

    @media (max-width: 480px) {
      .main-content {
        padding: 10px;
      }
      
      .commande-card {
        padding: 16px;
      }
      
      .page-title {
        font-size: 1.3em;
      }
    }

    /* Animation d'entrée */
    .commande-card {
      animation: fadeInUp 0.6s ease forwards;
      opacity: 0;
      transform: translateY(20px);
    }

    .commande-card:nth-child(1) { animation-delay: 0.1s; }
    .commande-card:nth-child(2) { animation-delay: 0.2s; }
    .commande-card:nth-child(3) { animation-delay: 0.3s; }
    .commande-card:nth-child(4) { animation-delay: 0.4s; }
    .commande-card:nth-child(5) { animation-delay: 0.5s; }
    .commande-card:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Style pour les statistiques rapides */
    .stats-bar {
      background: white;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      text-align: center;
    }

    .stat-item {
      display: inline-block;
      margin: 0 20px;
      color: #007BBD;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .stat-item {
        display: block;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="main-content">
  <h2 class="page-title">📄 Reçus de Commandes Clients</h2>

  <!-- Barre de statistiques -->
  <div class="stats-bar">
    <div class="stat-item">
      📊 Total: <?= count($commandes) ?> commandes
    </div>
    <div class="stat-item">
      💰 CA Total: <?= number_format(array_sum(array_column($commandes, 'prix')), 2) ?> DH
    </div>
  </div>

  <div class="cards-container">
    <?php foreach ($commandes as $commande): ?>
      <div class="commande-card">
        <h3><?= htmlspecialchars($commande['nom']) ?></h3>
        <p><span>🛒</span> Quantité : <?= $commande['quantite'] ?></p>
        <p><span>💰</span> Prix : <?= number_format($commande['prix'], 2) ?> DH</p>
        <p><span>📅</span> Commandé le : <?= date('d/m/Y H:i', strtotime($commande['date_commande'])) ?></p>

        <?php
          $chemin_serveur = __DIR__ . '/factures/' . $commande['pdf'];
          $chemin_url = 'factures/' . $commande['pdf'];

          if (!empty($commande['pdf']) && file_exists($chemin_serveur)) {
              echo '<a href="' . $chemin_url . '" target="_blank" class="pdf-link">📄 Voir le PDF</a>';
          } else {
              echo '<span class="error">PDF introuvable</span>';
          }
        ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>