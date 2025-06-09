<?php
$db_host = 'sql5.freesqldatabase.com'; // Remplacez XXX
$db_user = 'sql5783678'; // Remplacez XXX
$db_pass = 'CRqxD4JLrA'; // Mettez le vrai mot de passe
$db_name = 'sql5783678'; // Remplacez XXX

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>