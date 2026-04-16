<?php
include 'connexion.php';

// Vérifier si l'idconge est passé dans l'URL
if (isset($_GET['idconge'])) {
    $idconge = $_GET['idconge'];

    // Récupérer les informations du congé à annuler
    $query = $connexion->prepare("SELECT * FROM tconge WHERE idconge = ?");
    $query->execute([$idconge]);
    $conge = $query->fetch(PDO::FETCH_ASSOC);

    if ($conge) {
        $matre = $conge['matre'];
        $qtt = $conge['qtt'];
        // $solderestant = $conge['solderestant'];

        // Restaurer le solde de congé de l'employé
        $query = $connexion->prepare("UPDATE temploye SET soldeconge = soldeconge + ? WHERE matre = ?");
        $query->execute([$qtt, $matre]);

        // Supprimer le congé
        $query = $connexion->prepare("DELETE FROM tconge WHERE idconge = ?");
        $query->execute([$idconge]);

        $_SESSION['message'] = ['type' => 'success', 'text' => 'Congé annulé avec succès.'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Le congé spécifié n\'existe pas.'];
    }

    // Rediriger vers la page de gestion des congés
    header('Location: ../view/conge.php');
    exit();
} else {
    $_SESSION['message'] = ['type' => 'error', 'text' => 'Aucun identifiant de congé spécifié.'];
    header('Location: ../view/conge.php');
    exit();
}
?>
