<?php
session_start();
include '../model/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifiez si l'e-mail existe dans la base de données
    $stmt = $connexion->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Générer un jeton de réinitialisation
        $token = bin2hex(random_bytes(50));
        $stmt = $connexion->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->execute([$token, $email]);

        // Envoyer l'e-mail de réinitialisation
        $resetLink = "http://localhost/gconge/view/reset_password.php?token=" . $token; 
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $resetLink;
        // $headers = "From: noreply@votre-site.com";

        if (mail($email, $subject, $message)) {
            echo "Un e-mail de réinitialisation a été envoyé.";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail.";
        }
    } else {
        echo "Aucun compte trouvé avec cet e-mail.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mot de passe oublié</title>
    <style>
    </style>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    
    <form method="POST">
    <h1>Réinitialiser votre mot de passe</h1>
        <input type="email" name="email" placeholder="Votre email" required>
        <button type="submit">Envoyer un lien de réinitialisation</button>
    </form>
</body>
</html>
