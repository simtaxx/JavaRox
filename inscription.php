<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inscription</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=League+Script&display=swap" rel="stylesheet">
</head>

<body class="sign-up">
  <section class="container">
    <?php require './bootstrap.php';
    ?>

    <h1 class="log--title">Youtaites</h1>

    <div class="message">
      <p>Vous pouvez créer votre compte</p>
    </div>

    <?php if (isset($_GET['message'])) { ?>

      <p><?php echo $_GET['message'] ?><p>

        <?php } ?>

        <form action="register.php" method="POST" enctype="multipart/form-data">
          <div class="form__inputs">
            <div class="form__inputs--left">
              <input class="sign__input" type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
              <input class="sign__input" type="email" name="email" id="email" placeholder="Adresse e-mail">
              <input class="sign__input" type="password" name="mdp1" id="mdp1" placeholder="Mot de passe">
              <input class="sign__input" type="password" name="mdp2" id="mdp2" placeholder="Mot de passe">
            </div>
            <div class="form__inputs--right">
              <input class="sign__input" type="text" name="website" id="website" placeholder="Lien de votre site (facultatif)">
              <textarea class="sign__input" name="description" id="description" cols="30" rows="10" placeholder="Votre bio (facultatif)"></textarea>
              <div class="add__img">
                <label for="file">Ajouter une photo de profil</label>
                <input class="test" id="file" type="file" name="image"/>
              </div>
            </div>
          </div>

          <div class="form__button">
            <input class="submit__button" type="submit" value="Valider" name="valider">
          </div>
        </form>

        <aside class="terms terms--sign">
          <p>Vous êtes déjà un Youtaite ?</p><strong><a href="./index.php">Connectez-vous</a></strong>
        </aside>

        <div class="conditions">
          <p>En créant votre compte, vous confirmez que vous avez lu et accepté les <strong>Termes de service</strong></p>
        </div>

  </section>

  <!-- <?php require './elements/footer.php' ?> -->
</body>

</html>