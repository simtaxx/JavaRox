<?php
require '../bootstrap.php';

//verifier lenvoie du formulaire
if (!isset($_POST['login_post'])) {
  $message = 'Le formulaire n\'a pas été enoyé';
    header('Location: ../views/topicsCreate.php?message=' . $message);
    exit();
} else {
  if (empty($_POST['title'])) {
    $message = 'Veuillez remplir le titre';
    header('Location: ../views/topicsCreate.php?message=' . $message);
    exit();
  } elseif(empty($_POST['content_post'])){
    $message = 'Le contenu est vide';
    header('Location: ../views/topicsCreate.php?message=' . $message);
    exit();
  } else {
    $newTopic = new Entity\Topics('', $_POST['title'], 0, $_SESSION['user']->id());
    var_dump($newTopic);
    $newTopic->saveBdd();
    $date = date("d-m-Y");
    $lastId = Entity\Bdd::getLastIdTopics();
    $newPost = new Entity\Post('', $_POST['title'], $_POST['content_post'], $date, $_SESSION['user']->id(), $lastId[0]);
    $newPost->saveBdd();

    $message = 'Votre topic est publié';
    header('Location: ../views/accueil.php?message=' . $message);
    exit();
  }
}
