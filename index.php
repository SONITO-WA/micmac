<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mic Mac Informatique</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Styles -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>
<section class="hero">
  <div class="hero-content">
    <h1><span class="highlight">Votre Partenaire</span> en <span class="highlight">Informatique</span><br> et Technologies Numériques</h1>
<p class="subtitle">MicMac Informatique propose des services sur mesure, allant du conseil à la maintenance, en passant par la vente de matériel et l’installation de réseaux.</p>

    
    <a class="btn-video" onclick="openModal()">▶ Voir la vidéo</a>
  </div>

  <div class="hero-images">
    <img src="images/micmaca.jpg" alt="Portrait 1" class="hero-img" loading="lazy" style="max-width: 100%; height: auto;">

  </div>
</section>

<!-- Modal vidéo -->
<div id="videoModal" class="modal">w
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <video id="promoVideo" controls autoplay>
      <source src="images/intro_micmac.mp4" type="video/mp4">
      Votre navigateur ne supporte pas la lecture vidéo.
    </video>
  </div>
</div>

<!-- JavaScript modal -->
<script>
  function openModal() {
    document.getElementById("videoModal").style.display = "flex";
    document.getElementById("promoVideo").play();
  }

  function closeModal() {
    document.getElementById("videoModal").style.display = "none";
    document.getElementById("promoVideo").pause();
  }

  window.onclick = function(event) {
    const modal = document.getElementById("videoModal");
    if (event.target === modal) {
      closeModal();
    }
  }
</script>



<script>
  const count = JSON.parse(localStorage.getItem("panier") || "[]").length;
  document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("cart-count").textContent = count;
  });
</script>


<section class="service-intro">
  <h2 class="text-3xl font-bold text-center md:text-4xl animate__animated animate__fadeInUp">
    Des services qui font toute la différence
  </h2>
  <p class="text-center text-slate-500 md:text-lg animate__animated animate__fadeInUp animate__delay-1s">
    Chez nous, l'excellence ne s'arrête pas à la qualité de nos produits. Nous avons à cœur de vous offrir une expérience client incomparable, enrichie par une gamme de services pensés pour votre confort et votre satisfaction.
  </p>
</section>

<section class="services-section py-20">
  <div class="service-wrapper">
    <div class="service-box animate__animated animate__fadeInUp animate__delay-1s">
      <img src="https://cdn-icons-png.flaticon.com/512/2569/2569124.png" alt="Assemblage">
      <h3>Assemblage</h3>
      <p>Montage soigné de machines informatiques avec rigueur technique et rapidité.</p>
    </div>
    <div class="service-box animate__animated animate__fadeInUp animate__delay-2s">
      <img src="https://cdn-icons-png.flaticon.com/512/1087/1087815.png" alt="Conseil">
      <h3>Conseil</h3>
      <p>Accompagnement dans le choix des équipements et des solutions adaptées à votre activité.</p>
    </div>
    <div class="service-box animate__animated animate__fadeInUp animate__delay-3s">
      <img src="https://cdn-icons-png.flaticon.com/512/6336/6336437.png" alt="Réseau">
      <h3>Installation Réseau</h3>
      <p>Conception et mise en œuvre d’infrastructures réseau fiables et sécurisées.</p>
    </div>
  </div>
</section>




<!-- Atiknologia -->

<section class="section-securite">
  <div class="contenu-securite-jaw">
    <a href="categorie.php?type=Cameras" class="icon-card glowing-circle">
       <i class="fas fa-laptop"></i>
    
    </a>

    <div class="texte-jaw">
      <h2><span>Protégez vos locaux</span><br><strong>avec Mic Mac Sécurité</strong></h2>
      <a href="categorie.php?type=Cameras" class="cta-jaw">COMMENCER <span>→</span></a>
    </div>

    <a href="categorie.php?type=Ordinateurs" class="icon-card laptop-card">
       <i class="fas fa-video"></i>
    </a>
  </div>
</section>






<!-- nwamr u lealam -->


