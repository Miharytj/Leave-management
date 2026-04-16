<?php
session_start();
include '../model/connexion.php';
session_destroy();

echo "<script>
    window.location.replace('login.php');
</script>";
header("Location: login.php");
exit();
?>
