<?php

require_once ("../model/User.php");

	$cookieId = $_COOKIE['codeconnexion'];

	$id = User::Get_User_Id($cookieId);
	$name = htmlspecialchars($_POST['name']);
	$firstName = htmlspecialchars($_POST['firstname']);
	$gender = htmlspecialchars($_POST['gender']);
	$mail = htmlspecialchars($_POST['email']);
	$mailverif=User::Check_Mail($mail);


	if (empty($name) || empty($firstName) || empty($gender) || empty($mail) ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
		$messageErreur = "Votre email n'est pas valide  ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(is_null($mailverif['memberId']))) {
		$messageErreur = "Ce mail est déjà associé à un compte !";
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		User::Update_User($name,$firstName,$gender,$mail,$id);
		header("location: ../Profil.php");
	}





?>