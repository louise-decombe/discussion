<?php

session_start(); ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Inscription</title>
  </head>
  <body>

<header>
<a href="index.php">Accueil</a>
<a href="inscription.php">Inscription</a>

</header>

<main>
  <?php


  if(isset($_SESSION['login'])){
  	echo "<h4>vous etes en ligne actuellement</h4> <br />";
    echo "<a href=profil.php>voir mon profil </a> ou <a href=index.php>retour à l'accueil </a> ou <a href=discussion.php>
    Voir le chat</a> ";

  	exit;
  } ?>

<div class="titre_inscription">
  <h2>Connexoin</h2>
  <p>Vous pouvez vous connecter ici</p>
</div>

<div class="form_img">

  <form class="" action="connexion.php" method="post">
  <p>Votre login</p>
  <input type="text" name="login" value="">
  <p>Votre mot de passe</p>
  <input type="password" name="password" value="">
  <p>Confirmez votre mot de passe</p>
  <input type="password" name="password2" value="">
  <br />
  <input type="submit" name="submit" value="Connexion">
  </form>


</div>

</main>

<footer>
<p> Retrouvez-nous sur gitub ou insta</p>

</footer>

  </body>
</html>
