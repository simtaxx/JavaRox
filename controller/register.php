<?php
require '../bootstrap.php';

$bdd = new Entity\Bdd();
$user = $bdd->getUser($_POST['pseudo']);
$mail = $bdd->getUserByMail($_POST['email'])->mail();
$message = "";
$chemin = "";
if (!isset($_POST['valider'])) {
  $message = 'Le formulaire n\'a pas été envoyé';
  header('Location: ../views/inscription.php?message=' . $message);
  exit();
} else {

  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $mdp1 = $_POST['mdp1'];
  $mdp2 = $_POST['mdp2'];
  function removeslashes($string)
  {
    $string = implode("", explode("\\", $string));
    return stripslashes(trim($string));
  }
  function security($string)
  {
    $string = trim($string);
    $string = removeslashes($string);
    $string = htmlspecialchars($string);

    return $string;
  }
  $pseudo = security($pseudo);
  $email = security($email);
  if (empty($pseudo)) {
    $message = 'Veuillez choisir un pseudo';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif ($user->pseudo() != null) {
    $message = 'Ce pseudo est déjà utilisé';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif (strlen($pseudo) < 2 or strlen($pseudo) > 15) {
    $message = 'Votre pseudo doit contenir entre 2 & 15 caractères !';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
    $message = 'Caractères non-autorisés dans le pseudo !';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = 'Mail invalide !';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif ($mdp1 != $mdp2) {
    $message = 'Les mots de passes sont differents !';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif ($mail != null) {
    $message = 'Cette email est déjà utilisé !';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif (empty($mdp1)) {
    $message = 'Veuillez choisir un mot de passe';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } elseif (empty($mdp2)) {
    $message = 'Veuillez choisir un mot de passe';
    header('Location: ../views/inscription.php?message=' . $message);
    exit();
  } else {
    var_dump($_FILES);
    if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) {

      $taillemax = 2097152;
      $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

      if ($_FILES['image']['size'] <= $taillemax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        if (in_array($extensionUpload, $extensionsValides)) {
          $lastUser = Entity\Bdd::getLastUser();
          $newIdUser = $lastUser->id() + 1;
          $chemin = '../assets/img/ppImg' . '/' . $newIdUser . '.' . $extensionUpload;
          $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
          if (!$resultat) {
            $message = 'L\'image n\'a pas été importée !';
            header('Location: ../views/inscription.php?message=' . $message);
            exit();
          }
        } else {
          $message = 'Extension non valide (jpg, jpeg, gif ou png !';
          header('Location: ../views/inscription.php?message=' . $message);
          exit();
        }
      } else {
        $message = 'Taille de l\'image suppérieure a 2Mo !';
        header('Location: ../views/inscription.php?message=' . $message);
        exit();
      }
    }
    $hash = password_hash($mdp1, PASSWORD_DEFAULT);
    $newUser = new Entity\User(
      '',
      $pseudo,
      $hash,
      $_POST['description'],
      $chemin,
      $email,
      $_POST['website']
    );
    $newUser->saveBdd();
    $lastId = Entity\Bdd::getLastIdUser();
    $newUser->setId($lastId[0]);
    session_start();
    $_SESSION['user'] = $newUser;
    $message = 'Vous êtes inscrit sur Youtaites !';
    header('Location: ../views/accueil.php?message=' . $message);
    exit();
  }
}
