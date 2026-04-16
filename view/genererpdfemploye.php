<?php
// Démarre la mise en mémoire tampon de sortie
// ob_start(); 
// header('Content-Type: text/html:charset=utf-8mb4');

// Inclure le fichier FPDF
require('../public/fpdf/fpdf.php');
require_once '../model/function.php';

if (empty($_GET['matre'])) {
    die('Erreur: Aucun ID de congé fourni');
}

$employe = getemploye($_GET['matre']);

if (!$employe) {
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
$pdf->Cell(0, 10, utf8_decode('Information sur l`employé'), 0, 1, 'C');

// Ajouter les détails
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Matricule: ' . $employe['matricule'], 0, 1);
$pdf->Cell(0, 10, 'Nom: ' . $employe['nome'], 0, 1);
$pdf->Cell(0, 10, utf8_decode('Prénom(s): ' . $employe['prenome']), 0, 1);
$pdf->Cell(0, 10, 'Adresse: ' . $employe['adre'], 0, 1);
$pdf->Cell(0, 10, utf8_decode('Téléphone: ' . $employe['tel']), 0, 1);
$pdf->Cell(0, 10, 'E-mail: ' . $employe['mail'], 0, 1);
$pdf->Cell(0, 10, utf8_decode('Date début: ' . $employe['datedebut']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Date d`entré du solde: ' . $employe['dateentresolde']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Solde congé: ' . $employe['soldeconge']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Sérvice: ' . $employe['nomservice']), 0, 1);

// Envoyer le PDF au navigateur
$pdf->Output('D', utf8_decode('employe_information.pdf'));
?>
