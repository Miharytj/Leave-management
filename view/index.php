<?php
session_start();
require_once '../model/function.php';

// reconnect_auto();
// is_connect();

require_once 'entete.php';
?>

<h1>Hello <?= $_SESSION['auth']->username ?></h1>
<?php
require_once 'enpied.php';
?>