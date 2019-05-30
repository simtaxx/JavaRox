<?php

require_once __DIR__ . '/vendor/autoload.php';
session_start();

$topic = Entity\Bdd::getOneTopic($_POST['idTopic']);

if(isset($_POST['Supprimer'])){
  $topic->deleteBdd();
  $message = 'Commentaire supprimer!';
  header('Location: accueil.php?'.$nomMessage.'=' . $message );
} else {
  $message = 'formulaire non envoyer!';
  header('Location: accueil.php?'.$nomMessage.'=' . $message );
}