<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();
$nbComment = count(Entity\Bdd::getAllComments($_POST['idTopic']));
echo $nbComment;
//verifier lenvoie du formulaire
if (!isset($_POST['Publier'])) {
  echo 'formulaire non envoyé !';
} else {
  if (empty($_POST['title']) && empty($_POST['content'])) {
    echo 'lourd!';
  } elseif (strlen($_POST['title']) > 100) {
    echo 'titre du post trop long';
  } else {
    $date = date("d-m-Y");
    $newComment = new Entity\Commentaires('', $_POST['content'],$_POST['idPost'],$_SESSION['user']->id(),$date);
    $newComment->saveBdd();
    $nbComment++;
    if($nbComment == 10){
      $topic = Entity\Bdd::getOneTopic($_POST['idTopic']);
      define('CONSUMER_KEY', '9Ql6vAQAezCpvtYOsn4vf6eWO');
      define('CONSUMER_SECRET', '7Xc9hW9vHSpYsVfXdgFkWZBz6YoD4gri5YtQPuwQT1vlkDJexN');

      define('ACCESS_KEY','1133052464058523650-rHZku3nSWlozE7oeHm0vmFK7J0dfyy');
      define('ACCESS_SECRET','AePb2gxWZbhWTPKHCpcFyeZj8XxLk5DwRImsPRXdWQTwA');

      $connection = new Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_KEY, ACCESS_SECRET);
      $content = $connection->get("account/verify_credentials");
      $tweet = 'le topic '.$topic->title().' est a garder a l oeil ;)';
      $parameters = array('status' => $tweet);
      $connection->post('statuses/update', $parameters);

    }
    $message = 'Topics bien poster';
    header('Location: topic.php?idTopic='. $_POST['idTopic'].'&message=' . $message);
    exit();
  }
}
?>