<?php
class Theme
{
	public static function Get_All_Theme()
	// => [Theme_Id => Theme_Title]
	//résultat : tableau contenant les intitulés des thèmes pour chaque thème
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 

	   $req = $bdriasec->prepare("SELECT Theme_Id, Theme_Title FROM Theme");
		$req->execute();
		while($data=$req->fetch())
		{
			$allTheme[$data["Theme_Id"]] = $data["Theme_Title"];
		}
		if(isset($allTheme))
		{
			return ($allTheme);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Theme_Title($themeId)
	// Theme_Id => Theme_Title
	//données : $themeId int qui est l'identifiant du theme recherché
	//résultat : récupère le Theme_title correspondant au $themeId dans la BDD
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 

	    $req = $bdriasec->prepare("SELECT Theme_Title FROM Theme WHERE Theme_Id = ?");
		$req->execute(array($themeId));
		$data=$req->fetch();
		if(isset($data["Theme_Title"]))
		{
			return ($data["Theme_Title"]);
		}
		else
		{
			return ([]);
		}
	}
}

?>