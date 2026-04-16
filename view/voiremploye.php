<?php
include 'entete.php';
require_once '../model/function.php';

if (empty($_GET['matre'])) {
    die('Erreur: Aucun ID de congé fourni');
}

$employe = getemploye($_GET['matre']);

if (!$employe) {
    die('Erreur: Congé non trouvé');
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
    <table>
        <tr>
            <th>Matricule</th>
            <td><?= $employe['matricule'] ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?= $employe['nome'] ?></td>
        </tr>
        <tr>
            <th>Prénom(s)</th>
            <td><?= $employe['prenome'] ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= $employe['adre'] ?></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><?= $employe['tel'] ?></td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><?= $employe['mail'] ?></td>
        </tr>
        <tr>
            <th>Date début</th>
            <td><?= $employe['datedebut'] ?></td>
        </tr>
        <tr>
            <th>Solde congé</th>
            <td><?= $employe['soldeconge'] ?></td>
        </tr>
        <tr>
            <th>Date entré du solde</th>
            <td><?= $employe['dateentresolde'] ?></td>
        </tr>
        <tr>
            <th>Nom du sérvice</th>
            <td><?= $employe['nomservice'] ?></td>
        </tr>
        <tr>
            <th><a href="genererpdfemploye.php?matre=<?= $employe['matre'] ?>" style="color: #000;" class="btn btn-success">Télécharger</a></th>
            <td><a href="employe.php" style="color: black;" class="btn btn-warning">Retour</a></td>
        </tr>
    </table>
</div>
</div>
    </div>
<?php include 'enpied.php'; ?>
