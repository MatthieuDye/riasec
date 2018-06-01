<?php
require_once ("../model/User.php");


$mdp = htmlspecialchars($_POST["password"]);
$mail = htmlspecialchars($_POST["email"]);


if (empty($mdp) || empty($mail)) {
	$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
	
	header("Location: ../Erreur.php?erreur=".$messageErreur);
}
elseif (!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
	$messageErreur = "Votre email n'est pas valide  ! ";
	
	header("Location: ../Erreur.php?erreur=".$messageErreur);
}
else
{
	$mdp = sha1(sha1(htmlspecialchars($mdp)));
	if(User::Check_Password($mdp,$mail))
	{
		$cookiecode=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

		setcookie("codeconnexion", $cookiecode, time()+(500), "/");

		User::Set_User_Coockie_Code($mail,$cookiecode);
		header("Location: ../Accueil.php");
	}
	else
	{
		$messageErreur = "Email ou mot de passe erroné ";
	
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
}
?>