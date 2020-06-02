<?php

session_start() ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  </head>
  <body>
<header>
  <?php
  if(isset($_SESSION['login'])){
    echo ' <a href="profil.php">Tu es connecté  '.$_SESSION['login'].'</a>'.'  <a href="profil.php">Voir mon profil</a>';
  }
  else {
    echo "<a href='connexion.php'> connexion </a>";
  }?>
</header>

<main>
  <div class="titre">

  <h2><img src="https://img.icons8.com/pastel-glyph/64/000000/cat--v2.png"/>
Bienvenue sur le chat </h2>
  <p>Inscrivez-vous et discutez avec vos proches. <br /> C'est très simple il vous suffit d'une minute pour faire un profil.</p>
</div>

<div class="acces">
  <a href="connexion.php">Connectez-vous</a>
  <a href="inscription.php">Inscrivez-vous</a>
</div>

</main>

<footer>
<p> Retrouvez-nous sur gitub ou insta</p>

</footer>

  </body>
</html>
