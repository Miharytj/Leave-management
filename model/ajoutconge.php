<?php
include 'connexion.php';

// Récupérer les données du formulaire
$matre = $_POST['employe'];
$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];
$idtypec = $_POST['idtypec'];
$soldeutilise = $_POST['soldeutilise'];
$qtt = $_POST['qtt'];
$solderestant = $_POST['solderestant'];

// Convertir les valeurs en float pour les calculs
$soldeutilise = (float) $soldeutilise;
$qtt = (float) $qtt;
$solderestant = (float) $solderestant;

// Récupérer le solde de congé de l'employé
$query = $connexion->prepare("SELECT soldeconge FROM temploye WHERE matre = ?");
$query->execute([$matre]);
$employe = $query->fetch(PDO::FETCH_ASSOC);
$soldeConge = (float) $employe['soldeconge'];

// Vérifier que la durée du congé ne dépasse pas 15 jours
if ($qtt > 15) {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Impossible d\'avoir un congé de plus de 15 jours.'];
    header('Location: ../view/conge.php');
    exit();
}

// Vérifier si l'employé a suffisamment de congés
if ($soldeConge < $soldeutilise) {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Solde de congé insuffisant.'];
    header('Location: ../view/conge.php');
    exit();
}

// Insérer le congé
$soldeRestant = $soldeConge - $soldeutilise;
$query = $connexion->prepare("INSERT INTO tconge (matre, datedebut, datefin, qtt, soldeutilise, solderestant, idtypec) VALUES (?, ?, ?, ?, ?, ?, ?)");
$query->execute([$matre, $datedebut, $datefin, $qtt, $soldeutilise, $soldeRestant, $idtypec]);

// Mettre à jour le solde de congé de l'employé
$query = $connexion->prepare("UPDATE temploye SET soldeconge=? WHERE matre = ?");
$query->execute([$solderestant, $matre]);

$_SESSION['message'] = ['type' => 'success', 'text' => 'Congé ajouté avec succès.'];
header('Location: ../view/conge.php');
?>
