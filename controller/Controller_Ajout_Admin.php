<?php

require_once ("../model/User.php");

$mail=htmlspecialchars($_POST['mail']);
$userMail = User::Check_Mail($mail);
$userId=$userMail['User_Id'];

if(!empty($userMail))
{
	$ajout=User::Set_User_Role($userId,1);
	header('Location:../Gestion_Liste_Admins.php');
}
else 
{
	$messageErreur = "Adresse mail inconnue ! ";
	
	header("Location: ../Erreur.php?erreur=".$messageErreur);
}
	

?>