<?php
namespace Entity;

use PDO;

require_once __DIR__ . '/../vendor/autoload.php';

class Bdd
{
  private static $pdo;

  public static function getDatabaseConnect()
  {
    if (self::$pdo != NULL) {
      return self::$pdo;
    }

    try {
      self::$pdo = new \PDO(
        'mysql:host=localhost;dbname=youtaites;',
        'root',
        'root',
        [
          PDO::ATTR_ERRMODE             => PDO::ERRMODE_WARNING,
          PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES utf8',
        ]
      );
      return self::$pdo;
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public static function getUser($log)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM users WHERE pseudo_user = :log");
    $stmt->execute(['log' => $log]);
    $userSQL = $stmt->fetch();
    $user = new User($userSQL['id_user'], $userSQL['pseudo_user'], $userSQL['password_user'], $userSQL['description_user'], $userSQL['picture_user'], $userSQL['mail_user'], $userSQL['website_user']);
    return $user;
  }

  public static function getUserByMail($mail)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM users WHERE mail_user = :mail");
    $stmt->execute(['mail' => $mail]);
    $userSQL = $stmt->fetch();
    $user = new User($userSQL['id_user'], $userSQL['pseudo_user'], $userSQL['password_user'], $userSQL['description_user'], $userSQL['picture_user'], $userSQL['mail_user'], $userSQL['website_user']);
    return $user;
  }

  public static function getUserById($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM users WHERE id_user = :id");
    $stmt->execute(['id' => $id]);
    $userSQL = $stmt->fetch();
    $user = new User($userSQL['id_user'], $userSQL['pseudo_user'], $userSQL['password_user'], $userSQL['description_user'], $userSQL['picture_user'], $userSQL['mail_user'], $userSQL['website_user']);
    return $user;
  }

  public static function getAllTopics()
  {
    $stmt = self::getDatabaseConnect()->query("SELECT * FROM topic order by id_topic desc;");
    $allTopicsSQL = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $allTopics = [];
    foreach ($allTopicsSQL as $value) {
      $topic = new Topics($value['id_topic'], $value['title_topic'], $value['closed_topic'], $value['id_user']);
      array_push($allTopics, $topic);
    }
    return $allTopics;
  }

  public static function getOneTopic($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM topic where id_topic = :id;");
    $stmt->execute(['id' => $id]);
    $TopicSQL = $stmt->fetch(PDO::FETCH_ASSOC);
    $topic = new Topics($TopicSQL['id_topic'], $TopicSQL['title_topic'], $TopicSQL['closed_topic'], $TopicSQL['id_user']);
    return $topic;
  }

  public static function getOnePost($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM post where id_topic = :id;");
    $stmt->execute(['id' => $id]);
    $PostSQL = $stmt->fetch(PDO::FETCH_ASSOC);
    $post = new Post($PostSQL['id_post'], $PostSQL['title_post'], $PostSQL['content_post'],$PostSQL['date_post'], $PostSQL['id_user'],$PostSQL['id_topic']);
    return $post;
  }

  public static function getLastIdTopics()
  {
    $stmt = self::getDatabaseConnect()->query("SELECT LAST_INSERT_ID() FROM topic");
    $lastId = $stmt->fetch();
    return $lastId;
  }

  public static function getLastIdUser()
  {
    $stmt = self::getDatabaseConnect()->query("SELECT LAST_INSERT_ID() FROM users");
    $lastId = $stmt->fetch();
    return $lastId;
  }

  public static function getAllComments($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM commentaires where id_post = :id order by id_comment asc;");
    $stmt->execute(['id' => $id]);
    $allCommentsSQL = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $allComments = [];
    foreach ($allCommentsSQL as $value) {
      $comment = new Commentaires($value['id_comment'],$value['content_comment'], $value['id_post'],$value['id_user'],$value['date_comment']);
      array_push($allComments, $comment);
    }
    return $allComments;
  }

  public static function getLikeByIdComment($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM liker where id_comment = :id;");
    $stmt->execute(['id' => $id]);
    $allLikeSQL = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $allLikes = [];
    foreach ($allLikeSQL as $value) {
      $like = new Liker($value['id_comment'],$value['id_user']);
      array_push($allLikes, $like);
    }
    return $allLikes;
  }

  public static function getNbLikePost($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT count(*) FROM aimer where id_post = :id;");
    $stmt->execute(['id' => $id]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $count[0]["count(*)"];
  }

  public static function getNbLikeCOmment($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT count(*) FROM liker where id_comment = :id;");
    $stmt->execute(['id' => $id]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $count[0]["count(*)"];
  }

  public static function getOneComment($id)
  {
    $stmt = self::getDatabaseConnect()->prepare("SELECT * FROM commentaires where id_comment = :id");
    $stmt->execute(['id' => $id]);
    $value = $stmt->fetch(PDO::FETCH_ASSOC);
      $comment = new Commentaires($value['id_comment'],$value['content_comment'], $value['id_post'],$value['id_user'],$value['date_comment']);
    return $comment;
  }
}
