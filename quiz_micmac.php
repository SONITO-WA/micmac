<?php
session_start();
require_once 'db/connexion.php';

if (!isset($_SESSION['username']) || !isset($_GET['niveau'])) {
    header("Location: quizaa.php");
    exit();
}

$pseudo = $_SESSION['username'];
$niveau = $_GET['niveau'];

// Charger 25 questions fixes
$stmt = $pdo->prepare("SELECT * FROM questions WHERE niveau = ? ORDER BY id ASC LIMIT 25");
$stmt->execute([$niveau]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<script>const questions = " . json_encode($questions) . ";</script>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Quiz - Niveau <?= htmlspecialchars($niveau) ?></title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f4f8;
      text-align: center;
      padding: 40px;
    }
    .quiz-container {
      background-color: white;
      max-width: 700px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .question {
      font-size: 1.3em;
      margin-bottom: 20px;
    }
    .answers button {
      display: block;
      width: 100%;
      margin: 10px 0;
      padding: 12px;
      font-size: 1em;
      border: none;
      background-color: #007BBD;
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }
    .answers button:hover {
      background-color: #005999;
    }
    #score {
      font-size: 1.2em;
      color: green;
      font-weight: bold;
      margin-bottom: 20px;
    }
    #timer {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <div class="quiz-container">
    <h2>👤 Joueur : <?= htmlspecialchars($pseudo) ?> — Mode : <?= htmlspecialchars($niveau) ?></h2>
    <div id="score">Score : 0</div>
    <div id="timer">Temps : <span id="time">15</span>s</div>
    <div id="question-box"></div>
  </div>

  <script>
    let current = 0;
    let score = 0;
    let time = 15;
    let timer;

    function updateScore() {
      document.getElementById("score").textContent = "Score : " + score;
    }

    function showQuestion() {
      if (current >= questions.length) {
        window.location.href = "resultat.php?score=" + score + "&niveau=<?= $niveau ?>";
        return;
      }

      const q = questions[current];
      document.getElementById("question-box").innerHTML = `
        <div class="question">${q.question}</div>
        <div class="answers">
          <button onclick="checkAnswer(1)">${q.reponse1}</button>
          <button onclick="checkAnswer(2)">${q.reponse2}</button>
          <button onclick="checkAnswer(3)">${q.reponse3}</button>
          <button onclick="checkAnswer(4)">${q.reponse4}</button>
        </div>
      `;

      time = 15;
      document.getElementById("time").textContent = time;
      clearInterval(timer);
      timer = setInterval(() => {
        time--;
        document.getElementById("time").textContent = time;
        if (time <= 0) {
          clearInterval(timer);
          endGame();
        }
      }, 1000);
    }

    function checkAnswer(choice) {
      if (choice === questions[current].bonne_reponse) {
        score++;
        updateScore();
        current++;
        clearInterval(timer);
        showQuestion();
      } else {
        endGame();
      }
    }

    function endGame() {
      window.location.href = "resultat.php?score=" + score + "&niveau=<?= $niveau ?>";
    }

    updateScore();
    showQuestion();
  </script>

</body>
</html>