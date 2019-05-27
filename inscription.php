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
  require_once __DIR__.'/vendor/autoload.php';
  require './elements/header.php'
?>
  <h1>inscription</h1>
  <form action="register.php" >
    <label for="pseudo">Votre pseudo:</label>
    <input type="text" name="pseudo" id="psseudo">
  </form>



  <?php require './elements/footer.php'?>
</body>
</body>
</html>