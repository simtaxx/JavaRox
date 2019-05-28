<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();
//verifier lenvoie du formulaire
if (!isset($_POST['Publier'])) {
  echo 'formulaire non envoyé !';
} else {
  if (empty($_POST['title']) && empty($_POST['content'])) {
    echo 'lourd!';
  } elseif (strlen($_POST['title']) > 100) {
    echo 'titre du post trop long';
  } else {
    $date = date("d-m-Y");
    $newComment = new Entity\Commentaires('', $_POST['content'],$_POST['idPost'],$_SESSION['user']->id(),$date);
    $newComment->saveBdd();
    $message = 'Topics bien poster';
    header('Location: topic.php?idTopic='. $_POST['idTopic'].'&message=' . $message);
    exit();
  }
}
?>