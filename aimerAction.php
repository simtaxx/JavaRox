<?php 

require_once __DIR__ . '/vendor/autoload.php';

echo 'work';
session_start();
echo $_SESSION['user']->id();
echo $_POST['idPost'];

$aimer = new Entity\Aimer($_SESSION['user']->id(),$_POST['idPost']);
if($aimer->existBdd() != null){
  $aimer->deleteBdd();
  $message = 'like supprimer!';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&message=' . $message);
} else {
  $aimer->saveBdd();
  $message = 'Liker !';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&message=' . $message);
}

