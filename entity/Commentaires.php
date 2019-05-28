<?php
namespace Entity;

class Commentaires
{
  private $_id;
  private $_content;
  private $_idPost;
  private $_idUser;
  private $_date;

  function __construct($id, $content, $idPost, $idUser, $date)
  {

    $this->_id = $id;
    $this->_content = $content;
    $this->_idPost = $idPost;
    $this->_idUser = $idUser;
    $this->_date = $date;
  }

  // Liste des getters

  public function id()
  {
    return $this->_id;
  }

  public function content()
  {
    return $this->_content;
  }

  public function idPost()
  {
    return $this->_idPost;
  }

  public function idUser()
  {
    return $this->_idUser;
  }

  public function date()
  {
    return $this->_date;
  }

  // Liste des setters

  public function setId(int $id)
  {
    $this->_id = $id;
  }

  public function setContent(string $content)
  {
    $this->_content = $content;
  }

  public function setIdPost(int $idPost)
  {
    $this->_idPost = $idPost;
  }

  public function setIdUser(int $idUser)
  {
    $this->_idUser = $idUser;
  }

  public function setDate(string $date)
  {
    $this->_date = $date;
  }

  public function saveBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO commentaires (
      content_comment,
      id_post,
      id_user,
      date_comment
    ) VALUES (:content, :idPost, :idUser, :date)");
    $stmt->execute(
      [
        'content'    => $this->_content,
        'idPost' => $this->_idPost,
        'idUser'     => $this->_idUser,
        'date'     => $this->_date
      ]
    );
    $commentaire = $stmt->fetch();
    return $commentaire;
  }
}
