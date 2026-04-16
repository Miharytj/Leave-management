<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des congés</title>
    <link rel="stylesheet" href="../public/css/recherche.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="cont">
    <div class="conges-liste">
        <h2>Liste des congés entre <?= htmlspecialchars($dateDebut) ?> et <?= htmlspecialchars($dateFin) ?></h2>
        <?php if (!empty($conges)) { ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Total du congé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conges as $conge) { ?>
                        <tr>
                            <td><?= htmlspecialchars($conge['prenome']) ?></td>
                            <td><?= htmlspecialchars($conge['datedebut']) ?></td>
                            <td><?= htmlspecialchars($conge['datefin']) ?></td>
                            <td><?= htmlspecialchars($conge['soldeutilise']) ?> jours</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun congé trouvé pour cette période.</p>
        <?php } ?>
    </div>
    </div>
</body>
</html>

