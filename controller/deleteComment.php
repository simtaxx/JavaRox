<?php

require '../bootstrap.php';

$comment = Entity\Bdd::getOneComment($_POST['idComment']);

if (isset($_POST['Supprimer'])) {
  $comment->deleteBdd();
  $message = 'Vous venez de supprimer un commentaire';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
} else {
  $message = 'Le formulaire n\'a pas été envoyé';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
}
