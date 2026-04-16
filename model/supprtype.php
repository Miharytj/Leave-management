<?php
include 'connexion.php';
if (!empty($_GET['idtypec'])) {
    $typec = $_GET['idtypec'];

    // Préparer et exécuter la requête de suppression
    $query = $connexion->prepare("DELETE FROM ttypec WHERE idtypec = ?");
    $query->execute([$typec]);

    // Vérifiez si l'employé a été supprimé avec succès
    if ($query->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Employé supprimé avec succès.'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la suppression de l\'employé.'];
    }
} else {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Identifiant d\'employé manquant.'];
}
header('Location: ../view/typeconge.php');