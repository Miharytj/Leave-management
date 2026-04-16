<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Employé</title>
    <link rel="stylesheet" href="../public/css/recherche.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="cont">
    <div class="employe-info">
        <h2>Informations de l'employé</h2>
        <p><strong>Matricule :</strong> <?= htmlspecialchars($employe['matricule']) ?></p>
        <p><strong>Nom :</strong> <?= htmlspecialchars($employe['nome']) ?></p>
        <p><strong>Prénom(s) :</strong> <?= htmlspecialchars($employe['prenome']) ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($employe['adre']) ?></p>
        <p><strong>E-mail :</strong> <?= htmlspecialchars($employe['mail']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($employe['tel']) ?></p>
        <p><strong>Solde de congé restant :</strong> <?= htmlspecialchars($employe['soldeconge']) ?> jours</p>
    </div>

    <div class="conges-liste">
        <h2>Liste des congés</h2>
        <?php if (!empty($conges)) { ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Prénom(s)</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Congé utilisé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conges as $conge) { ?>
                        <tr>
                            <td><?= htmlspecialchars($conge['matre']) ?></td>
                            <td><?= htmlspecialchars($conge['datedebut']) ?></td>
                            <td><?= htmlspecialchars($conge['datefin']) ?></td>
                            <td><?= htmlspecialchars($conge['soldeutilise']) ?> jours</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun congé trouvé pour cet employé.</p>
        <?php } ?>
    </div>
    </div>
</body>
</html>