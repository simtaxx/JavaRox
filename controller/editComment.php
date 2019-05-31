<?php

require '../bootstrap.php';

$comment = Entity\Bdd::getOneComment($_POST['idComment']);

if (isset($_POST['editer'])) {
  $comment->setContent($_POST['comment']);
  $comment->editBdd();
  $message = 'Commentaire Editer!';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
} else {
  $message = 'Le formulaire n\'a pas été envoyé';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
}
