<?php
namespace Entity;

class Post
{
  private $_id;
  private $_title;
  private $_content;
  private $_date;
  private $_idUser;
  private $_idTopic;

  function __construct($id,$title,$content,$date,$idUser,$idTopic)
  {

    $this->_id = $id;
    $this->_title = $title;
    $this->_content = $content;
    $this->_date = $date;
    $this->_idUser = $idUser;
    $this->_idTopic= $idTopic;
  }

  // Liste des getters

  public function id()
  {
    return $this->_id;
  }

  public function title()
  {
    return $this->_title;
  }

  public function content()
  {
    return $this->_content;
  }

  public function date()
  {
    return $this->_date;
  }

  public function idUser()
  {
    return $this->_idUser;
  }

  public function idTopic()
  {
    return $this->_idTopic;
  }

  // Liste des setters

  public function setId(int $id)
  {
      $this->_id = $id;
  }

  public function setTitle(string $title)
  {
      $this->_title = $title;
  }

  public function setContent(string $content)
  {
      $this->_content = $content;
  }

  public function setDate(string $date)
  {
      $this->_date = $date;
  }

  public function setidUser(int $idUser)
  {
      $this->_idUser = $idUser;
  }

  public function setidTopic(int $idTopic)
  {
      $this->_idTopic = $idTopic;
  }

  public function saveBdd(){
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO post (
      title_post,
      content_post,
      date_post,
      id_user,
      id_topic
    ) VALUES (:title, :content, :date, :idUser, :idTopic);");
    $stmt->execute(['title'      => $this->_title, 
                    'content'    => $this->_content, 
                    'date' => $this->_date, 
                    'idUser'     => $this->_idUser, 
                    'idTopic'        => $this->_idTopic]
    );
    $post = $stmt->fetch();
    return $post;
  }
}
