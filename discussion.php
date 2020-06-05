<?php

session_start();
require('config.php');
if (isset($_GET['deconnexion'])) {

    unset($_SESSION['login']);
    //au bout de 2 secondes redirection vers la page d'accueil
    header("Refresh: 2; url=index.php");

    echo "<p>Vous avez été déconnecté</p><br><p>Redirection vers la page d'accueil...</p>";
}
 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Discussion fil</title>
        <link rel="stylesheet" href="discussion.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    </head>

    <header>
      <?php
      if(isset($_SESSION['login'])){
        echo '<ul><li> <a href="index.php">Accueil</a></li>'.'<li><a href="profil.php">   Vous êtes connecté(e)     '.$_SESSION['login'].'</a></li>'.'<li><a href="profil.php?deconnexion">
            Déconnexion </a></li></ul>' ;
      }
      else { ?>
      <?php  }?>

    </header>
  </div>

    <body>
      <div class="login-box">

    <form action="discussion.php" method="post">
        <label for="message">Message</label> :  <input type="text" name="message"><br />
<br/>

<div class="sub-message">
  <input type="submit" value="poster" />

</div>
    </form>
  </div>
    <?php

    if (isset($_POST['poster'])){


      $id=("SELECT * FROM messages INNER JOIN utilisateurs ON message.id_utilisateur = utilisateurs.id");
      $message=($_POST['message']);

      date_default_timezone_set('Europe/Paris');
      $date=date('Y-m-d h:i:s');
      $query= mysqli_query($conn, "INSERT INTO `messages`( `message`,`date`,`id_utilisateur`) VALUES ('$message','$date','$id')");

      echo $query;

      $res = mysqli_query($conn, $query);

      if ($res) {

          header('location:discussion .php');
          echo "message posté!";

    }

    }
    else {
      echo "le message est vide";
    }

  if (isset($_SESSION['login'])){

    $reponse = $conn->query('SELECT message, id_utilisateur, date, login FROM messages, utilisateurs
            WHERE messages.id_utilisateur = utilisateurs.id ORDER BY date DESC ');
      $donnees = $reponse->fetch_assoc();

    while ($donnees = $reponse->fetch_assoc())
    {
     echo $donnees['message'].'<br />'.'posté le :   '. $donnees['date'] . '<br />'. 'par     '. $donnees['login']. '<br />';
    }



}
else {

  echo "<h4>vous n'êtes pas connecté</h4> <br />";
  echo "<a href=inscription.php>vous inscrire </a> ou <a href=connexion.php>vous connecter </a> ou <a href=index.php>
    retourner à l'accueil</a> ";
  exit;

}
    ?>
    </body>
</html>
