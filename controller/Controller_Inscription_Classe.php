<?php
	require_once ('../model/User.php');


	$name = htmlspecialchars($_POST['name']);
	$firstName = htmlspecialchars($_POST['firstname']);
	$name=strtolower($name);
	$firstName=strtolower($firstName);

	$gender = htmlspecialchars($_POST['gender']);
	$mail = $firstName.".".$name."@etu.umontpellier.fr";
	$password = htmlspecialchars($_POST['password']);
	$password_check = htmlspecialchars($_POST['password_check']);
	$grade = htmlspecialchars($_POST['grade']);
	
	
	$mailverif=User::Check_Mail($mail);


	if (empty($name) ||  empty($gender) || empty($firstName) || empty($password) || empty($password_check) ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif ($password != $password_check) {
		$messageErreur = 'Les mots de passe saisies ne sont pas identiques ! ';
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (strlen($password)<6) {
		$messageErreur = 'Votre mot de passe doit faire plus de 6 caractères';
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
		$messageErreur = "Votre email n'est pas valide  ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (!(empty($mailverif['User_Id']))) {
		$messageErreur = "Ce mail est déjà associé à un compte !";
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		$password = sha1(sha1($password));
		
		User::Add_User($gender,$name,$firstName,$password,$mail);

		User::Set_User_Grade($mail,$grade);

		$cookiecode=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
			

			setcookie('codeconnexion', $cookiecode, time()+(300), "/");

			User::Set_User_Coockie_Code($mail,$cookiecode);
		
		header( "Location: ../Accueil.php");
	}
?>