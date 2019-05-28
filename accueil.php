<?php require './elements/header.php';
require_once __DIR__ . '/vendor/autoload.php';
session_start();
?>

<h1>Acceuil</h1>

<?php $allTopics = Entity\Bdd::getAllTopics();
var_dump($_SESSION['user']);
if ($_GET['message']) {
    ?>
    <p><?php echo $_GET['message']; ?></p>
<?php
}
foreach ($allTopics as $Topics) {

    ?>
    <div>
        <a href="/topic.php?idTopic=<?php echo $Topics->id(); ?>">
            <h2><?php echo $Topics->title(); ?></h2>
            <p><?php
                $user = Entity\Bdd::getUserById($Topics->idUser());
                echo 'Poster par ' . $user->pseudo();
                ?></p>
        </a>
    </div>
<?php
}
?>