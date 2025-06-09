<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !is_numeric($data['id'])) {
  echo json_encode(['status' => 'error', 'message' => 'ID produit invalide']);
  exit;
}

$id = intval($data['id']);

if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
}

if (isset($_SESSION['panier'][$id])) {
  $_SESSION['panier'][$id]++;
} else {
  $_SESSION['panier'][$id] = 1;
}

echo json_encode(['status' => 'ok', 'panier' => $_SESSION['panier']]);
?>
