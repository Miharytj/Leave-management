<?php
// session_start();

$server = "localhost";
$dbname = "gconge";
$user = "root";
$password = "";

try {
    $connexion = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
