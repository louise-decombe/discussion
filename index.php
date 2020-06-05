<?php

session_start() ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="discussion.css">
    <title>accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  </head>
  <body>

<header>
  <?php
  if(isset($_SESSION['login'])){
    echo '<ul> <li><a href="profil.php">   Tu es connecté(e)      '.$_SESSION['login'].'</a></li>'.'<li><a href="discussion.php"> accéder au chat </a></li>'.'<li><a href="profil.php?deconnexion"> deconnexion </a></li></ul>';
  }
  else { ?>
    <ul>
    <li><a href="connexion.php">connexion</a></li>
    <li><a href="inscription.php">inscription</a></li>
    </ul>
  <?php  }?>

</header>

<main>
  <div class="titre">

  <h2><img src="https://img.icons8.com/pastel-glyph/64/000000/cat--v2.png"/>
Bienvenue sur le chat </h2>
  <p>Inscrivez-vous et discutez avec vos proches. <br /> C'est très simple il vous suffit d'une minute pour faire un profil.</p>
</div>


<div class="conteneur-flexible">
  <div class="element-flexible"> <a href="connexion.php">connexion</a> </div>
  <div class="element-flexible"> <a href="inscription.php">inscription</a>  </div>
</div>


</main>


  </body>
</html>
