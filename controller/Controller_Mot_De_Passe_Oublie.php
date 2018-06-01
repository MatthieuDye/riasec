<?php
	require_once ('../model/User.php');


	
	$mail = htmlspecialchars($_POST['email']);
	
	

	$mailverif=User::Check_Mail($mail);


	if (empty($mail) ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	
	}
	elseif (!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
		$messageErreur = "Votre email n'est pas valide  ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (is_null($mailverif['User_Id'])) {
		$messageErreur = "Ce mail n'est pas associé à un compte !";
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		
		$cookie=$mailverif['User_Cookie_Code'];
		include_once("../email/Email_Mot_De_Passe_Oublie.php");

		$messageValidation = "Un mail contenant un lien de reinitialisation vient de vous être envoyé !  ";
		header("Location: ../Validation.php?validation=".$messageValidation);
	}
	
?>