<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'vendor/fpdf/fpdf.php';
require_once 'db/connexion.php';

function nettoyerTexte($texte) {
  $remplacements = [
    'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
    'à' => 'a', 'â' => 'a',
    'î' => 'i', 'ï' => 'i',
    'ô' => 'o',
    'ù' => 'u', 'û' => 'u',
    'ç' => 'c',
    'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'À' => 'A',
  ];
  return strtr($texte, $remplacements);
}

if (!isset($_SESSION["user_id"])) {
  echo json_encode(['status' => 'error', 'message' => 'Non connecté']);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !is_array($data)) {
  echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
  exit;
}

$timestamp = time();
$nom_pdf = "commande_" . $timestamp . ".pdf";
$pdf_path = __DIR__ . "/factures/";
$pdf_filename = $pdf_path . $nom_pdf;

if (!is_dir($pdf_path)) {
  mkdir($pdf_path, 0777, true);
}

// Création PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);

// Logo si dispo
$logo_path = __DIR__ . '/images/logoo.png';
if (file_exists($logo_path)) {
  $pdf->Image($logo_path, 10, 10, 30);
}

$pdf->SetXY(50, 10);
$pdf->SetFillColor(0, 123, 189);
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(140, 15, nettoyerTexte("Recu de commande - Mic Mac"), 0, 1, 'C', true);
$pdf->Ln(15);

// En-têtes
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0);
$pdf->SetFillColor(220, 230, 241);
$pdf->Cell(80, 10, nettoyerTexte('Produit'), 1, 0, 'C', true);
$pdf->Cell(30, 10, nettoyerTexte('Quantite'), 1, 0, 'C', true);
$pdf->Cell(40, 10, nettoyerTexte('Prix (DH)'), 1, 0, 'C', true);
$pdf->Cell(40, 10, nettoyerTexte('Total (DH)'), 1, 1, 'C', true);

// Données
$pdf->SetFont('Arial', '', 12);
$total_general = 0;

foreach ($data as $item) {
  $nom = nettoyerTexte($item['nom']);
  $quantite = intval($item['quantite']);
  $prix = floatval($item['prix']);
  $total = $prix * $quantite;
  $total_general += $total;

  // Insertion en base
  $stmt = $pdo->prepare("INSERT INTO commandes (nom, prix, quantite, image, date_commande, pdf) 
                         VALUES (:nom, :prix, :quantite, :image, NOW(), :pdf)");
  $stmt->execute([
    'nom' => $item['nom'],
    'prix' => $prix,
    'quantite' => $quantite,
    'image' => $item['image'],
    'pdf' => $nom_pdf
  ]);

  // Ajout au PDF
  $pdf->Cell(80, 10, $nom, 1);
  $pdf->Cell(30, 10, $quantite, 1, 0, 'C');
  $pdf->Cell(40, 10, number_format($prix, 2), 1, 0, 'R');
  $pdf->Cell(40, 10, number_format($total, 2), 1, 1, 'R');
}

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(150, 10, nettoyerTexte("Total general"), 1, 0, 'R', true);
$pdf->Cell(40, 10, number_format($total_general, 2), 1, 1, 'R');

// Message
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 11);
$pdf->MultiCell(0, 10, nettoyerTexte("Merci pour votre confiance. Pour toute question, contactez Mic Mac."));

$pdf->Output('F', $pdf_filename);

// Réponse JSON
echo json_encode(['status' => 'ok', 'pdf' => "factures/" . $nom_pdf]);
exit;
?>
