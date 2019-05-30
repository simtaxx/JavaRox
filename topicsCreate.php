<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Accueil</title>
	<link rel="stylesheet" href="./assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=League+Script&display=swap" rel="stylesheet">
</head>

<body class="create__container">
  <?php
  require './bootstrap.php';
  require './elements/header.php'
  ?>

  <div class="topicscreate__content">
    <div class="topics__section--top">
      <h1 class="topicscreate__title">Créer un nouveau topic</h1>
      
      <?php if (isset($_GET['message'])) { ?>
      <p><?php echo $_GET['message']; ?></p>
      <?php }?>
    </div>
    
    <div class="topics__section--bottom">
      <form action="createTopics.php" method="POST" class="topicscreate">

        <div class="topicscreate--left">
          <label for="title" class="topic__title">Titre :</label>
          <input type="text" name="title" id="title" class="topic__title--content">
        </div>

        <div class="topicscreate--right">
          <label for="content_post" class="topic__title">Contenu :</label>
          <textarea name="content_post" id="content_post" cols="30" rows="10" class="topicscreate--text"></textarea>
        </div>

        <input type="submit" name="login_post" class="submit__button submit__button--create">
      
      </form>
    </div>
  </div>