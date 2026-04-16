<?php
include 'entete.php';
include '../model/tableaureq.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../public/css/tableau.css">
</head>

<body>
    <script>
        window.history.replaceState(null, null, window.location.href);
    </script>
    <div class="dashboard">
        <div class="stats">
            <div class="stat-item">
                <i class="bx bx-user"></i>
                <h2>Total Employés</h2>
                <p><?php echo $totalEmployes; ?></p>
            </div>
            <div class="stat-item">
                <i class="bx bx-calendar"></i>
                <h2>Total Congés</h2>
                <p><?php echo $totalConges; ?></p>
            </div>
            <div class="stat-item">
                <i class="bx bx-chart"></i>
                <h2>Solde C. moyen</h2>
                <p><?php echo $soldeMoyen; ?></p>
            </div>
        </div>
        <div class="box">
            <table class="recent-leaves">
                <h2>Congés Récents</h2>
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($congesRecents as $conge): ?>
                        <tr>
                            <td><?php echo $conge['nome'] . ' ' . $conge['prenome']; ?></td>
                            <td><?php echo $conge['datedebut']; ?></td>
                            <td><?php echo $conge['datefin']; ?></td>
                            <td><?php echo $conge['qtt']; ?> jours</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="box">
            <h2>Liste des Employés et leurs Congés</h2>
            <table class="employee-leaves">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Solde Congés</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employesConges as $employe): ?>
                        <tr>
                            <td><?php echo $employe['matricule']; ?></td>
                            <td><?php echo $employe['nome']; ?></td>
                            <td><?php echo $employe['prenome']; ?></td>
                            <td><?php echo $employe['soldeconge']; ?> jours</td>
                            <td><?php echo $employe['datedebut'] ? $employe['datedebut'] : 'N/A'; ?></td>
                            <td><?php echo $employe['datefin'] ? $employe['datefin'] : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>