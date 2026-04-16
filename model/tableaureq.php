<?php 
include 'connexion.php';

// Récupérer le nombre total d'employés
$totalEmployesQuery = $connexion->query("SELECT COUNT(*) as total FROM temploye");
$totalEmployes = $totalEmployesQuery->fetch()['total'];

// Récupérer le nombre total de congés
$totalCongesQuery = $connexion->query("SELECT COUNT(*) as total FROM tconge");
$totalConges = $totalCongesQuery->fetch()['total'];

// Récupérer le solde de congés moyen par employé
$soldeMoyenQuery = $connexion->query("SELECT AVG(soldeconge) as solde_moyen FROM temploye");
$soldeMoyen = round($soldeMoyenQuery->fetch()['solde_moyen'], 2);

// Récupérer la liste des congés récents (les 10 derniers)
$congesRecentsQuery = $connexion->query("SELECT tconge.*, temploye.nome, temploye.prenome 
                                   FROM tconge 
                                   JOIN temploye ON tconge.matre = temploye.matre 
                                   ORDER BY tconge.datedebut DESC 
                                   LIMIT 10");
$congesRecents = $congesRecentsQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des employés avec leurs congés triés par date de début
$employesCongesQuery = $connexion->query("SELECT temploye.*, tconge.datedebut, tconge.datefin 
                                    FROM temploye 
                                    LEFT JOIN tconge ON temploye.matre = tconge.matre 
                                    ORDER BY tconge.datedebut DESC");
$employesConges = $employesCongesQuery->fetchAll(PDO::FETCH_ASSOC);
?>