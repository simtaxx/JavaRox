<?php

require '../bootstrap.php';

$nomMessage = 'message' . $_POST['idComment'];
$nomNbLike = 'nbLike' . $_POST['idComment'];

$liker = new Entity\Liker($_SESSION['user']->id(), $_POST['idComment']);
if ($liker->existBdd() != null) {
  $liker->deleteBdd();
  $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
  $message = 'Vous n\'aimez plus';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&' . $nomMessage . '=' . $message . '&' . $nomNbLike . '=' . $nbLike);
} else {
  $liker->saveBdd();
  $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
  $message = 'Vous avez aimé';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&' . $nomMessage . '=' . $message . '&' . $nomNbLike . '=' . $nbLike);
}
