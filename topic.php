<?php require './elements/header.php';
require_once __DIR__ . '/vendor/autoload.php';
session_start();
?>
<?php 
  $topic = Entity\Bdd::getOneTopic($_GET['idTopic']);
  $post = Entity\Bdd::getOnePost($_GET['idTopic']);
  $createur = Entity\Bdd::getUserById($topic->idUser());
  $comments = Entity\Bdd::getAllComments($post->id());
?>

<h1><?php echo $topic->title();?></h1>
<p>Publier par <?php echo $createur->pseudo() ?> le <?php echo $post->date() ?></p>
<div>
  <h2><?php echo $post->title(); ?></h2>
  <p><?php echo $post->content(); ?></p>
</div>

<form action="createComment.php" method="POST">
  <textarea name="content" id="content" cols="30" rows="10" placeholder="contenu du commentaires"></textarea>
  <input type="hidden" name="idPost" value="<?php echo $post->id()?>">
  <input type="hidden" name="idTopic" value="<?php echo $_GET['idTopic'] ?>">
  <input type="submit" name="Publier" value="Publier">
</form>

<?php 
  foreach ($comments as $comment) {
    $user = Entity\Bdd::getUserById($comment->idUser());
?>
  <div>
    <h2><?php echo $user->pseudo(); ?> le <?php echo $comment->date() ?></h2>
    <P><?php echo $comment->content(); ?></p>
  </div>
<?php 
  }
?>