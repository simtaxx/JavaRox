<?php require './elements/header.php' ?>
<h1>Acceuil</h1>
<?php 

    // include_once('entity/user.php');
    require_once __DIR__.'/vendor/autoload.php';
    session_start();
    var_dump($_SESSION['user']);
?>