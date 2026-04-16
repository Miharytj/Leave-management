<?php
session_start();
include '../model/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Vérifiez si le jeton est valide
    $stmt = $connexion->prepare("SELECT * FROM users WHERE reset_token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Mettre à jour le mot de passe et effacer le jeton
        $stmt = $connexion->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
        if ($stmt->execute([$new_password, $token])) {
            echo "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            echo "Erreur lors de la réinitialisation du mot de passe.";
        }
    } else {
        echo "Lien de réinitialisation invalide.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <form method="POST">
        <h1>Réinitialiser votre mot de passe</h1>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
</body>
</html>
