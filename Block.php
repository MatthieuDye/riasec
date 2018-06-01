<?php
class Block
{
	public static function Get_Block_Number($BlockId)
	//Block_Id => Block_Number
	//données : $BlockId int correspondant à l'id d'un block de question
	//résultats : Block_Number int qui correspond au numéro du block de question
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Block_Number FROM Block WHERE Block_Id = ?");
		$req->execute(array($BlockId));
		$data = $req->fetch()["Block_Number"];
		if(empty($data))
		{
			return 0;
		}
		else
		{
			return ($data);
		}
	}
	
	public static function Get_Max_Block_Number()
	// => Int
	//données : 
	//résultats : renvoie le plus haut numéro de block de question présent dans la BDD
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT MAX(Block_Number) AS Max_Block_Number FROM Block ");
		$req->execute(array($BlockId));
		return ($req->fetch()["Max_Block_Number"]);
	}
}
?>