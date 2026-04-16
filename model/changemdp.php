<?php
include 'function.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Récupérer les informations de l'utilisateur
    $user = getadmin($user_id);

    if ($user) {
        // Vérifier si le mot de passe actuel est correct
        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                // Hacher le nouveau mot de passe
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Mettre à jour le mot de passe dans la base de données
                $sql = "UPDATE users SET password = :password WHERE id = :id";
                $stmt = $connexion->prepare($sql);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':id', $user_id);

                if ($stmt->execute()) {
                    $_SESSION['message'] = [
                        'type' => 'success',
                        'text' => 'Mot de passe mis à jour avec succès.'
                    ];
                } else {
                    $_SESSION['message'] = [
                        'type' => 'error',
                        'text' => 'Une erreur est survenue lors de la mise à jour du mot de passe.'
                    ];
                }
            } else {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Le nouveau mot de passe et la confirmation ne correspondent pas.'
                ];
            }
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Le mot de passe actuel est incorrect.'
            ];
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Utilisateur non trouvé.'
        ];
    }

    // Rediriger vers la page de changement de mot de passe avec le message
    header("Location: ../view/changermdp.php");
    exit();
}
?>

