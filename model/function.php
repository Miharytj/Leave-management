<?php
include 'connexion.php';
session_start();
// function generateToken($length)
// {
//     $alphaNum = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

//     return substr(str_shuffle(str_repeat($alphaNum, $length)), 0, $length);
// }

function getservice($idservice = null)
{
    if (!empty($idservice)) {
        $sql = "SELECT * FROM tservice WHERE idservice=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($idservice));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM tservice";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getadmin($id) {
    global $connexion; // Assurez-vous que $db est accessible ici

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getadmins($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM users WHERE id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM users";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getjourferie($idjourf = null)
{
    if (!empty($idjourf)) {
        $sql = "SELECT * FROM tjourf WHERE idjourf=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($idjourf));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM tjourf";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function gettypeconge($idtypec = null)
{
    if (!empty($idtypec)) {
        $sql = "SELECT * FROM ttypec WHERE idtypec=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($idtypec));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM ttypec";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getemploye($matre = null, $searchDATA = array(), $limit = null, $offset = null)
{
    $pagination = "";
    if (!empty($limit) && (!empty($offset) || $offset == 0)) {
        $pagination = " LIMIT $limit OFFSET $offset";
    }
    if (!empty($matre)) {
        $sql = "SELECT a.matre AS matre, matricule, nome, prenome, adre, tel, mail, datedebut, a.soldeconge, dateentresolde, c.idservice, c.nomservice 
        FROM temploye AS a, tservice AS c WHERE c.idservice=a.idservice AND matre=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($matre));

        return $req->fetch();

    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($matricule)) $search .= " AND a.matricule = '$matricule' ";
        if (!empty($nome)) $search .= " AND a.nome = '$nome' ";
        if (!empty($prenome)) $search .= " AND a.prenome = '$prenome' ";
        if (!empty($adre)) $search .= " AND a.adre = '$adre' ";
        if (!empty($tel)) $search .= " AND a.tel = $tel ";
        if (!empty($mail)) $search .= " AND a.mail = $mail";
        if (!empty($datedebut)) $search .= " AND DATE(a.datedebut) = '$datedebut' ";
        if (!empty($soldeconge)) $search .= " AND a.soldeconge = $soldeconge ";
        if (!empty($dateentresolde)) $search .= " AND DATE(a.dateentresolde) = '$dateentresolde' ";
        if (!empty($idservice)) $search .= " AND a.idservice = $idservice ";

        $sql = "SELECT a.matre AS matre, matricule, nome, prenome, adre, tel, mail, datedebut, a.soldeconge, dateentresolde, c.idservice, c.nomservice 
        FROM temploye AS a, tservice AS c WHERE c.idservice=a.idservice $search $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    } else {
        $sql = "SELECT a.matre AS matre, matricule, nome, prenome, adre, tel, mail, datedebut, a.soldeconge, dateentresolde, c.idservice, c.nomservice 
        FROM temploye AS a, tservice AS c WHERE c.idservice=a.idservice $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetchAll();
    }
}

function countemploye($searchDATA = array())
{

   if (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($matricule)) $search .= " AND a.matricule = '$matricule' ";
        if (!empty($nome)) $search .= " AND a.nome = '$nome' ";
        if (!empty($prenome)) $search .= " AND a.prenome = '$prenome' ";
        if (!empty($adre)) $search .= " AND a.adre = '$adre' ";
        if (!empty($tel)) $search .= " AND a.tel = $tel ";
        if (!empty($mail)) $search .= " AND a.mail = $mail";
        if (!empty($datedebut)) $search .= " AND DATE(a.datedebut) = '$datedebut' ";
        if (!empty($soldeconge)) $search .= " AND a.soldeconge = $soldeconge ";
        if (!empty($dateentresolde)) $search .= " AND DATE(a.dateentresolde) = '$dateentresolde' ";
        if (!empty($idservice)) $search .= " AND a.idservice = $idservice ";

        $sql = "SELECT COUNT(*) AS total FROM temploye AS a, tservice AS c WHERE c.idservice=a.idservice $search";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetch();
    } else {
        $sql = "SELECT COUNT(*) AS total 
        FROM temploye AS a, tservice AS c WHERE c.idservice=a.idservice";
        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetch();
    }
}

function getconge($idconge = null, $searchDATA = array(), $limit = null, $offset = null)
{
    $pagination = "";
    if (!empty($limit) && (!empty($offset) || $offset == 0)) {
        $pagination = " LIMIT $limit OFFSET $offset";
    }
    if (!empty($idconge)) {
        $sql = "SELECT d.idconge AS idconge, d.datedebut, d.datefin, d.qtt, d.soldeutilise, d.solderestant, f.matre, f.prenome, e.idtypec, e.nomtype
        FROM tconge AS d, temploye AS f, ttypec AS e WHERE f.matre=d.matre AND e.idtypec=d.idtypec AND idconge=?" ;

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($idconge));

        return $req->fetch();

    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($datedebut)) $search .= " AND DATE(d.datedebut) = '$datedebut' ";
        if (!empty($datefin)) $search .= " AND DATE(d.datefin) = '$datefin' ";
        if (!empty($matre)) $search .= " AND d.matre = '$matre' ";
        if (!empty($idtypec)) $search .= " AND d.idtypec = $idtypec ";
        if (!empty($quantite)) $search .= " AND d.qtt = $quantite ";
        if (!empty($soldeutilise)) $search .= " AND d.soldeutilise = $soldeutilise ";
        if (!empty($solderestant)) $search .= " AND d.solderestant = $solderestant ";
        if (!empty($date)) $search .= " AND DATE(d.date) = '$date' ";

        $sql = "SELECT d.idconge AS idconge, d.datedebut, d.datefin, d.qtt, d.soldeutilise, d.solderestant, f.matre, f.prenome, e.idtypec, e.nomtype
        FROM tconge AS d, temploye AS f, ttypec AS e WHERE f.matre=d.matre AND e.idtypec=d.idtypec $search $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    } else {
        $sql = "SELECT d.idconge AS idconge, d.datedebut, d.datefin, d.qtt, d.soldeutilise, d.solderestant, f.matre, f.prenome, e.idtypec, e.nomtype
        FROM tconge AS d, temploye AS f, ttypec AS e WHERE f.matre=d.matre AND e.idtypec=d.idtypec $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetchAll();
    }
}

function countconge($searchDATA = array())
{

   if (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($datedebut)) $search .= " AND DATE(d.datedebut) = '$datedebut' ";
        if (!empty($datefin)) $search .= " AND DATE(d.datefin) = '$datefin' ";
        if (!empty($matre)) $search .= " AND d.matre = '$matre' ";
        if (!empty($idtypec)) $search .= " AND d.idtypec = $idtypec ";
        if (!empty($quantite)) $search .= " AND d.qtt = $quantite ";
        if (!empty($soldeutilise)) $search .= " AND d.soldeutilise = $soldeutilise ";
        if (!empty($solderestant)) $search .= " AND d.solderestant = $solderestant ";
        if (!empty($date)) $search .= " AND DATE(d.date) = '$date' ";

        $sql = "SELECT COUNT(*) AS total FROM tconge AS d, temploye AS f, ttypec AS e WHERE f.matre=d.matre AND e.idtypec=d.idtypec $search";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetch();
    } else {
        $sql = "SELECT COUNT(*) AS total 
        FROM tconge AS d, temploye AS f, ttypec AS e WHERE f.matre=d.matre AND e.idtypec=d.idtypec";
        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetch();
    }
}

function generateMatricule($connexion) {
    // Rechercher le dernier matricule dans la base de données
    $stmt = $connexion->query("SELECT matricule FROM temploye ORDER BY matricule DESC LIMIT 1");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si un matricule existe, incrémenter le numéro
    if ($row) {
        $lastMatricule = $row['matricule'];
        $lastNumber = (int)substr($lastMatricule, 1); // Enlever le préfixe 'A' et convertir en nombre
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Incrémenter et compléter avec des zéros
        return 'A' . $newNumber;
    } else {
        // Si aucun matricule n'existe, commencer avec A001
        return 'A001';
    }
}

