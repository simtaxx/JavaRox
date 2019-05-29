<?php
require_once __DIR__ . '/vendor/autoload.php';

$bdd = new Entity\Bdd();
$user = $bdd->getUser($_POST['pseudo']);
$mail = $bdd->getUserByMail($_POST['email'])->mail();
$message = "";
if (!isset($_POST['valider'])) {
  $message = 'Formulaire non envoyé !';
  header('Location: inscription.php?message=' . $message);
  exit();
} else {

$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];
function removeslashes($string)
{
  $string=implode("",explode("\\",$string));
  return stripslashes(trim($string));
}
function security($string){
  $string = trim($string);
  $string = removeslashes($string);
  $string = htmlspecialchars($string);

  return $string;
}
$pseudo = security($pseudo);
$email = security($email);
  if (empty($pseudo)) {
    $message = 'Pseudo non rempli !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif ($user->pseudo() != null) {
    $message = 'Pseudo deja pris !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (strlen($pseudo) < 2 or strlen($pseudo) > 15) {
    $message = 'le pseudo doit contenir entre 2 & 15 caractères !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
    $message = 'Caractères non-autorisés dans le pseudos !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = 'Mail invalide !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif ($mdp1 != $mdp2) {
    $message = 'Les mots de passes sont different !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif ($mail != null) {
    $message = 'Email deja utiliser!';
    header('Location: inscription.php?message=' . $message);
    exit();
  } else {
    var_dump($_FILES);
    // $_FILES['icone']['name']     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
    // $_FILES['icone']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».
    // $_FILES['icone']['size']     //La taille du fichier en octets.
    // $_FILES['icone']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.
    // $_FILES['icone']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
    $hash = password_hash($mdp1, PASSWORD_DEFAULT);
    $newUser = new Entity\User(
      '',
      $pseudo,
      $hash,
      $pseudo,
      $_POST['description'],
      $email,
      $_POST['website']
    );
    $newUser->saveBdd();
    $lastId = Entity\Bdd::getLastIdUser();
    $newUser->setId($lastId[0]);
    session_start();
    $_SESSION['user'] = $newUser;
    $message = 'vous etes inscrit a Youtaites!';
    header('Location: accueil.php?message=' . $message);
    exit();
  }
}