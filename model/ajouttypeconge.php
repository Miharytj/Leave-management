<?php
include 'connexion.php';
if (
    !empty($_POST['nomtype'])
) {

$sql = "INSERT INTO ttypec(nomtype)
        VALUES(?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nomtype']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Type de congé ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du type de congé";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../view/typeconge.php');