<?php
class Answer
{
	public static function Get_Answer_User($userId)
	//user_Id => [Question_Id => Answer_Value] 
	//données : $userId int correspondant à l'id d'un utilisateur
	//résultat : tableau contenant les réponses de l'utilisateur pour chaque question
	{
		require_once('Pdo.php');
		$bdriasec = connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Question_Id, Answer_Value FROM Answer WHERE User_Id = ?");
		$req->execute(array($userId));
		while($data=$req->fetch())
		{
			$answers[$data["Question_Id"]] = $data["Answer_Value"];
		}
		//Récupérer toute les réponses sur chaques questions de l'utilisateur 
		
		if(isset($answers))
		{
			return ($answers);
		}
		else
		{
			return ([]);
		}
	}
	
	
	public static function Get_Answer_All()
	// => [Question_Id => Answer_Value]
	//résultat : tableau contenant les réponses de chaque utilisateur pour chaque question
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Question_Id, Answer_Value FROM Answer");
		$req->execute();
		while($data=$req->fetch())
		{
			$answers[$data["Question_Id"]] = $data["Answer_Value"];
		}
		//Récupérer toute les réponses sur chaques questions
		
		if(isset($answers))
		{
			return ($answers);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Answer_All_User_Id()
	// => [User_Id]
	//résultat : un tableau contenant tous les id utilisateurs de chaque réponse de la base de données
	{
		
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT User_Id FROM Answer");
		$req->execute();
		while($data=$req->fetch())
		{
			$answersId[] = $data["User_Id"];
		}
		//Récupérer toute les réponses sur chaques questions
		
		if(isset($answersId))
		{
			return ($answersId);
		}
		else
		{
			return ([]);
		}
	}

	public static function Add_Answer($userId,$questionId,$answer)
	//User_Id x Question_Id x Answer_Value => 
	//données : $userId int correspondant à l'id utilisateur, $questionId int correspondant à l'id de la question, $answer int correspondant à la valeur de la réponse (1<=$answer<=30)
	//résultat : modifie la base de données en ajoutant une entité à la classe "Answer" en fonction des données entrées
	{		
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('INSERT INTO Answer(Answer_Value,Question_Id, User_Id) VALUES (:answer,:question,:user)');
		$req->bindParam(':answer',$answer);
		$req->bindParam(':question',$questionId);
		$req->bindParam(':user',$userId);

		$req->execute();
	}

	public static function Get_Max_Block_User($userId)
	//User_Id => Block_Id
	//données : $userId int correspondant à l'id utilisateur
	//résultat : int correspondant à l'id du premier block de questions auxquelles l'utilisateur n'a pas répondu
	{
		
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT * FROM Answer WHERE User_Id = :userId");
		$req->bindParam(':userId',$userId);
		$req->execute();
		$data=$req->fetchAll();

		
		$totalValues = 0; //Car on veux etre au 1er groupe de question non répondu 
		foreach($data as $row)
		{
			$totalValues+=$row['Answer_Value'];
		}
		$totalValues=($totalValues/6)+1;
		return $totalValues;
	}

	public static function Delete_All_Answer_User($userId)
	//User_Id => 
	//données : $userId int correspondant à l'id utilisateur
	//résultat : modifie la base de données en supprimant une entité de la classe "Answer" en fonction des données entrées
	{
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("DELETE FROM Answer WHERE User_Id='".$userId."'");
		$req->execute();
	}

}
?>