<section style="text-align: center; padding: 60px 20px; background-color: #f8f9fa; font-family: 'Poppins', sans-serif;">
  <h2 style="font-size: 2.5em; color: #1f2a37; margin-bottom: 20px;">POURQUOI CHOISIR MIC MAC ?</h2>
  <p style="max-width: 900px; margin: 0 auto 40px; font-size: 1.1em; line-height: 1.8; color: #333;">
    Chez notre société Mic Mac, fondée en 1998, nous nous engageons à fournir des solutions informatiques et des services réseau 
    qui allient performance, fiabilité et accessibilité. Grâce à notre expertise accumulée depuis plus de deux décennies, 
    nous avons su gagner la confiance de nombreux clients en leur offrant un accompagnement personnalisé, des produits de qualité 
    et une assistance technique réactive. Que vous soyez un professionnel ou un particulier, notre équipe vous aide à concrétiser 
    vos projets numériques avec efficacité et innovation.
  </p>

  <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 50px;">
    <div>
      <div class="number" data-target="27" style="font-size: 3em; font-weight: bold; color: #1f2a37;">+0</div>
      <p style="margin-top: 10px; color: #666;">Années d’expérience</p>
    </div>
    <div>
      <div class="number" data-target="40" style="font-size: 3em; font-weight: bold; color: #1f2a37;">+0</div>
      <p style="margin-top: 10px; color: #666;">Partenaires & Fournisseurs</p>
    </div>
    <div>
      <div class="number" data-target="300" style="font-size: 3em; font-weight: bold; color: #1f2a37;">+0</div>
      <p style="margin-top: 10px; color: #666;">Clients satisfaits</p>
    </div>
    <div>
      <div class="number" data-target="500" style="font-size: 3em; font-weight: bold; color: #1f2a37;">+0</div>
      <p style="margin-top: 10px; color: #666;">Produits référencés</p>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const counters = document.querySelectorAll('.number');
      counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        let count = 0;
        const step = Math.max(1, target / 200);
        const update = () => {
          if (count < target) {
            count = Math.ceil(count + step);
            counter.innerText = '+' + count;
            setTimeout(update, 10);
          } else {
            counter.innerText = '+' + target;
          }
        };
        update();
      });
    });
  </script>
</section>



<!-- catalogue dservices -->


