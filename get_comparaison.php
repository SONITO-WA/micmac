<?php  
require_once 'db/connexion.php';  

$ids = $_POST['ids'] ?? [];
if (count($ids) < 2 || count($ids) > 3) {
    echo "<p style='color:red'>❌ Vous devez sélectionner entre 2 et 3 produits.</p>";
    exit;
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT nom, prix, garantie FROM produits WHERE id IN ($placeholders)");
$stmt->execute($ids);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

$prix_min = min(array_column($produits, 'prix')); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparaison des Produits</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #f0f0f0);
            padding: 40px;
            margin: 0;
        }
        
        h2 {
            text-align: center;
            color: #008fc9;
            margin-bottom: 20px;
        }
        
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ccc;
        }
        
        th {
            background-color: #008fc9;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        .highlight {
            background-color: #fff3cd !important;
            color: #856404;
            font-weight: bold;
        }
        
        .product-name {
            font-weight: bold;
            color: #333;
        }
        
        small {
            color: #666;
            font-size: 0.9em;
        }
        
        .price-delta {
            color: #dc3545;
        }
        
        .btn-retour {
            display: block;
            margin: 30px auto;
            padding: 12px 28px;
            background: #008fc9;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            text-decoration: none;
            text-align: center;
            width: fit-content;
            transition: all 0.3s ease;
        }
        
        .btn-retour:hover {
            background: #006a9a;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<h2>🔍 Comparaison des Produits</h2>

<table>
    <tr>
        <th>Produit</th>
        <th>Prix (MAD)</th>
        <th>Garantie</th>
    </tr>
    <?php foreach ($produits as $p): ?>
        <?php 
        $prix = (float)$p['prix'];
        $highlight = $prix == $prix_min ? "class='highlight'" : "";
        $delta = $prix > $prix_min ? "<br><small class='price-delta'>⬆ Plus cher de " . number_format($prix - $prix_min, 2, '.', ' ') . " MAD</small>" : "";
        ?>
        <tr>
            <td class="product-name"><?= htmlspecialchars($p['nom']) ?></td>
            <td <?= $highlight ?>><?= number_format($prix, 2, '.', ' ') ?> MAD <?= $delta ?></td>
            <td><?= htmlspecialchars($p['garantie']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="comparateur.php" class="btn-retour">← Retour au Comparateur</a>

</body>
</html>