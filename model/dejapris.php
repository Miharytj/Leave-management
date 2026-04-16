<?php
include 'connexion.php';

$dateDebut = $_GET['dateDebut'];
$dateFin = $_GET['dateFin'];

// Vérifier le nombre de personnes ayant déjà pris un congé sur cette période
$query = $connexion->prepare("SELECT COUNT(DISTINCT matre) FROM tconge WHERE (datedebut <= ? AND datefin >= ?) OR (datedebut <= ? AND datefin >= ?) OR (datedebut >= ? AND datefin <= ?)");
$query->execute([$dateFin, $dateDebut, $dateFin, $dateDebut, $dateDebut, $dateFin]);

echo $query->fetchColumn();
?>
