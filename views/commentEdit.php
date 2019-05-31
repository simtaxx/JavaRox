<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Nouveau Topic</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=League+Script&display=swap" rel="stylesheet">
</head>

<body class="create__container">
  <?php
  require '../bootstrap.php';
  require '../elements/header.php';
  $comment = Entity\Bdd::getOneComment($_POST['idComment']);
  ?>

  <div class="topicscreate__content">
    <div class="topics__section--top">
      <h1 class="topicscreate__title">Editer un commentaire</h1>
      
      <?php if (isset($_GET['message'])) { ?>
      <p class="msg"><?php echo $_GET['message']; ?></p>
      <?php }?>
    </div>
    
    <div class="topics__section--bottom">
      <form action="../controller/editComment.php" method="POST" class="topicscreate">

        <div class="topicscreate--right">
          <label for="content_post" class="topic__title">Contenu :</label>
          <input type="hidden" name="idTopic" value="<?php echo $_POST['idTopic'] ?>">
          <input type="hidden" name="idComment" value="<?php echo $_POST['idComment'] ?>">
          <textarea name="comment" id="content_post" cols="30" rows="10" class="topicscreate--text"><?php echo $comment
          ->contentNoParseDown() ; ?></textarea>
        </div>

        <input type="submit" name="editer" class="submit__button submit__button--create">
      
      </form>
    </div>
  </div>