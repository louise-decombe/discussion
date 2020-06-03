

<?php

if(isset($_SESSION['login'])){
	echo "<h4>vous etes en ligne actuellement</h4> <br />";
	echo "<a href=profil.php>voir mon profil </a> ou <a href=index.php>retour à l'accueil </a> ou <a href=discussion.php>
	voir le chat</a> ";

	exit;
}
//si la connexion est faite depuis la formulaire et le bouton submit
if(isset($_POST['submit']))
{
	// vérification que les champs de login et password sont bien remplis
	if (empty($_POST['login']))
	{
		echo "<h2><i>il manque votre login.</i></h2>";
	}
	else
	{
		if(empty($_POST['password']))
		{
			echo "<h2><i>il manque votre mot de passe.</i></h2>";
		}
		else {

			$login= htmlentities($_POST['login']);
			$password= htmlentities($_POST['password']);
//connexion à la base de donnée
$mysqli= mysqli_connect ("localhost","root","","discussion");

if(!$mysqli){
	echo "erreur de connexion";
}
	else {
//si la session démarre, redirection vers la page de profil de l'utilisateur
	$_SESSION['login'] = $login;
echo "vous êtes connecté";
header('location: profil.php');
}
}
}
}
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
<a href="inscription.php">Inscription</a>

</header>

<main>

<div class="titre_inscription">
  <h2>connexion</h2>
  <p>Vous pouvez vous connecter ici</p>
</div>

<div class="form_img">

  <form class="" action="connexion.php" method="post">
  <p>Votre login</p>
  <input type="text" name="login" value="">
  <p>Votre mot de passe</p>
  <input type="password" name="password" value="">
  <p>Confirmez votre mot de passe</p>

  <input type="submit" name="submit" value="submit">
  </form>


</div>

</main>

<footer>
<p> Retrouvez-nous sur gitub ou insta</p>

</footer>

  </body>
</html>
