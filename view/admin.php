<?php
include 'entete.php';
//$admin = []; // Initialiser $admin comme un tableau vide par défaut

if (!empty($_GET['id'])) {
    $admin = getadmins($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifadmin.php" : "../model/ajoutadmin.php" ?>" method="post">
                <input value="<?= isset($admin['id']) ?  $admin['username'] : "" ?>" type="text" name="username" id="username" placeholder="Veuillez saisir votre nom de l'utilisateur">

                <input value="<?= isset($admin['id']) ?  $admin['email'] : "" ?>" type="text" name="email" id="email" placeholder="Veuillez saisir votre email" >
             
                <input value="<?= isset($admin['id']) ?  $admin['password'] : "" ?>" type="password" name="password" id="password" placeholder="Veuillez saisir votre mot de passe">
                
                <input value="<?= isset($admin['id']) ?  $admin['confirm'] : "" ?>" type="password" name="confirm" id="confirm" placeholder="Veuillez confirmer votre mot de passe" >

                <input value="<?= isset($admin['id']) ?  $admin['id'] : "" ?>" type="hidden" name="id" id="id">

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
                    <th>Username</th>
                    <th>E-mail</th>
                    <th class="hide-column">Password</th>
                    <th>Action</th>
                </tr>
                <?php
                $admins = getadmins();

                if (!empty($admins) && is_array($admins)) {
                    foreach ($admins as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['username'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td class="hide-column"><?= $value['password'] ?></td>
                            <td> <a href="../model/deleteadmin.php?id=<?= $value['id']?>" style="color: red;"><i class='bx bx-trash'></i></a>
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
