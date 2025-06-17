<?php
$db_host = 'sql7.freesqldatabase.com'; // Remplacez XXX
$db_user = 'sql7785348'; // Remplacez XXX
$db_pass = 'maE9BIbIjp'; // Mettez le vrai mot de passe
$db_name = 'sql7785348'; // Remplacez XXX

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
