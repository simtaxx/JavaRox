<?php
// include_once('../entity/user.php');
require_once __DIR__.'/../vendor/autoload.php';

function getDatabaseConnect(){
  try {
    $pdo  = new PDO(
      'mysql:host=localhost;dbname=youtaites;',
      'root',
      'root',
      [
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES utf8',
      ]
    );
    return $pdo;
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
}

function getUser($log){
  $pdo = getDatabaseConnect();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE pseudo_user = :log");
  $stmt->execute(['log' => $log]);
  $userSQL = $stmt->fetch();
  $user = new Entity\User($userSQL['id_user'],$userSQL['pseudo_user'],$userSQL['password_user'],$userSQL['description_user'],$userSQL['picture_user'],$userSQL['mail_user'],$userSQL['website_user']);
  return $user;
}

function getUserByMail($mail){
  $pdo = getDatabaseConnect();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE mail_user = :mail");
  $stmt->execute(['mail' => $mail]);
  $userSQL = $stmt->fetch();
  $user = new Entity\User($userSQL['id_user'],$userSQL['pseudo_user'],$userSQL['password_user'],$userSQL['description_user'],$userSQL['picture_user'],$userSQL['mail_user'],$userSQL['website_user']);
  return $user;
}

function createNewUser($newUser){
  $pdo = getDatabaseConnect();
  $stmt = $pdo->prepare("  INSERT INTO users (
    pseudo_user,
    password_user,
    description_user,
    picture_user,
    mail_user,
    website_user
  ) VALUES (:pseudo, :password, :description, :picture, :mail, :website)");
  $stmt->execute(['pseudo'      => $newUser->pseudo(), 
                  'password'    => $newUser->password(), 
                  'description' => $newUser->description(), 
                  'picture'     => $newUser->picture(), 
                  'mail'        => $newUser->mail(), 
                  'website'     => $newUser->website()]
  );
  $user = $stmt->fetch();
  return $user;
}
