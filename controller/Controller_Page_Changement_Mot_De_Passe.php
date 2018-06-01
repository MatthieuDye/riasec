<?php
require_once ("controller/Controller_Test_User.php");
offlineOnly();


require_once('model/User.php');


$code = htmlspecialchars($_GET['code']);


$id=User::Get_User_Id($code);

if (empty($id))
{
	$messageErreur = 'Lien expiré ou invalide, recommencez la procedure de mot de passe oublié ! ';

	header("Location: ../Erreur.php?erreur=".$messageErreur);
}
else
{
	require_once("view/changement_mot_de_passe.php");
}




?>