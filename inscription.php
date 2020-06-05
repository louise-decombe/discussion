
<?php
// la session démarre
session_start();

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
        <li><a href="connexion.php">connexion</a></li>
        </ul>
      <?php  }?>

    </header>
<main>

  <?php
// si l'utilisateur est inscrit redirection vers la page de son choix
if (isset($_SESSION['login'])) {
    echo "<h4>vous etes en ligne actuellement</h4> <br />";
    echo "<a href=profil.php>voir mon profil </a> ou <a href=index.php>retour à l'accueil </a> ou <a href=discussion.php>
      Voir le chat</a> ";

    exit;
}
?>

<?php
// fichier de connexion à la bdd nécessaire pour continuer
require('config.php');
//si le bouton submit est cliqué
if (isset($_POST['submit'])) {
	// si les champs login et password sont vides, dire qu'il manque un champs
    if (empty($_POST['login']) AND empty($_POST['password'])) {
        echo 'il manque un champs';
    } else {
// définition des variables de log et de pass
        $log = stripslashes($_POST['login']);
        $log = mysqli_real_escape_string($conn, $log);

        $pass = stripslashes($_POST['password']);
        $pass = mysqli_real_escape_string($conn, $pass);

        $query = " INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$log', '".hash('sha256', $pass)."')";
        echo $query;

        $res = mysqli_query($conn, $query);

        if ($res) {

            header('location:connexion.php');

        }
    }

}


?>

<div class="titre_inscription">
</div>

<div class="login-box">
  <h2>Inscription</h2>


      <form action="inscription.php" method="post">

        <p>  Veuillez remplir ce formulaire pour vous inscrire:</p><br />
              <label>Nom d'utilisateur</label>
              <div class="user-box">
              <input type="text" name="login"> <br />
            </div>
              <label>Mot de passe</label>
              <div class="user-box">

              <input type="password" name="password" /><br />
            </div>

            <div class="wrapper">
              <span class="bounce_button">
                <input type="submit" name="submit" value="submit">
              </span>
             </div>

      </form>

</div>

</main>


  </body>
</html>
