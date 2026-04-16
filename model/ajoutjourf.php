<?php
include 'connexion.php';
if (
    !empty($_POST['datejourf'])
    && !empty($_POST['nomjourf'])
) {

$sql = "INSERT INTO tjourf(datejourf, nomjourf)
        VALUES(?, ?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['datejourf'],
        $_POST['nomjourf']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Jour ferie ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du jour ferie";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../view/jourf.php');