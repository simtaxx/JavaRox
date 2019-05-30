<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=League+Script&display=swap" rel="stylesheet">
</head>

<body class="sign-up">
  <?php
  require './bootstrap.php';

  ?>
  <section class="container">

    <h1 class="log--title">Youtaites</h1>
    <div class="message">
      <p>Veuillez-vous connecter</p>
    </div>

    <form class="connexion--form" action="connexion.php" method="POST">
      <input class="sign__input" type="text" name="log" id="log" placeholder="Pseudo">
      <input class="sign__input" type="password" name="mdp" id="mdp" placeholder="Mot de passe">
      <input class="submit__button" type="submit" value="Se connecter">
    </form>

    <strong><a href="">Mot de passe oublié ?</a></strong>

    <aside class="terms terms--log">
      <p>Vous n'êtes pas encore sur Youtaites ?</p><strong><a href="./inscription.php">Inscrivez-vous</a></strong>
    </aside>

  </section>



  <!-- <?php require './elements/footer.php' ?> -->
</body>

</html>