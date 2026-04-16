<?php
include 'entete.php';
require_once '../model/function.php';
// require_once '../view/conge.php';

if (empty($_GET['idconge'])) {
    die('Erreur: Aucun ID de congé fourni');
}

$conge = getconge($_GET['idconge']);

if (!$conge) {
    die('Erreur: Congé non trouvé');
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
    <table>
        <tr>
            <th>Prénom(s)</th>
            <td><?= $conge['prenome'] ?></td>
        </tr>
        <tr>
            <th>Date début</th>
            <td><?= $conge['datedebut'] ?></td>
        </tr>
        <tr>
            <th>Date fin</th>
            <td><?= $conge['datefin'] ?></td>
        </tr>
        <tr>
            <th>Quantité</th>
            <td><?= $conge['qtt'] ?></td>
        </tr>
        <tr>
            <th>Utilisé</th>
            <td><?= $conge['soldeutilise'] ?></td>
        </tr>
        <tr>
            <th>Restant</th>
            <td><?= $conge['solderestant'] ?></td>
        </tr>
        <tr>
            <th>Type de congé</th>
            <td><?= $conge['nomtype'] ?></td>
        </tr>
        <tr>
            <th><a href="genererpdf.php?idconge=<?= $conge['idconge'] ?>" style="color: #000;" class="btn btn-success">Télécharger</a></th>
            <td><a href="conge.php" style="color: black;" class="btn btn-warning">Retour</a></td>
        </tr>
    </table>
</div>
</div>
    </div>
<?php include 'enpied.php'; ?>
