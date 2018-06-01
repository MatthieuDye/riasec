<?php
class Grade
{
	public static function Get_Grade_Id($GradeCode)
	//Grade_Code => Grade_Id
	//données : $GradeCode est un str qui correspond au code d'inscription dans une classe
	//résultats : Récupère le Grade_Id correspond au Grade_Code (int)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_Id FROM Grade WHERE Grade_Code = '".$GradeCode."'");

		$req->execute();
		$data=$req->fetch();

		if(isset($data["Grade_Id"]))
		{
			return ($data["Grade_Id"]);
		}
		else
		{
			return (null);
		}
	}

	public static function Get_Grade_Section($GradeId)
	//Grade_Code => Grade_Section
	//données : $GradeCode est un str qui correspond au code d'inscription dans une classe
	//résultats : Récupère le Grade_Section correspond au Grade_Code (str)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_Section FROM Grade WHERE Grade_Id ='".$GradeId."'");
		$req->execute();
		$data=$req->fetch();
		
		if(isset($data["Grade_Section"]))
		{
			return ($data["Grade_Section"]);
		}
		else
		{
			return (null);
		}
	}

	public static function Get_Grade_Section_Year($GradeId)
	//Grade_Code => Grade_Section_Year
	//données : $GradeCode est un str qui correspond au code d'inscription dans une classe
	//résultats : Récupère le Grade_Section_Year correspond au Grade_Code (int)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_Section_Year FROM Grade WHERE Grade_Id ='".$GradeId."'");
		$req->execute();
		$data=$req->fetch();
		
		if(isset($data["Grade_Section_Year"]))
		{
			return ($data["Grade_Section_Year"]);
		}
		else
		{
			return (null);
		}
	}
	
	public static function Get_Grade_School_Year($GradeId)
	//Grade_Code => Grade_School_Year
	//données : $GradeCode est un str qui correspond au code d'inscription dans une classe
	//résultats : Récupère le Grade_School_Year correspond au Grade_Code (int)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_School_Year FROM Grade WHERE Grade_Id ='".$GradeId."'");
		$req->execute();
		$data=$req->fetch();
		
		if(isset($data["Grade_School_Year"]))
		{
			return ($data["Grade_School_Year"]);
		}
		else
		{
			return (null);
		}
	}
	
	public static function Get_Grade_Section_All()
	//=> [Grade_Section]
	//données :
	//résultats : Récupère les différentes valeurs des Grade_Section présents dans la BDD ([str])
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_Section FROM Grade");
		$req->execute();
		$GradeSection = [];
		while($data=$req->fetch())
		{
			$GradeSection[] = $data["Grade_Section"];
		}
		$GradeSection = array_unique($GradeSection); //Enleve les doublons
		
		if(isset($GradeSection))
		{
			return ($GradeSection);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Grade_Section_Year_All()
	//=> [Grade_Section_Year]
	//données :
	//résultats : Récupère les différentes valeurs des Grade_Section_Year présents dans la BDD ([int])
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_Section_Year FROM Grade");
		$req->execute();
		$GradeSectionyear = [];
		while($data=$req->fetch())
		{
			$GradeSectionYear[] = $data["Grade_Section_Year"];
		}
		$GradeSectionYear = array_unique($GradeSectionYear); //Enleve les doublons
		
		if(isset($GradeSectionYear))
		{
			return ($GradeSectionYear);
		}
		else
		{
			return ([]);
		}
	}
	
	public static function Get_Grade_School_Year_All()
	//=> [Grade_School_Year]
	//données :
	//résultats : Récupère les différentes valeurs des Grade_School_Year présents dans la BDD ([int])
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT Grade_School_Year FROM Grade");
		$req->execute();
		$GradeSchoolyear = [];
		while($data=$req->fetch())
		{
			$GradeSchoolYear[] = $data["Grade_School_Year"];
		}
		$GradeSchoolYear = array_unique($GradeSchoolYear); //Enleve les doublons
		
		if(isset($GradeSchoolYear))
		{
			return ($GradeSchoolYear);
		}
		else
		{
			return ([]);
		}
	}

	public static function Get_All_Grade()
	//=> [Grade]
	//données :
	//résultats : Récupère les différents Grade présents dans la BDD ([Grade])
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée
	   
		$req = $bdriasec->prepare("SELECT * FROM Grade");
		$req->execute();
		$data=$req->fetchAll();
		
		return $data;
	}

	public static function Update_Code($id,$code)
	//Grade_Id x Grade_Code => 
	//données : $id est un int correspondnt à l'id du Grade à modifier. $code est un str qui est le code que doit rentrer un ulisateur pour rentrer dans une classe
	//résultats : Modifie le Grade_Code avec $code dans la BDD ou le Grade_Id correspond à l'$id
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée

		$req = $bdriasec->prepare("UPDATE Grade SET Grade_Code =:code WHERE Grade_Id=:id");
		
		$req->bindParam(':code',$code);
		$req->bindParam(':id',$id);
		$req->execute();
	}

	public static function Supprimer_Classe($id)
	//Grade_Id => 
	//données : $id est un int correspondnt à l'id du Grade à supprimer.
	//résultats : Supprime le Grade dans la BDD ou le Grade_Id correspond à l'$id
	{

		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("DELETE FROM Grade WHERE Grade_Id='".$id."'");
		$req->execute();
	}

	public static function Add_Grade($section,$year,$schoolyear,$code)
	//Grade_Section x Grade_Section_Year x Grade_School_year x Grade_Code => 
	//données : $section str correspond au nom de la nouvelle section. $year int correspondant à l'année de la nouvelle section. $schoolyear int correspondant à l'annee. $code str correspondant au code que doit etrer l'ulisateur pour rejoindre la classe 
	//résultats : Crée le Grade avec les différentes informations entrées en donées.
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('INSERT INTO Grade(Grade_Section,Grade_Section_Year,Grade_School_Year, Grade_Code) VALUES (:section, :year,:schoolyear,:code)');
		
		$req->bindParam(':section',$section);
		$req->bindParam(':year',$year);
		$req->bindParam(':schoolyear',$schoolyear);
		$req->bindParam(':code',$code);

		$req->execute();
	}
	
	public static function Get_Grade_Id_From_String($stringWhere)
	//str => [Grade_Id]
	//données : $stringWhere str qu'il faudra entrée dans le WHERE de la raquete SQL 
	//résultats : Récupère les Grade_Id sortant de la requete SQL paramétre en WHERE par $stringWhere [int]
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT Grade_Id FROM Grade WHERE 1 = 1".$stringWhere);

		$req->execute();
		
		$results =[];
		while($data=$req->fetch())
		{
			$results[] = $data["Grade_Id"];
		}

		return $results; //Verifier si null
	}
}
?>