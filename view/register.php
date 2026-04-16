<?php
// require_once('../model/connexion.php');
session_start();
include '../model/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

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
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Erreur lors de l'enregistrement.";
                }
            }
        } else {
            // $error = "Les mots de passe ne correspondent pas.";
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Les mots de passe ne correspondent pas.'
            ];
        }
    } else {
        // $error = "Veuillez remplir tous les champs.";
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Veuillez remplir tous les champs.'
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
    </style>
<link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
    <h1>Insciption</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'enregistrer</button>
        <div class="register">
                <p>J'ai déjà un compte <a href="login.php">Login</a></p>
            </div>
            <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['message']['type'] ?>">
                <?= $_SESSION['message']['text'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </form>
</body>
</html>
