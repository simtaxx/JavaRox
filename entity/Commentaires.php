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
    $Parsedown = new \Parsedown();
    $Parsedown->setSafeMode(true);
    return $Parsedown->text($this->_content);
  }

  public function contentNoParseDown()
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
      id_post,
      id_user,
      date_comment,
      content_comment
    ) VALUES (:idPost, :idUser, :date,:content)");
    $stmt->execute(
      [
        'content'    => $this->_content,
        'idPost' => $this->_idPost,
        'idUser'     => $this->_idUser,
        'date'     => $this->_date
      ]
    );
  }

  public function deleteBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare(" DELETE FROM liker
    WHERE id_comment = :id");
    $stmt->execute(
      [
        'id'    => $this->_id
      ]
    );
    $stmt = Bdd::getDatabaseConnect()->prepare(" DELETE FROM commentaires
    WHERE id_comment = :id");
    $stmt->execute(
      [
        'id'    => $this->_id
      ]
    );
  }

  public function editBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare("UPDATE commentaires
    SET content_comment = :content
    WHERE id_comment = :id");
    $stmt->execute(
      [
        'content'    => $this->_content,
        'id' => $this->_id,
      ]
    );
  }
}
