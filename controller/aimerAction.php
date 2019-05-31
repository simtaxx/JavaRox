<?php

require '../bootstrap.php';
echo $_SESSION['user']->id();
echo $_POST['idPost'];

$aimer = new Entity\Aimer($_SESSION['user']->id(), $_POST['idPost']);
if ($aimer->existBdd() != null) {
  $aimer->deleteBdd();
  $message = 'Vous n\'aimez plus';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
} else {
  $aimer->saveBdd();
  $message = 'Vous avez aimé !';
  header('Location: ../views/topic.php?idTopic=' . $_POST['idTopic'] . '&message=' . $message);
}