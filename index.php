<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <?php
  require_once __DIR__ . '/vendor/autoload.php';
  require './elements/header.php'

  ?>
  <h1>Hello world</h1>

  <form action="connexion.php" method="POST">
    <label for="log">Pseudo</label>
    <input type="text" name="log" id="log">
    <label for="mdp">Mot de passe:</label>
    <input type="password" name="mdp" id="mdp">
    <input type="submit" value="connexion">
    <a href="./inscription.php">inscription</a>
  </form>



  <?php require './elements/footer.php' ?>
</body>

</html>