<?php
include 'connexion.php';
if (
    !empty($_POST['datejourf'])
    && !empty($_POST['nomjourf'])
    && !empty($_POST['idjourf'])
) {

$sql = "UPDATE tjourf SET datejourf=?, nomjourf=? WHERE idjourf=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['datejourf'],
        $_POST['nomjourf'],
        $_POST['idjourf']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Jour ferie modifié avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] = "Rien a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
    
} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}
header('Location: ../view/jourf.php');
?>
