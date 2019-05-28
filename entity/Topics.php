<?php
namespace Entity;
require_once __DIR__.'/../vendor/autoload.php';

class Topics {
  private $_id;
  private $_title;
  private $_closed;
  private $_idUser;

  function __construct($id, $title, $closed, $idUser)
  {
    $this->_id = $id;
    $this->_title = $title;
    $this->_closed = $closed;
    $this->_idUser = $idUser;
  }

  public function id()
  {
    return $this->_id;
  }
  public function title()
  {
    return $this->_title;
  }
  public function closed()
  {
    return $this->_closed;
  }
  public function idUser()
  {
    return $this->_idUser;
  }

  public function setId(int $id)
  {
      $this->_id = $id;
  }
  public function setTitle(string $title)
  {
      $this->_title = $title;
  }
  public function setClosed(bool $closed)
  {
      $this->_closed = $closed;
  }
  public function setIdUser(int $idUser)
  {
      $this->_idUser = $idUser;
  }

  public function saveBdd(){
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO topic (
      title_topic,
      closed_topic,
      id_user
    ) VALUES (:title, :closed, :idUser)");
    $stmt->execute(['title'     =>   $this->_title, 
                    'closed'    =>   $this->_closed, 
                    'idUser'    =>   $this->_idUser]
    );
    $topic = $stmt->fetch();
    return $topic;
  }
}