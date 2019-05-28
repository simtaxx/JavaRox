<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <?php
  require_once __DIR__ . '/vendor/autoload.php';
  require './elements/header.php'
  ?>
  <h1>inscription</h1>
  <?php
  if ($_GET['message']) {
    ?>
    <p><?php echo $_GET['message'] ?><p>
      <?php
    }
    ?>
      <form action="register.php" method="POST">
        <label for="pseudo">Votre pseudo:</label>
        <input type="text" name="pseudo" id="pseudo">
        <label for="email">Votre email:</label>
        <input type="email" name="email" id="email">
        <label for="mdp1">Votre mot de passe:</label>
        <input type="password" name="mdp1" id="mdp1">
        <label for="mdp2">Retaper mot de passe:</label>
        <input type="password" name="mdp2" id="mdp2">
        <label for="website">votre site internet (facultatif):</label>
        <input type="text" name="website" id="website">
        <label for="description">votre description (facultatif):</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <label for="image">votre image de profil (facultatif):</label>
        <input type="file" name="image" />
        <input type="submit" value="Valider" name="valider">
      </form>



      <?php require './elements/footer.php' ?>
</body>
</body>

</html>