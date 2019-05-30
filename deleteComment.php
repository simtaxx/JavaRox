<?php

require_once __DIR__ . '/vendor/autoload.php';
session_start();

$comment = Entity\Bdd::getOneComment($_POST['idComment']);

if(isset($_POST['Supprimer'])){
  $comment->deleteBdd();
  $message = 'Commentaire supprimer!';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
} else {
  $message = 'formulaire non envoyer!';
  header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
}

// if($liker->existBdd() != null){
//   $liker->deleteBdd();
//   $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
//   $message = 'like supprimer!';
//   header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
// } else {
//   $liker->saveBdd();
//   $nbLike = count(Entity\Bdd::getLikeByIdComment($_POST['idComment']));
//   $message = 'Liker !';
//   header('Location: topic.php?idTopic='.$_POST['idTopic'].'&'.$nomMessage.'=' . $message . '&' . $nomNbLike . '=' .$nbLike);
// }


