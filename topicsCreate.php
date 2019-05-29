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
  <h1>Créer votre topic</h1>
  <?php
  if (isset($_GET['message'])) {
    ?>
    <p><?php echo $_GET['message']; ?></p>
  <?php
}
?>
  <form action="createTopics.php" method="POST">
    <label for="title">Nom du topic:</label>
    <input type="text" name="title" id="title">
    <h2>Créer votre post</h2>
    <label for="content_post">contenu:</label>
    <textarea name="content_post" id="content_post" cols="30" rows="10"></textarea>
    <input type="submit" name="login_post">
  </form>

  <?php require './elements/footer.php' ?>
</body>
</body>

</html>