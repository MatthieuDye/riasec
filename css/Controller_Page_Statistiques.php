<?php
require_once ("controller/Controller_Test_User.php");
adminOnly();

require_once ("model/User.php");
require_once ("model/Answer.php");
require_once ("model/Grade.php");
require_once ("model/Theme.php");

$answerAllUserId = Answer::Get_Answer_All_User_Id();
foreach($answerAllUserId as $userId)
{
	$user = User::Get_User($userId);
	$answerAllGender[] = htmlspecialchars($user["User_Gender"]);
	$gradeId = $user["Grade_Id"];
	if(isset($gradeId))
	{
		$answerAllGradeSection[] = htmlspecialchars(Grade::Get_Grade_Section($gradeId));
		$answerAllGradeSectionYear[] = Grade::Get_Grade_Section_Year($gradeId);
		$answerAllGradeSchoolYear[] = Grade::Get_Grade_School_Year($gradeId);
		$answerAllSchool[] = "Polytech";
	}
	else
	{
		$answerAllSchool[] = "Autres";
	}
}

$answerAllGradeSection = array_Unique($answerAllGradeSection);
$answerAllGradeSectionYear = array_Unique($answerAllGradeSectionYear);
$answerAllGradeSchoolYear = array_Unique($answerAllGradeSchoolYear);
$answerAllSchool = array_Unique($answerAllSchool);
$answerAllGender = array_Unique($answerAllGender);

function gradesSelected($sections,$sectionsYear, $schoolsYear)
{
	//Crée un tableau d'Id des grades en fonctions des entrées
	
	$sectionSQL = "";
	$sectionYearSQL = "";
	$schoolYearSQL = "";
	
	if(isset($sections))
	{
		foreach($sections as $section)
		{
			$sectionSQL = $sectionSQL." AND Grade_Section = ".$section;
		}
	}
	if(isset($sectionsYear))
	{
		foreach($sectionsYear as $sectionYear)
		{
			$sectionYearSQL = $sectionYearSQL." AND Grade_Section_Year = ".$sectionYear;
		}
	}
	if(isset($schoolYear))
	{
		foreach($schoolYears as $schoolYear)
		{
			$schoolYearSQL = $schoolYearSQL." AND Grade_School_Year = ".$schoolYear;
		}
	}
	
	$gradesIdFromGrade = Grade::Get_Grade_Id_From_String($sectionSQL.$sectionYearSQL.$schoolYearSQL);
	
	return $gradesIdFromGrade;
}



function usersSelected($schools, $sections, $sectionsYear, $schoolsYear, $genders)
{
	//Récupère tout les utilisateurs ayant fini le test et correspondont aux caractéristiques entrées
	$schoolSQL = "";
	$genderSQL = "";
	$gradeSQL = "";
	
	if(isset($schools))
	{
		foreach($schools as $school)
		{
			if($school === "Polytech")
			{
				$schoolSQL = $schoolSQL." AND Grade_Id > 0";
			}
			else
			{
				$schoolSQL = $schoolSQL." AND Grade_Id = NULL";
			}
		}
	}
	if(isset($genders))
	{
		foreach($genders as $gender)
		{
			$genderSQL = $genderSQL." AND User_Gender = ".$gender;
		}
	}
	$gradesSelected = gradesSelected($sections, $sectionsYear, $schoolsYear);
	if(isset($gradesSelected))
	{
		foreach($gradesSelected as $gradeId)
		{
			$gradeSQL = $gradeSQL." AND Grade_Id = ".$gradeId;
		}
	}
	$usersIdFromUser = User::Get_User_Id_From_String($schoolSQL.$genderSQL.$gradeSQL);
	//On obtient une liste d'users correspondants aux carecteristiques entrées
	
	/*foreach($usersIdFromUser as $userId)
	{
		if(etatTest_From_User_Id($userId) == 2)
		{
			$usersSelected[] = $userid;
		}
	}*/
	//Verifiz que l'user a termine le test
	
	return [1];//$usersSelected;
}

$usersSelected = usersSelected($_GET["school"], $_GET["section"], $_GET["sectionYear"], $_GET["schoolYear"], $_GET["gender"]);

$answers = [];
foreach($usersSelected as $userId)
{
	$answers = array_merge($answers,Answer::Get_Answer_User($userId));
}
//Création de la liste des réponses des utilisateurs sélectionnés. Array de la form $answers[Answer_Id] = Answer_Value

/*$themes = Theme::Get_All_Theme();
foreach($themes as $themeTitle)
{
	$results[htmlspecialchars($themeTitle)] = 0;
}
//Récupérer les différents titres de themes et les initialiser à 0

$totalPoints = 0;
foreach($answers as $questionId => $answerValue)
{
	$themeId = Question::Get_Question_Theme_Id($questionId);
	$themeTitle = $themes[$themeId];
	$results[$themeTitle] += $answerValue;
	$totalPoints += $answerValue;
}
//Stocker dans un dictionnaire la sommes de chaque theme avec le nom du theme. Ainsi que le total de points distribué pour préparer le pourcentagen (utilisateur)

$maxScore = 0;
foreach($results as $themeTitle => $themeValue)
{
	$pourcentageTheme = round(($themeValue/$totalPointsUser)*100);
	$results[$themeTitle] = $pourcentageTheme;
	if($maxScore < $pourcentageTheme)
	{
		$principalTheme[] = htmlspecialchars($themeTitle);
		$maxScore = $pourcentageTheme;
	}
}
//On en crée des pourcentages et on regarde quel est le principal*/

require ("view/statistiques.php");
?>