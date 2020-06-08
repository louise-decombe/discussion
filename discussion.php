<?php


// la session démarre

session_start();

// action de déconnexion et redirection vers la page d'accueil

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

// si l'utilisateur est connecté le header est personnalisé sinon il invite à la connexion

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
  <input type="submit" value="poster" name="poster" />

</div>
    </form>
  </div>
    <?php
// si l'utilisateur est connecté les messages s'affichent

  if(isset($_SESSION['login'])){

  try
  {
  	$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', '');
  }
  catch(Exception $e)
  {
          die('Erreur : '.$e->getMessage());
  }

// requête pour accéder à la base de donnée


$reponse = $bdd->query(' SELECT message, id_utilisateur, date, login FROM messages inner join utilisateurs on utilisateurs.id = messages.id_utilisateur
    ORDER BY date DESC ');

 $donnees = $reponse->fetch();


// début de la boucle qui permet d'afficher les messages





while ($donnees = $reponse->fetch())
{
  echo '<p><strong><div class="chat">'.htmlspecialchars($donnees['date']).'--->' .htmlspecialchars($donnees['login']) . '</strong> : ' . htmlspecialchars($donnees['message']) .'</div></p>';
}
//fin de la requête
$reponse->closeCursor();
}





else {

  echo "<h4>vous n'êtes pas connecté</h4> <br />";
  echo "<a href=inscription.php>vous inscrire </a> ou <a href=connexion.php>vous connecter </a> ou <a href=index.php>
    retourner à l'accueil</a> ";
  exit;

}
?>

<?php
    if (isset($_POST['poster']))

// requête sql pour mettre le message dans la base de donnée

{

  try{
                  $dbco = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', '');

                  $id= ($_SESSION['id']);

                  $message=($_POST['message']);

                  date_default_timezone_set('Europe/Paris');
                  $date=date('Y-m-d h:i:s');

                  $sql = "INSERT INTO `messages`( `message`,`date`,`id_utilisateur`) VALUES ('$message','$date','$id')";
                  $dbco->exec($sql);

                  echo "<br /><i>votre message a été posté</i>";
                  header("Refresh: 2; url=discussion.php");

                }


              catch(PDOException $e){
                  $dbco->rollBack();
                echo "Erreur : " . $e->getMessage();
              }


}

    ?>


    </body>
</html>
