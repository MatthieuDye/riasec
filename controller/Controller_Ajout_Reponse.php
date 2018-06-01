<?php
	require_once ('../model/Answer.php');
	require_once ("../model/User.php");
	require_once ("../model/Question.php");

	$cookieId = $_COOKIE['codeconnexion'];

	$id = User::Get_User_Id($cookieId);


	$idquestion1 = htmlspecialchars($_POST['answer1']);
	$idquestion2 = htmlspecialchars($_POST['answer2']);
	$idquestion3 = htmlspecialchars($_POST['answer3']);
	
	
	




	if (empty($idquestion1) || empty($idquestion2) || empty($idquestion3) ) {
		$messageErreur = "Vous n'avez pas selectionné assez de propositions ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif ($idquestion1==$idquestion2 || $idquestion2==$idquestion3 || $idquestion1==$idquestion3) {
		$messageErreur = "Choix invalides ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	elseif (empty(Question::Get_Question_Theme_Id($idquestion1)) || empty(Question::Get_Question_Theme_Id($idquestion2)) || empty(Question::Get_Question_Theme_Id($idquestion3))) {
		
		$messageErreur = "Choix invalides ! ";
		
		header("Location: ../Erreur.php?erreur=".$messageErreur);
	}
	else
	{
		
		Answer::Add_Answer($id,$idquestion1,3);
		Answer::Add_Answer($id,$idquestion2,2);
		Answer::Add_Answer($id,$idquestion3,1);


		header("Location: ../Test.php");
	}
	
?>