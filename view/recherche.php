<?php 
include 'entete.php';

?>
<body>
<div class="boxs">
<div class="search-container">
    <!-- Recherche Employé -->
    <div class="search-box">
        <form method="POST" action="rechercheemploye.php">
            <label for="matricule">Recherche employé :</label>
            <input type="text" id="matricule" name="matricule" placeholder="Matricule" required>
            <button type="submit" name="search">
                <i class='bx bx-search'></i>
            </button>
        </form>
    </div>
    <div class="search-container">
    <!-- Recherche Congés entre deux dates -->
    <div class="search-box">
        <form method="POST" action="rechercheCongeDates.php">
            <label for="dateDebut">Rechercher des congés entre deux dates :</label>
            <input type="date" id="dateDebut" name="dateDebut" required>
            <input type="date" id="dateFin" name="dateFin" required>
            <button type="submit" name="search">
                <i class='bx bx-search'></i> 
            </button>
        </form>
    </div>
</div>

</div>
</div>
</body>