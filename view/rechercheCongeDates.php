<?php
include 'entete.php';

if (isset($_POST['search'])) {
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

    // Requête pour récupérer les congés entre les deux dates
    $queryConges = $connexion->prepare("SELECT tconge.*, temploye.prenome 
                                        FROM tconge 
                                        JOIN temploye ON tconge.matre = temploye.matre 
                                        WHERE tconge.datedebut >= :dateDebut AND tconge.datefin <= :dateFin");
    $queryConges->execute([':dateDebut' => $dateDebut, ':dateFin' => $dateFin]);
    $conges = $queryConges->fetchAll(PDO::FETCH_ASSOC);

    // Inclure le fichier HTML pour afficher les congés
    include 'affichage_conges.php';
} else {
    // Inclure le fichier HTML pour afficher le message d'erreur
    include 'non_trouve.php';
}
?>

