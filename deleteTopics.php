<?php

require './bootstrap.php';

$topic = Entity\Bdd::getOneTopic($_POST['idTopic']);

if (isset($_POST['Supprimer'])) {
  $topic->deleteBdd();
  $message = 'Commentaire supprimer!';
  header('Location: accueil.php?message=' . $message);
} else {
  $message = 'formulaire non envoyer!';
  header('Location: accueil.php?message=' . $message);
}
