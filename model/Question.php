<?php
class Question
{
	public static function Get_Question_Theme_Id($questionId)
	// Get_Question_Theme_Id: Int => Int
	// Données: un Int qui est l'identifiant d'une question
	// Résultat: Renvoie un Int qui est l'identifiant du thème auquel appartient la question
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 
	   
		$req = $bdriasec->prepare("SELECT Theme_Id FROM Question WHERE Question_Id = ?");
		$req->execute(array($questionId));
		$data=$req->fetch();
		return ($data["Theme_Id"]);
	}
	
	public static function Get_All_Question()
	// Get_All_Question:  => []
	// Données: Aucune
	// Résultat: Renvoie toutes les questions et leurs attributs sous forme de tableau
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
		
		$req = $bdriasec->prepare("SELECT * FROM Question");
		$req->execute();
		$data=$req->fetchAll();
		
		return $data;
	}
	
	public static function Set_Question_Title($questionId,$questionTitle)
	// Get_All_Question: Int x String
	// Données: $questionId un Int qui est l'identifiant de la question et $questionTitle un String qui est le libellé que l'on souhaite définir pour la question
	// Résultat: Ne renvoie rien (permet de faire une mise à jour du texte de la question)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
		
		$req = $bdriasec->prepare('UPDATE Question SET Question_Title = :questionTitle WHERE Question_Id = :questionId');
		$req->bindParam(':questionTitle',$questionTitle);
		$req->bindParam(':questionId',$questionId);
		$req->execute();
	}

	public static function Get_Question_Block($numBlock)
	// Get_All_Question: Int => []
	// Données: $numBlock, un Int qui est le numéro d'un groupe de questions
	// Résultat: Renvoie sous la forme d'un tableau toutes les questions d'un groupe
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
		
		$req = $bdriasec->prepare("SELECT * FROM Question Where Block_Id=(SELECT Block_Id From Block WHERE Block_Number=:numBlock)");
		$req->bindParam(':numBlock',$numBlock);
		$req->execute();
		$data=$req->fetchAll();
		
		return $data;
	}
}

?>