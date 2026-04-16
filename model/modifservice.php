<?php
include 'connexion.php';
if (
    !empty($_POST['nomservice'])
    && !empty($_POST['idservice'])
) {

$sql = "UPDATE tservice SET nomservice=? WHERE idservice=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nomservice'],
        $_POST['idservice']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Service modifié avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] = "Rien a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
    
} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}
header('Location: ../view/service.php');
?>
