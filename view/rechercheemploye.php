<?php
include 'entete.php';

if (isset($_POST['search'])) {
    $matricule = $_POST['matricule'];

    // Requête pour récupérer les informations de l'employé
    $queryEmploye = $connexion->prepare("SELECT * FROM temploye WHERE matricule = :matricule");
    $queryEmploye->execute([':matricule' => $matricule]);
    $employe = $queryEmploye->fetch(PDO::FETCH_ASSOC);

    if ($employe) {
        // Requête pour récupérer les congés de l'employé
        $queryConges = $connexion->prepare("SELECT tconge.datedebut, tconge.datefin 
                                            FROM tconge 
                                            WHERE tconge.matre = :matre");
        $queryConges->execute([':matre' => $matricule]);
        $conges = $queryConges->fetchAll(PDO::FETCH_ASSOC);

        // Inclure le fichier HTML pour afficher les données
        include 'affichage_employe.php';
    } else {
        // Inclure le fichier HTML pour afficher le message d'erreur
        include 'non_trouve.php';
    }
}
?>
