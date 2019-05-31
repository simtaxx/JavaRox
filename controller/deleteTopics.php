<?php

require '../bootstrap.php';

$topic = Entity\Bdd::getOneTopic($_POST['idTopic']);

if (isset($_POST['Supprimer'])) {
  $topic->deleteBdd();
  $message = 'Votre topic est supprimé';
  header('Location: ../views/accueil.php?message=' . $message);
} else {
  $message = 'Le formulaire n\'a pas été envoyé';
  header('Location: ../views/accueil.php?message=' . $message);
}