<?php
include '../model/connexion.php';
if (isset($_GET['username'])) {
    $_SESSION['username'] = $_GET['username'];
    header("Location: login.php?username=" . $_GET['username']);
    exit();
}
?>
