<?php
include 'connexion.php';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $query = $connexion->prepare("DELETE FROM users WHERE id = ?");
    $query->execute([$id]);

    // Vérifiez si l'employé a été supprimé avec succès
    if ($query->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Employé supprimé avec succès.'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la suppression de l\'employé.'];
    }
} else {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Identifiant d\'employé manquant.'];
}
header('Location: ../view/admin.php');