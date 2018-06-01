<?php
class Class
{
	public static function Get_Class_Section($classId)
	// Get_Class_Section : Int => String
	// données : $classId: int correspondant à l'identifiant d'une classe
	// résultats : renvoie un string qui est le libellé de la classe
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Class_Section FROM Class WHERE classId = ?");
		$req->execute(array($classId));
		$data=$req->fetch()
		
		if(isset($data["Class_Section"]))
		{
			return ($data["Class_Section"]);
		}
		else
		{
			return (null);
		}
	}
	
	public static function Get_Class_Section_All()
	// Get_Class_Section_All :  => []
	// données : Aucune
	// résultats : renvoie sous forme de tableau la liste des libellés de chaque classe existante
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Class_Section FROM Class");
		$req->execute();
		$classSection = [];
		while($data=$req->fetch())
		{
			$classSection[] = $data["Class_Section"];
		}
		$classSection = array_unique($classSection); //Enleve les doublons
		
		if(isset($classSection))
		{
			return ($classSection);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Class_Section_Year_All()
	// Get_Class_Section_Year_All :  => []
	// données : Aucune
	// résultats : renvoie sous forme de tableau la liste de chaque année (3, 4 ou 5) existante pour une section
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Class_Section_Year FROM Class");
		$req->execute();
		$classSectionyear = [];
		while($data=$req->fetch())
		{
			$classSectionYear[] = $data["Class_Section_Year"];
		}
		$classSectionYear = array_unique($classSectionYear); //Enleve les doublons
		
		if(isset($classSectionYear))
		{
			return ($classSectionYear);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Class_School_Year_All()
	// Get_Class_School_Year_All :  => []
	// données : Aucune
	// résultats : renvoie sous forme de tableau la liste des promotions existantes
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Class_School_Year FROM Class");
		$req->execute();
		$classSchoolyear = [];
		while($data=$req->fetch())
		{
			$classSchoolYear[] = $data["Class_School_Year"];
		}
		$classSchoolYear = array_unique($classSchoolYear); //Enleve les doublons
		
		if(isset($classSchoolYear))
		{
			return ($classSchoolYear);
		}
		else
		{
			return ([]);
		}
	}
}
?>