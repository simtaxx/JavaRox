<?php
namespace Entity;

class Aimer
{
  private $_idUser;
  private $_idPost;

  function __construct($idUser,$idPost)
  {

    $this->_idUser = $idUser;
    $this->_idPost = $idPost;

  }

  // Liste des getters

  public function idUser()
  {
    return $this->_idUser;
  }

  public function idPost()
  {
    return $this->_idPost;
  }

  // Liste des setters

  public function setId(int $idUser)
  {
    $this->_idUser = $idUser;
  }

  public function setPseudo(int $idPost)
  {
    $this->_idPost = $idPost;
  }

  public function saveBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare("  INSERT INTO aimer
     VALUES (:idUser, :idPost)");
    $stmt->execute(
      [
        'idUser'      => $this->_idUser,
        'idPost'    => $this->_idPost
      ]
    );
    $user = $stmt->fetch();
    return $user;
  }

  public function deleteBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare(" DELETE FROM aimer
    WHERE id_user = :idUser and id_post = :idPost");
    $stmt->execute(
      [
        'idUser'      => $this->_idUser,
        'idPost'    => $this->_idPost
      ]
    );
  }

  public function existBdd()
  {
    $stmt = Bdd::getDatabaseConnect()->prepare(" SELECT * FROM aimer
    WHERE id_user = :idUser and id_post = :idPost");
    $stmt->execute(
      [
        'idUser'      => $this->_idUser,
        'idPost'    => $this->_idPost
      ]
    );
    $user = $stmt->fetch();
    return $user;
  }
}
