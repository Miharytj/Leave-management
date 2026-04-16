<?php
session_start();
include '../model/connexion.php';

// Si l'utilisateur est déjà connecté, rediriger vers la page tableau
if (isset($_SESSION['id'])) {
    header("Location: tableau.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Vérifiez si l'utilisateur existe
        $stmt = $connexion->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: tableau.php");
            exit();
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Nom d`utilisateur ou mot de passe incorrect.'
            ];
        }
    } else {
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
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <h1>Connexion</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
        <div class="register">
            <p>Je n'ai pas de compte <a href="register.php">Inscription</a></p>
            <p><a href="forgot_password.php">Mot de passe oublié ?</a></p>
        </div>

        <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['message']['type'] ?>">
                <?= $_SESSION['message']['text'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
    </form>
    <script>
        history.pushState(null,null,'login.php');
        window.onpopstate=function(){window.location.replace('login.php');};
    </script>
</body>
</html>
