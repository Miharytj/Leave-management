<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm']);

    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            // Vérifiez si le nom d'utilisateur est déjà pris
            $stmt = $connexion->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = "Ce nom d'utilisateur est déjà pris.";
            } else {
                // Enregistrez l'utilisateur
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $connexion->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                if ($stmt->execute([$username, $email, $hashed_password])) {
                    header("Location: ../view/admin.php");
                    exit();
                } else {
                    $error = "Erreur lors de l'enregistrement.";
                }
            }
        } else {
            $error = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}