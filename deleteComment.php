<?php

require './bootstrap.php';

$comment = Entity\Bdd::getOneComment($_POST['idComment']);

if (isset($_POST['Supprimer'])) {
  $comment->deleteBdd();
  $message = 'Commentaire supprimer!';
  header('Location: topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
} else {
  $message = 'formulaire non envoyer!';
  header('Location: topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
}
