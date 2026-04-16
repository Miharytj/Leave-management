<?php
include 'connexion.php';

$matre = $_GET['matre'];
$dateDebut = $_GET['dateDebut'];

$moisDebut = date('Y-m', strtotime($dateDebut));

// Vérifier si l'employé a déjà pris un congé dans le même mois
$query = $connexion->prepare("SELECT COUNT(*) FROM tconge WHERE matre = ? AND DATE_FORMAT(datedebut, '%Y-%m') = ?");
$query->execute([$matre, $moisDebut]);

if ($query->fetchColumn() > 0) {
    echo "true";
} else {
    echo "false";
}
?>
