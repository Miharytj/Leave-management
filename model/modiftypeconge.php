<?php
include 'connexion.php';
if (
    !empty($_POST['nomtype'])
    && !empty($_POST['idtypec'])
) {

$sql = "UPDATE ttypec SET nomtype=? WHERE idtypec=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nomtype'],
        $_POST['idtypec']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Type de congé modifié avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] = "Rien a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
    
} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}
header('Location: ../view/typeconge.php');
?>
