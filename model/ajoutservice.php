<?php
include 'connexion.php';
if (
    !empty($_POST['nomservice'])
) {

$sql = "INSERT INTO tservice(nomservice)
        VALUES(?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nomservice']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Service ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du service";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../view/service.php');