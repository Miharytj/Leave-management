<?php

include_once '../model/function.php';
// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
// session_start();
// if (!isset($_SESSION['id'])) {
//     header("Location: login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        /*  */
    </style>

</head>

<body>

    <div class="sidebar hidden-print">
        <div class="logo-details">
            <!-- <i class="bx bxl-c-plus-plus"></i> -->
            <span class="logo_name">GESTION DE CONGE</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="tableau.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="tableau.php" ? "active" : "" ?> ">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="employe.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="employe.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Employé</span>
                </a>
            </li>
            <li>
                <a href="service.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="service.php" ? "active" : "" ?> ">
                    <i class="bx bx-laptop"></i>
                    <span class="links_name">Service</span>
                </a>
            </li>
            <li>
                <a href="conge.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="conge.php" ? "active" : "" ?> ">
                    <i class="bx bx-calendar-event"></i>
                    <span class="links_name">Congé</span>
                </a>
            </li>
            <li>
                <a href="recherche.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="recherche.php" ? "active" : "" ?> ">
                    <i class="bx bx-search"></i>
                    <span class="links_name">Rechercher</span>
                </a>
            </li>
            
        </ul>
        <div class="nav-links2 t2">
            <li>
                <a href="parametre.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="parametre.php" ? "active" : "" ?> ">
                    <i class="bx bx-cog"></i>
                    <span class="links_name">Paramètres</span>
                </a>
            </li>
        </div>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
            </div>
            
            <div class="profile-details">
                <span class="admin-name" onclick="openModal()"><i class="bx bx-user-circle"></i></a></span>
            </div>
        </nav>
         <!-- Fenêtre modale pour l'icône utilisateur -->
         <div id="userModal" class="modal fade" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Profil utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2><?php echo $_SESSION['username']; ?></h2>
                <a href="changermdp.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-warning btn-block mt-2">Changer le mdp</a>
                <a href="logout.php" class="btn btn-danger btn-block mt-2">Déconnexion</a>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction pour ouvrir la fenêtre modale Bootstrap
        function openModal() {
            var modal = new bootstrap.Modal(document.getElementById('userModal'));
            modal.show();
        }
    </script>
    <script>
        // Remplacer l'historique pour désactiver le bouton retour vers login
        window.history.replaceState(null, null, window.location.href);
    </script>
</body>
</html>