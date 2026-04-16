<?php
include 'connexion.php';
if (!empty($_GET['matre'])) {
    $matre = $_GET['matre'];

    // Préparer et exécuter la requête de suppression
    $query = $connexion->prepare("DELETE FROM temploye WHERE matre = ?");
    $query->execute([$matre]);

    // Vérifiez si l'employé a été supprimé avec succès
    if ($query->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Employé supprimé avec succès.'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la suppression de l\'employé.'];
    }
} else {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Identifiant d\'employé manquant.'];
}
header('Location: ../view/employe.php');