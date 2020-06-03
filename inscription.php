
<?php
// la session démarre
session_start();

?>
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

        var_dump($log);
        var_dump($pass);

				// requête pour insérer le nouvel utilisateur dans la bdd

        $query = " INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$log', '$pass')";
        echo $query;

        var_dump($query);

        $res = mysqli_query($conn, $query);
        var_dump($res);

        if ($res) {
            echo "azerty";
            header('location:connexion.php');

        }
    }

}


?>

<div class="titre_inscription">
  <h2>Inscription</h2>
  <p>Vous pouvez-vous inscrire ici</p>
</div>

<div class="form_img">

      <form action="inscription.php" method="post">

          Veuillez remplir ce formulaire pour vous inscrire:<br />
              <label for="login">Nom d'utilisateur</label><input type="text" name="login"> <br />
              <label for="password">Mot de passe</label><input type="password" name="password" /><br />
              <input type="submit" value="submit" name="submit" />

      </form>

  <img src="img/inscription.jpeg" alt="illustration inscription">

</div>

</main>

<footer>
<p> Retrouvez-nous sur gitub ou insta</p>

</footer>

  </body>
</html>