<section style="padding: 60px 20px; font-family: 'Poppins', sans-serif; background-color: #ffffff;">
  <!-- Titre décoratif -->
  <div style="text-align: center; margin-bottom: 10px; font-size: 0.9em; color: #222;">
    <span style="color: #2453ff;">—</span>
    <span style="margin: 0 8px; color: #2453ff;">●</span>
    <span style="color: #1f2a37;">Services</span>
    <span style="margin: 0 8px; color: #2453ff;">●</span>
    <span style="color: #2453ff;">—</span>
  </div>
  <h2 style="text-align: center; font-size: 2.5em; color: #1f2a37; margin-bottom: 40px;">Ce Que Nous Avons À Offrir</h2>

  <!-- Slider -->
  <div class="slider" style="position: relative; overflow: hidden; max-width: 1100px; margin: auto;">
    <div class="slides" style="display: flex; transition: transform 0.5s ease;">
      <!-- Slide 1 -->
      <div class="slide" style="min-width: 100%; display: flex; align-items: center; justify-content: space-around;">
        <img src="images/reseau.jpg" alt="Réseau" style="width: 25%; border-radius: 8px;">
        <div style="max-width: 500px;">
          <h3 style="color: #1f2a37;">Installation du Réseau</h3>
          <p>Créez une infrastructure réseau robuste et évolutive adaptée aux besoins de votre entreprise.</p>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="slide" style="min-width: 100%; display: flex; align-items: center; justify-content: space-around;">
        <img src="images/maintenance.jpg" alt="Maintenance" style="width: 40%; border-radius: 8px;">
        <div style="max-width: 500px;">
          <h3 style="color: #1f2a37;">Maintenance Informatique</h3>
          <p>Assurez la longévité de vos équipements grâce à notre maintenance préventive et corrective.</p>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="slide" style="min-width: 100%; display: flex; align-items: center; justify-content: space-around;">
        <img src="images/sl3a.jpg" alt="Vente" style="width: 40%; border-radius: 8px;">
        <div style="max-width: 500px;">
          <h3 style="color: #1f2a37;">Vente de Matériel</h3>
          <p>Ordinateurs, imprimantes, composants : tout le nécessaire pour les particuliers et les pros.</p>
        </div>
      </div>

      <!-- Slide 4 -->
      <div class="slide" style="min-width: 100%; display: flex; align-items: center; justify-content: space-around;">
        <img src="images/Camera.jpg"Surveillance" style="width: 40%; border-radius: 8px;">
        <div style="max-width: 500px;">
          <h3 style="color: #1f2a37;">Systèmes de Surveillance</h3>
          <p>Installez des caméras de sécurité fiables pour protéger vos locaux 24h/24.</p>
        </div>
      </div>

      <!-- Slide 5 -->
      <div class="slide" style="min-width: 100%; display: flex; align-items: center; justify-content: space-around;">
        <img src="images/assistance.jpg" alt="Formation" style="width: 40%; border-radius: 8px;">
        <div style="max-width: 500px;">
          <h3 style="color: #1f2a37;">Formations & Assistance</h3>
          <p>Nous accompagnons vos équipes avec des formations pratiques et un support personnalisé.</p>
        </div>
      </div>
    </div>

    <!-- Flèches -->
    <button onclick="prevSlide()" style="position: absolute; top: 45%; left: 10px; background: white; border: none; font-size: 2em; cursor: pointer; border-radius: 50%; padding: 5px; color: #2453ff;">❮</button>
    <button onclick="nextSlide()" style="position: absolute; top: 45%; right: 10px; background: white; border: none; font-size: 2em; cursor: pointer; border-radius: 50%; padding: 5px; color: #2453ff;">❯</button>

    <!-- Points -->
    <div id="dots" style="text-align: center; margin-top: 30px;">
      <span class="dot" style="height: 12px; width: 12px; margin: 0 5px; background-color: #999; border-radius: 50%; display: inline-block;"></span>
      <span class="dot" style="height: 12px; width: 12px; margin: 0 5px; background-color: #999; border-radius: 50%; display: inline-block;"></span>
      <span class="dot" style="height: 12px; width: 12px; margin: 0 5px; background-color: #999; border-radius: 50%; display: inline-block;"></span>
      <span class="dot" style="height: 12px; width: 12px; margin: 0 5px; background-color: #999; border-radius: 50%; display: inline-block;"></span>
      <span class="dot" style="height: 12px; width: 12px; margin: 0 5px; background-color: #999; border-radius: 50%; display: inline-block;"></span>
    </div>
  </div>

  <script>
    let currentSlide = 0;
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;
    const dots = document.querySelectorAll('.dot');

    function updateSlide() {
      slides.style.transform = `translateX(-${currentSlide * 100}%)`;
      dots.forEach((dot, index) => {
        dot.style.backgroundColor = index === currentSlide ? '#2453ff' : '#999';
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % totalSlides;
      updateSlide();
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      updateSlide();
    }

    // Autoplay
    setInterval(() => {
      nextSlide();
    }, 5000); // 5 secondes

    // Initial setup
    updateSlide();
  </script>
</section>


<!-- Carte Google Maps définitive avec localisation "53FF+QF Nador" -->
<div style="width:100%; padding:20px; text-align:center; background-color:#f8f8f8;">
  <iframe
    src="https://maps.google.com/maps?q=53FF%2BQF%20Nador&z=17&output=embed"
    width="80%" height="250"
    style="border:0; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.3);"
    allowfullscreen="" loading="lazy">
  </iframe>
</div>
<?php include 'includes/footer.php'; ?>

</body>
</html>
