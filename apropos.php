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
  <title>À propos - Mic Mac Informatique</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      AOS.init();
    });
  </script>
</head>
<body>
<?php include 'includes/header.php'; ?>


<!-- Bannière À propos -->
<section class="apropos-banner">
  <h1 data-aos="fade-up">Votre partenaire de confiance pour des réseaux fiables et sécurisés</h1>
  <p data-aos="fade-right">Expertise locale — Technologies éprouvées — Accompagnement sur mesure</p>
</section>

<!-- Contenu À propos -->
<section class="apropos">
  <div class="apropos-container">
    <img src="images/logoo.png" alt="Logo MICMAC" class="apropos-logo" style="width:120px; margin-bottom: 20px;">
    <h1 data-aos="fade-up">Présentation de l'entreprise MICMAC</h1>

    <h2>Histoire et positionnement</h2>
    <p data-aos="fade-right">
      Fondée en 1998, MICMAC a pour ambition de devenir un leader dans le secteur des réseaux informatiques.
      Au fil des ans, l'entreprise a su évoluer pour répondre à la demande croissante en matière de connectivité
      et de sécurité des systèmes d'information. Aujourd'hui, MICMAC est reconnue pour son expertise dans la
      conception, l'installation, et la maintenance des infrastructures réseau.
    </p>

    <h2>Services proposés</h2>
    <ul>
      <li>Fourniture de matériel informatique : ordinateurs, composants réseau adaptés aux besoins spécifiques</li>
      <li>Maintenance des équipements informatiques : entretien et réparation pour un fonctionnement optimal</li>
      <li>Installation de câblage réseau : infrastructure physique fiable et performante</li>
      <li>Conception de solutions réseau : sur mesure pour entreprises et organisations</li>
      <li>Maintenance et support technique : assistance continue pour garantir la performance</li>
      <li>Sécurisation des réseaux : solutions de protection contre les menaces internes et externes</li>
    </ul>

    <h2>Équipe et expertise</h2>
    <p data-aos="fade-right">
      L'équipe de MICMAC se compose d'un ingénieur en réseaux informatiques et de quatre experts spécialisés dans
      divers domaines. L'ingénieur conçoit et gère les projets complexes, assurant des solutions innovantes et fiables.
      Les experts couvrent l'architecture réseau, la sécurité informatique, la maintenance et l’optimisation des performances.
    </p>
  </div>
</section>


<?php include 'includes/footer.php'; ?>


</body>
</html>
