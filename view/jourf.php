<?php
include 'entete.php';
if (!empty($_GET['idjourf'])) {
    $jourf = getjourferie($_GET['idjourf']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['idjourf']) ?  "../model/modifjourf.php" : "../model/ajoutjourf.php" ?>" method="post">
                <input value="<?= !empty($_GET['idjourf']) ?  $jourf['datejourf'] : "" ?>" type="date" name="datejourf" id="datejourf" placeholder="Veuillez saisir la date du jour ferie">

                <input value="<?= !empty($_GET['idjourf']) ?  $jourf['nomjourf'] : "" ?>" type="text" name="nomjourf" id="nomjourf" placeholder="Veuillez saisir le nom du jour ferie">

                <input value="<?= !empty($_GET['idjourf']) ?  $jourf['idjourf'] : "" ?>" type="hidden" name="idjourf" id="idjourf" >
                
                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>

        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Date jour ferie</th>
                    <th>Nom jour ferie</th>
                    <th>Action</th>
                </tr>
                <?php
                $jourfe = getjourferie();

                if (!empty($jourfe) && is_array($jourfe)) {
                    foreach ($jourfe as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['datejourf'] ?></td>
                            <td><?= $value['nomjourf'] ?></td>
                            <td><a href="?idjourf=<?= $value['idjourf'] ?>"><i class='bx bx-edit'></i></a>
                            <a href="../model/supprjourf.php?idjourf=<?= $value['idjourf']?>" style="color: red;"><i class='bx bx-trash'></i></a>
</td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
        </div>
    </div>

</div>
</section>

<?php
include 'enpied.php';
?>