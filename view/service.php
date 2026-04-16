<?php
include 'entete.php';

if (!empty($_GET['idservice'])) {
    $service = getservice($_GET['idservice']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['idservice']) ?  "../model/modifservice.php" : "../model/ajoutservice.php" ?>" method="post">
                <input value="<?= !empty($_GET['idservice']) ?  $service['nomservice'] : "" ?>" type="text" name="nomservice" id="nomservice" placeholder="Veuillez saisir le nom de la service">

                <input value="<?= !empty($_GET['idservice']) ?  $service['idservice'] : "" ?>" type="hidden" name="idservice" id="idservice" >
                
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
                    <th>Nom service</th>
                    <th>Action</th>
                </tr>
                <?php
                $services = getservice();

                if (!empty($services) && is_array($services)) {
                    foreach ($services as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nomservice'] ?></td>
                            <td><a href="?idservice=<?= $value['idservice'] ?>"><i class='bx bx-edit'></i></a>
                            <a href="../model/supprservice.php?idservice=<?= $value['idservice']?>" style="color: red;"><i class='bx bx-trash'></i></a>
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