<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();
//verifier lenvoie du formulaire
if (!isset($_POST['login_post'])) {
  $message = 'formulaire non envoyé !';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
} else {
  $title = $_POST['title'];
  $content = $_POST['content_post'];
  function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}
  $title = removeslashes($title);
  $content = removeslashes($content);
  var_dump($title);
  if (empty($title)) {
    $message = 'titre non rempli!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  } elseif(empty($content)){
    $message = 'contenu non rempli!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  }elseif (strlen($title) > 100) {
    $message = 'titre du topic trop long!';
    header('Location: topicsCreate.php?message=' . $message);
    exit();
  } else {
    $newTopic = new Entity\Topics('', $title, 0, $_SESSION['user']->id());
    var_dump($newTopic);
    $newTopic->saveBdd();
    $date = date("d-m-Y");
    $lastId = Entity\Bdd::getLastIdTopics();
    $newPost = new Entity\Post('', $title, $content, $date, $_SESSION['user']->id(), $lastId[0]);
    $newPost->saveBdd();

    $message = 'Topics bien poster';
    header('Location: accueil.php?message=' . $message);
    exit();
  }
}
?>