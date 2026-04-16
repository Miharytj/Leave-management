<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $admin = getadmin($_GET['id']);
}
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer mon mot de passe</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
        <form action="../model/changemdp.php" method="post">
            <label for="current_password">Mot de passe actuel :</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit">Changer</button>

            <!-- Afficher un message si présent -->
        <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['message']['type'] ?>">
                <?= $_SESSION['message']['text'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        </form>
    </div>
    </div>

</div>
</body>

</html>
