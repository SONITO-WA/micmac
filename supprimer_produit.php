<?php
session_start();
require_once 'db/connexion.php';

// Sécurité
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérification de l'ID
if (!isset($_GET['id'])) {
    die("❌ ID manquant.");
}

$id = intval($_GET['id']);

// Suppression
$stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: produits.php?message=deleted");
    exit();
} else {
    die("❌ Échec de la suppression.");
}
