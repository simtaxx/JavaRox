<?php
require_once __DIR__ . '/vendor/autoload.php';

$bdd = new Entity\Bdd();
$user = $bdd->getUser($_POST['pseudo']);
$mail = $bdd->getUserByMail($mail)->mail();
$message = "";
if (!isset($_POST['valider'])) {
  $message = 'Formulaire non envoyé !';
  header('Location: inscription.php?message=' . $message);
  exit();
} else {
  if (empty($_POST['pseudo'])) {
    $message = 'Pseudo non rempli !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif ($user->pseudo() != null) {
    $message = 'Pseudo deja pris !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (strlen($_POST['pseudo']) < 2 or strlen($_POST['pseudo']) > 15) {
    $message = 'le pseudo doit contenir entre 2 & 15 caractères !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
    $message = 'Caractères non-autorisés dans le pseudos !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message = 'Mail invalide !';
    header('Location: inscription.php?message=' . $message);
    exit();
  } elseif ($_POST['mdp1'] != $_POST['mdp2']) {
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
    $hash = password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
    $newUser = new Entity\User(
      '',
      $_POST['pseudo'],
      $hash,
      $_POST['pseudo'],
      $_POST['description'],
      $_POST['email'],
      $_POST['website']
    );
    $newUser->saveBdd();
    session_start();
    $_SESSION['user'] = $user;
    $message = 'vous etes inscrit a Youtaites!';
    header('Location: accueil.php?message=' . $message);
    exit();
  }
}
