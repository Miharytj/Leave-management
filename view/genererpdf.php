<?php
// Démarre la mise en mémoire tampon de sortie
// ob_start(); 

// Inclure le fichier FPDF
require('../public/fpdf/fpdf.php');
require_once '../model/function.php';
// require_once '../view/conge.php';

if (empty($_GET['idconge'])) {
    die('Erreur: Aucun ID de congé fourni');
}

$conge = getconge($_GET['idconge']);

if (!$conge) {
    die('Erreur: Congé non trouvé');
}
// if (!empty($_GET['idconge'])) {
//     $conge = getconge($_GET['idconge']);
// }

// Création du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Ajouter un titre
$pdf->Cell(0, 10, utf8_decode('Détails du Congé'), 0, 1, 'C');

// Ajouter les détails
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Prénom(s): ' . $conge['prenome']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Date début: ' . $conge['datedebut']), 0, 1);
$pdf->Cell(0, 10, 'Date fin: ' . $conge['datefin'], 0, 1);
$pdf->Cell(0, 10, utf8_decode('Quantité: ' . $conge['qtt']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Utilisé: ' . $conge['soldeutilise']), 0, 1);
$pdf->Cell(0, 10, 'Restant: ' . $conge['solderestant'], 0, 1);
$pdf->Cell(0, 10, utf8_decode('Type de congé: ' . $conge['nomtype']), 0, 1);

// Envoyer le PDF au navigateur
$pdf->Output('D', utf8_decode('congé_détails.pdf'));
?>
