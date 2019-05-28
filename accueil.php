<?php require './elements/header.php';
    require_once __DIR__.'/vendor/autoload.php'; 
    session_start();
?>
<h1>Acceuil</h1>
<?php 
    if($_GET['message']){
?>
<p><?php echo $_GET['message'] ?></p>
<?php
    }
?>

<?php 
    var_dump($_SESSION['user']);
    var_dump($_GET);
?>