<?php
class Block
{
	public static function Get_Block_Number($BlockId)
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