
<?php

// la session démarre le fichier de connexion à la BDD est appelé

session_start();
require('config.php');

// Si l'utilisateur est loggé le header est personnalisé

if (isset($_SESSION['login'])) {
    echo "<h4>vous etes en ligne actuellement</h4> <br />";
    echo "<a href=profil.php>voir mon profil </a> ou <a href=index.php>retour à l'accueil </a> ou <a href=discussion.php>
      Voir le chat</a> ";

    exit;
}

// si l'utilisateur veut se connecter vérification de ses informations

if (isset($_POST['login'])){
  $login = stripslashes($_POST['login']);
  $login = mysqli_real_escape_string($conn, $login);
  $_SESSION['login'] = $login;
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);

// requête et exécution pour de la recherche dans la base de donnée

$query = "SELECT * FROM `utilisateurs` WHERE login='$login'
  and password='".hash('sha256', $password)."'";

  $result = mysqli_query($conn,$query) or die(mysql_error());

// si l'utilisateur est reconnu la session démarre et envoie l'utilisateur sur sa page profil

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $user['id'];
      $_SESSION['login'] = $login;
    header('location: profil.php');
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="discussion.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Inscription</title>
  </head>
  <body>

    <header>
      <?php
      if(isset($_SESSION['login'])){
        echo '<ul> <li><a href="profil.php">   Vous êtes connecté(e)      '.$_SESSION['login'].'</a></li>'.' <li> <a href="profil.php">Votre profil</a></li></ul>';
      }
      else { ?>
        <ul>
        <li><a href="index.php">accueil</a></li>
        <li><a href="inscription.php">inscription</a></li>
        </ul>
      <?php  }?>

    </header>

<main>

<div class="login-box">
  <h2>Connexion</h2>
  <div class="user-box">
  <form class="" action="connexion.php" method="post">
  </div>
  <label>Votre login</label>
  <div class="user-box">
  <input type="text" name="login" value="">
</div>
  <label>Votre mot de passe</label>
    <div class="user-box">
  <input type="password" name="password" value="">
</div>


<div class="wrapper">
  <span class="bounce_button">
    <input type="submit" name="submit" value="submit">
  </span>
 </div>


</div>
  </form>
</div>

</main>



  </body>
</html>
