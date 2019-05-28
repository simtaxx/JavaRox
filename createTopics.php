<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();
//verifier lenvoie du formulaire
if (!isset($_POST['login_post'])) {
  $message = 'formulaire non envoyé !';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
} else {
  if (empty($_POST['title'])) {
    $message = 'titre non rempli!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  } elseif(empty($_POST['content_post'])){
    $message = 'contenu non rempli!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  }elseif (strlen($_POST['title']) > 100) {
    $message = 'titre du topic trop long!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  } else {
    $newTopic = new Entity\Topics('', $_POST['title'], 0, $_SESSION['user']->id());
    var_dump($newTopic);
    $newTopic->saveBdd();
    $date = date("d-m-Y");
    $lastId = Entity\Bdd::getLastIdTopics();
    $newPost = new Entity\Post('', $_POST['title'], $_POST['content_post'], $date, $_SESSION['user']->id(), $lastId[0]);
    $newPost->saveBdd();

    $message = 'Topics bien poster';
    header('Location: accueil.php?message=' . $message);
    exit();
  }
}
?>