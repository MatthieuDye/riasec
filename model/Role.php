<?php
class Role
{
	public static function Get_Role_Title($roleId)
	//Role_Id => [Role_Title]
	//données : $roleId int correspondant à l'id du rôle
	//résultat : string correspondant à l'intitulé du rôle ayant l'id $roleId
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 

		$req = $bdriasec->prepare("SELECT Role_Title FROM Role WHERE Role_Id = ?");
		$req->execute(array($roleId));
		$data=$req->fetch();

		return ($data['Role_Title']);
	}
}
?>