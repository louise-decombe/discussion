<?php
session_start();
require('config.php');
session_id();

//si la demande déconnexion existe, fin de la session
if (isset($_GET['deconnexion'])) {

    unset($_SESSION['login']);
    //au bout de 2 secondes redirection vers la page d'accueil
    header("Refresh: 2; url=index.php");

    echo "<p>Vous avez été déconnecté</p><br><p>Redirection vers la page d'accueil...</p>";
}
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="discussion.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Profil</title>
  </head>
  <body>
    <header>
      <?php

// si l'utilisateur est connecté le header est personnalisé

      if(isset($_SESSION['login'])){
        echo '<ul><li> <a href="index.php">Accueil</a></li>'.'<li><a href="profil.php">   Vous êtes connecté(e)     '.$_SESSION['login'].'</a></li>'.'<li><a href="discussion.php"> accéder au chat </a></li>'.'<li><a href="profil.php?deconnexion">
            Déconnexion </a></li></ul>' ;
      }
      else { ?>
        <ul>
        <li><a href="index.php">accueil</a></li>
        <li><a href="inscription.php">inscription</a></li>
        </ul>
      <?php  }?>

    </header>

<main>

</main>
<?php

// l'utilisateur connecté à accès à son profil

if (isset($_SESSION['login'])) {
echo ' <div class="profil"> Votre espace ' . $_SESSION['login'] . '</div>';
} else {
echo "<a href='connexion.php'> connexion </a>";
}
?>

<?php

if(isset($_SESSION['login'])){

$login=$_SESSION['login'];

if (isset($_POST['submit'])){

$newlog=$_POST['newlog'];
$newpass = $_POST['newpass'];


// l'utilisateur peut modifier ses informations qui vont être changéesdans la base de donnée


// maj du login

if ($newlog){
  $query= mysqli_query($conn, "SELECT * FROM utilisateurs WHERE login='$login'" );
  $row=mysqli_num_rows($query);
  if ($row==1){
    $logactuel= mysqli_query($conn, "UPDATE utilisateurs SET login='$newlog' WHERE login='$login' ");
    echo "changement réussis !";
  }
  else {

'incorrect';
  }
}

// maj du mot de passe

if($newpass) {

  $query= mysqli_query($conn, "SELECT * FROM utilisateurs WHERE login='$login'" );
  $row=mysqli_num_rows($query);

  if ($row==1){
    $newpass = mysqli_query($conn, "UPDATE utilisateurs SET password='$newpass' WHERE login='$login'");
    die("Votre mot de passe a bien été modifié. Vous pouvez vous <a href='connexion.php'>connecter</a>.");
  }
  }
  else {
    echo 'remplir le champs';
  }
}

}


 ?>

 <form class="" action="profil.php" method="post">

   <div class="login-box">

<h2>Modification profil</h2>
<label> Nouveau login </label>
<div class="user-box">
<input type="text" name="newlog" value="">
</div>
<label>Nouveau mot de passe</label>
<div class="user-box">
<input type="password" name="newpass" value="">
</div>
<input type="submit" name="submit" value="valider">

 </form>
</div>


  </body>
</html>
