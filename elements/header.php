<header class="header">
  <div class="logo--container">
    <p>Youtaites</p>
  </div>
  <nav>
    <ul class="nav--list">
      <li class="nav--item"><a href="./accueil.php">Accueil</a></li>
      <li class="nav--item">Recrutement</li>
      <li class="nav--item">Tutoriel</li>
      <li class="nav--item">Catégories</li>
    </ul>
  </nav>
  <div class="btn--container">
    <button class="btn"><a href="./topicsCreate.php">Nouveau Topic</a></button>
  </div>
  <div class="userImg--container">
    <div class="logOut"><a href="../controller/deconnexion.php">Déconnexion</a></div>
    <img class="userImg--cover" src="<?php echo $_SESSION['user']->picture(); ?>" alt="">
  </div>
</header>