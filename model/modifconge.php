<?php
include 'connexion.php';// Connexion à la base de données

// Récupérer les données du formulaire
$idconge = $_POST['idconge'];
$matre = $_POST['employe'];
$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];
$idtypec = $_POST['idtypec'];

// Calcul du nombre de jours de congé
$startDate = new DateTime($datedebut);
$endDate = new DateTime($datefin);
$interval = $startDate->diff($endDate);
$joursEffectifs = $interval->days + 1;

// Récupérer les informations du congé existant
$query = $connexion->prepare("SELECT * FROM tconge WHERE idconge = ?");
$query->execute([$idconge]);
$conge = $query->fetch(PDO::FETCH_ASSOC);

// Récupérer le solde de congé de l'employé
$query = $connexion->prepare("SELECT soldeconge FROM temploye WHERE matre = ?");
$query->execute([$matre]);
$employe = $query->fetch(PDO::FETCH_ASSOC);
$soldeConge = $employe['soldeconge'];

// Vérifier si l'employé a suffisamment de congés
if ($soldeConge + $conge['qtt'] < $joursEffectifs) {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Solde de congé insuffisant.'];
    header('Location: ../view/conge.php');
    exit();
}

// Mettre à jour le congé
$query = $connexion->prepare("UPDATE tconge SET matre = ?, datedebut = ?, datefin = ?, qtt = ?, soldeutilise = ?, solderestant = ?, idtypec = ? WHERE idconge = ?");
$query->execute([$matre, $datedebut, $datefin, $joursEffectifs, $joursEffectifs, $soldeConge - $joursEffectifs, $idtypec, $idconge]);

// Mettre à jour le solde de congé de l'employé
$query = $connexion->prepare("UPDATE temploye SET soldeconge = soldeconge + ? - ? WHERE matre = ?");
$query->execute([$conge['qtt'], $joursEffectifs, $matre]);

$_SESSION['message'] = ['type' => 'success', 'text' => 'Congé modifié avec succès.'];
header('Location: ../view/conge.php');
?>
