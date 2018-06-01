<?php
	require_once ('../model/User.php');


	
	
	
	$password = htmlspecialchars($_POST['password']);
	$password_check = htmlspecialchars($_POST['password_check']);
	

	


	if ( empty($password) || empty($password_check) ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif ($password != $password_check) {
		$messageErreur = 'Les mots de passe saisis ne sont pas identiques ! ';
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	
	}
	elseif (strlen($password)<6) {
		$messageErreur = 'Votre mot de passe doit faire plus de 6 caractères';
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		if (isset($_COOKIE['codeconnexion']))
		{
			$cookieId = $_COOKIE['codeconnexion'];
			
		}
		elseif (empty(htmlspecialchars($_POST['code']))) 
		{
			$messageErreur = 'Erreur 101 !';
		
			header("Location: ../Erreur.php?erreur=".$messageErreur);
		}
		else
		{
			$cookieId = htmlspecialchars($_POST['code']);
		}

		$id = User::Get_User_Id($cookieId);


		if (empty($id))
		{
			$messageErreur = 'Erreur 102 !';
		
			header("Location: ../Erreur.php?erreur=".$messageErreur);
		}
		else
		{
			$password = sha1(sha1($password));
			User::Update_Password($id,$password);
			require_once("Controller_Deconnexion.php");
		}
	
	}
	
?>