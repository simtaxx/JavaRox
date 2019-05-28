<?php
namespace Entity;

class User
{
  private $_id;
  private $_pseudo;
  private $_password;
  private $_description;
  private $_picture;
  private $_mail;
  private $_website;

  function __construct($id, $pseudo, $password, $description, $picture, $mail, $website)
  {

    $this->_id = $id;
    $this->_pseudo = $pseudo;
    $this->_password = $password;
    $this->_description = $description;
    $this->_picture = $picture;
    $this->_mail = $mail;
    $this->_website = $website;
  }

  // Liste des getters

  public function id()
  {
    return $this->_id;
  }

  public function pseudo()
  {
    return $this->_pseudo;
  }

  public function password()
  {
    return $this->_password;
  }

  public function description()
  {
    return $this->_description;
  }

  public function picture()
  {
    return $this->_picture;
  }

  public function mail()
  {
    return $this->_mail;
  }

  public function website()
  {
    return $this->_website;
  }


  // Liste des setters

  public function setId(int $id)
  {
    $this->_id = $id;
  }

  public function setPseudo(string $pseudo)
  {
    $this->_pseudo = $pseudo;
  }

  public function setPassword(string $mdp)
  {
    $this->_password = $mdp;
  }

  public function setDescription(string $description)
  {
    $this->_description = $description;
  }

  public function setPicture(string $picture)
  {
    $this->_picture = $picture;
  }

  public function setWebsite(string $website)
  {
    $this->_website = $website;
  }

  public function setMail(string $mail)
  {
    $this->_mail = $mail;
  }

  public function saveBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO users (
      pseudo_user,
      password_user,
      description_user,
      picture_user,
      mail_user,
      website_user
    ) VALUES (:pseudo, :password, :description, :picture, :mail, :website)");
    $stmt->execute(
      [
        'pseudo'      => $this->_pseudo,
        'password'    => $this->_password,
        'description' => $this->_description,
        'picture'     => $this->_picture,
        'mail'        => $this->_mail,
        'website'     => $this->_website
      ]
    );
    $user = $stmt->fetch();
    return $user;
  }
}
