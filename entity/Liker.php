<?php
namespace Entity;

class Liker
{
  private $_idUser;
  private $_idComment;

  function __construct($idUser, $idComment)
  {

    $this->_idUser = $idUser;
    $this->_idComment = $idComment;
  }

  // Liste des getters

  public function idUser()
  {
    return $this->_idUser;
  }

  public function idComment()
  {
    return $this->_idComment;
  }

  // Liste des setters

  public function setId(int $idUser)
  {
    $this->_idUser = $idUser;
  }

  public function setIdComment(int $idComment)
  {
    $this->_idPost = $idComment;
  }

  public function saveBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO liker
     VALUES (:idComment, :idUser)");
    $stmt->execute(
      [
        'idComment'    => $this->_idComment,
        'idUser'      => $this->_idUser
      ]
    );
  }

  public function deleteBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare(" DELETE FROM liker
    WHERE id_user = :idUser and id_comment = :idComment");
    $stmt->execute(
      [
        'idUser'      => $this->_idUser,
        'idComment'    => $this->_idComment
      ]
    );
  }

  public function existBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare(" SELECT * FROM liker
    WHERE id_user = :idUser and id_comment = :idComment");
    $stmt->execute(
      [
        'idUser'      => $this->_idUser,
        'idComment'    => $this->_idComment
      ]
    );
    $user = $stmt->fetch();
    return $user;
  }
}
