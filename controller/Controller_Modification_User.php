<?php
	require_once ('model/User.php');


	$name = htmlspecialchars($_POST['name']);
	$firstName = htmlspecialchars($_POST['firstname']);
	$gender = htmlspecialchars($_POST['gender']);
	$mail = htmlspecialchars($_POST['email']);
	

	$mailverif=User::Check_Mail($mail);


	if (empty($name) || empty($firstName) || empty($mail) || empty($gender) ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
		$messageErreur = "Votre email n'est pas valide  ! ";
		
		header("Location: Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(empty($mailverif['User_Id']))) {
		$messageErreur = "Ce mail est déjà associé à un compte !";
		header("Location: Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		
		User::Update_User($gender,$name,$firstName,$mail);
						
		
		header("Location: Modification_User.php");
	}
	
?>