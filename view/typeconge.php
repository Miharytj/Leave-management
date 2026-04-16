<?php
include 'entete.php';

if (!empty($_GET['idtypec'])) {
    $typec = gettypeconge($_GET['idtypec']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['idtypec']) ?  "../model/modiftypeconge.php" : "../model/ajouttypeconge.php" ?>" method="post">
                <input value="<?= !empty($_GET['idtypec']) ?  $typec['nomtype'] : "" ?>" type="text" name="nomtype" id="nomtype" placeholder="Veuillez saisir le nom de la congé">

                <input value="<?= !empty($_GET['idtypec']) ?  $typec['idtypec'] : "" ?>" type="hidden" name="idtypec" id="idtypec" >
                
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
                    <th>Type de congé</th>
                    <th>Action</th>
                </tr>
                <?php
                $typecs = gettypeconge();

                if (!empty($typecs) && is_array($typecs)) {
                    foreach ($typecs as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nomtype'] ?></td>
                            <td><a href="?idtypec=<?= $value['idtypec'] ?>"><i class='bx bx-edit'></i></a>
                            <a href="../model/supprtype.php?idtypec=<?= $value['idtypec']?>" style="color: red;"><i class='bx bx-trash'></i></a>
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