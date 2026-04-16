<?php
include 'connexion.php';
if (
    !empty($_POST['matricule'])
    && !empty($_POST['nome'])
    && !empty($_POST['prenome'])
    && !empty($_POST['adre'])
    && !empty($_POST['tel'])
    && !empty($_POST['mail'])
    && !empty($_POST['datedebut'])
    && !empty($_POST['soldeconge'])
    && !empty($_POST['dateentresolde'])
    && !empty($_POST['idservice'])
    && !empty($_POST['matre'])
) {

$sql = "UPDATE temploye SET matricule=?, nome=?, prenome=?, adre=?, tel=?, mail=?, datedebut=?, soldeconge=?, dateentresolde=?, idservice=? WHERE matre=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['matricule'],
        $_POST['nome'],
        $_POST['prenome'],
        $_POST['adre'],
        $_POST['tel'],
        $_POST['mail'],
        $_POST['datedebut'],
        $_POST['soldeconge'],
        $_POST['dateentresolde'],
        $_POST['idservice'],
        $_POST['matre']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Employe modifié avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] = "Rien a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
    
} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}
header('Location: ../view/employe.php');
?>
