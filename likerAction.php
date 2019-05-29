<?php 

require_once __DIR__ . '/vendor/autoload.php';

echo 'work';
session_start();
$nomMessage = 'message'.$_POST['idComment'];
$nomNbLike = 'nbLike'.$_POST['idComment'];

$liker = new Entity\Liker($_SESSION['user']->id(),$_POST['idComment']);
if($liker->existBdd() != null){
  $liker->deleteBdd();
  $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
  $message = 'like supprimer!';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
} else {
  $liker->saveBdd();
  $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
  $message = 'Liker !';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
}


