<?php
	require_once ('../model/Grade.php');


	$section = htmlspecialchars($_POST['section']);
	$year = htmlspecialchars($_POST['year']);
	$schoolyear = htmlspecialchars($_POST['promotion']);
	$code = htmlspecialchars($_POST['code']);
	
	




	if (empty($section) || empty($year) || empty($schoolyear) || empty($code)  ) {
		$messageErreur = "Vous n'avez pas remplis tous les champs ! Merci de completer les champs manquants ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		
		Grade::Add_Grade($section,$year,$schoolyear,$code);


		header("Location: ../Gestion_Admin_Classes.php");
	}
	
?>