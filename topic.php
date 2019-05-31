<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Topic</title>
	<link rel="stylesheet" href="./assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=League+Script&display=swap" rel="stylesheet">
</head>

<?php
require './bootstrap.php';
require './elements/header.php';
?>

<main>
  <section class="topic">
    <?php if (isset($_GET['message'])) { ?>
      <p class="msg msg--court"><?php echo $_GET['message']; ?></p>
    <?php } ?>
    <?php
    $topic = Entity\Bdd::getOneTopic($_GET['idTopic']);
    $post = Entity\Bdd::getOnePost($_GET['idTopic']);
    $createur = Entity\Bdd::getUserById($topic->idUser());
    $comments = Entity\Bdd::getAllComments($post->id());
    $nbLikePost = Entity\Bdd::getNbLikePost($post->id());
    ?>
    
    <div class="topic--post">
      <div>
        <div class="topic__post--header">
          <h2 class="topic--title"> <?php echo $topic->title() ?></h2>
          <p class="topic--infos">Publié par <?php echo '<span class="topic--pseudo">' . $createur->pseudo() . '</span>'?>, le <?php echo $post->date() ?></p>
        </div>

        <div class="topic__post--content">
          <p><?php echo $post->content(); ?></p>
        </div>
      </div>
    </div>
    
    <div class="like--section">
      <form class="like--container"  class="addLike" action="aimerAction.php" method="POST">
        <svg class="addLike" width="40" height="40" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g filter="url(#filter0_d)">
          <circle cx="16.5" cy="16.5" r="13.5" fill="#F565A9"/>
          <circle cx="16.5" cy="16.5" r="13.5" fill="url(#paint0_linear)"/>
          </g>
          <path d="M22.5127 14.9651L22.5142 14.982L22.5169 14.9988C22.5226 15.034 22.5841 15.4556 22.4127 16.181L22.4127 16.1811C22.1663 17.2254 21.5963 18.1808 20.7562 18.9428L16.4638 22.7721L12.2455 18.944L12.2452 18.9438C11.4044 18.1819 10.8338 17.2258 10.5873 16.1811L10.5873 16.181C10.4158 15.4551 10.4776 15.0338 10.4831 14.9998L10.486 14.9824L10.4876 14.9648C10.6595 13.0702 11.9748 11.7977 13.525 11.7977C14.5553 11.7977 15.4839 12.3468 16.0323 13.2852L16.4592 14.0158L16.8932 13.2893C17.4447 12.3661 18.4191 11.798 19.475 11.798C21.0255 11.798 22.3406 13.0704 22.5127 14.9651Z" stroke="white"/>
          <defs>
          <filter id="filter0_d" x="0" y="0" width="35" height="35" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
          <feFlood flood-opacity="0" result="BackgroundImageFix"/>
          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
          <feOffset dx="1" dy="1"/>
          <feGaussianBlur stdDeviation="2"/>
          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.12 0"/>
          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
          </filter>
          <linearGradient id="paint0_linear" x1="7.29546" y1="48.225" x2="22.0147" y2="50.5436" gradientUnits="userSpaceOnUse">
          <stop stop-color="#ABA9FF"/>
          <stop offset="1" stop-color="#D6FAFF" stop-opacity="0"/>
          </linearGradient>
          </defs>
        </svg>
        <input class="like addLike" type="submit" value="" name="aimer">
        <input type="hidden" name="idPost" value="<?php echo $post->id() ?>">
        <input type="hidden" name="idTopic" value="<?php echo $_GET['idTopic'] ?>">
      </form>
      <div class="like--counter"><p> <?php echo $nbLikePost; ?></p></div>
    </div>
  </section>

  <section class="comments">
    <h1 class="comments--title">Commentaires :</h1>

    <?php foreach ($comments as $comment) { $user = Entity\Bdd::getUserById($comment->idUser()); $nbLikeComment = Entity\Bdd::getNbLikeCOmment($comment->id()); ?>

      <div class="comment">
        <h2 class="comment--infos"><?php echo '<span class="topic--pseudo">' . $user->pseudo() . '</span>'; ?>, le <?php echo $comment->date() ?></h2>

        <div class="comment--content">
          <p><?php echo $comment->content(); ?></p>
        </div>

        <div class="like--section">
          <form class="like--container" action="likerAction.php" method="POST">
            <svg class="addLike" width="40" height="40" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g filter="url(#filter0_d)">
              <circle cx="16.5" cy="16.5" r="13.5" fill="#F565A9"/>
              <circle cx="16.5" cy="16.5" r="13.5" fill="url(#paint0_linear)"/>
              </g>
              <path d="M22.5127 14.9651L22.5142 14.982L22.5169 14.9988C22.5226 15.034 22.5841 15.4556 22.4127 16.181L22.4127 16.1811C22.1663 17.2254 21.5963 18.1808 20.7562 18.9428L16.4638 22.7721L12.2455 18.944L12.2452 18.9438C11.4044 18.1819 10.8338 17.2258 10.5873 16.1811L10.5873 16.181C10.4158 15.4551 10.4776 15.0338 10.4831 14.9998L10.486 14.9824L10.4876 14.9648C10.6595 13.0702 11.9748 11.7977 13.525 11.7977C14.5553 11.7977 15.4839 12.3468 16.0323 13.2852L16.4592 14.0158L16.8932 13.2893C17.4447 12.3661 18.4191 11.798 19.475 11.798C21.0255 11.798 22.3406 13.0704 22.5127 14.9651Z" stroke="white"/>
              <defs>
              <filter id="filter0_d" x="0" y="0" width="35" height="35" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix"/>
              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
              <feOffset dx="1" dy="1"/>
              <feGaussianBlur stdDeviation="2"/>
              <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.12 0"/>
              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
              </filter>
              <linearGradient id="paint0_linear" x1="7.29546" y1="48.225" x2="22.0147" y2="50.5436" gradientUnits="userSpaceOnUse">
              <stop stop-color="#ABA9FF"/>
              <stop offset="1" stop-color="#D6FAFF" stop-opacity="0"/>
              </linearGradient>
              </defs>
            </svg>
            <input class="like addLike" type="submit" value="" name="aimer">
            <input type="hidden" name="idComment" value="<?php echo $comment->id() ?>">
            <input type="hidden" name="idTopic" value="<?php echo $_GET['idTopic'] ?>">
          </form>
          <div class="like--counter"><p><?php echo $nbLikeComment;  ?></p></div>
        </div>
        <?php if (isset($_GET['message' . $comment->id()])) { ?><p><?php echo $_GET['message' . $comment->id()]; ?></p><?php } ?>

        <?php if ($_SESSION['user']->id() == $comment->idUser() or $_SESSION['user']->pseudo() == "admin") { ?>

        <form class="delete--container" action="deleteComment.php" method="POST">
          <input class="delete" type="submit" value="Supprimer" name="Supprimer">
          <input type="hidden" name="idComment" value="<?php echo $comment->id() ?>">
          <input type="hidden" name="idTopic" value="<?php echo $_GET['idTopic'] ?>">
        </form>

        <?php } ?>

      </div>

    <?php } ?>

    <form class="comment--create" action="createComment.php" method="POST">
      <textarea class="sign__input commentInput" name="content" id="content" cols="30" rows="10" placeholder="Écrire un commentaire..."></textarea>
      <input type="hidden" name="idPost" value="<?php echo $post->id() ?>">
      <input type="hidden" name="idTopic" value="<?php echo $_GET['idTopic'] ?>">
      <input class="submit__button" type="submit" name="Publier" value="Publier">
    </form>
  </section>
</main>

<?php require './elements/footer.php' ?>

