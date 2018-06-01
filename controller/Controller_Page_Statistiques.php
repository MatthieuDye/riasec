<?php
require_once ("controller/Controller_Test_User.php");
adminOnly();

require_once ("controller/Controller_Resultat.php");
require_once ("model/User.php");
require_once ("model/Answer.php");
require_once ("model/Grade.php");
require_once ("model/Theme.php");
require_once ("model/Question.php");

if(isset($_GET["school"])){$school = $_GET["school"];}else{$school = [];}
if(isset($_GET["section"])){$section = $_GET["section"];}else{$section = [];}
if(isset($_GET["sectionYear"])){$sectionYear = $_GET["sectionYear"];}else{$sectionYear = [];}
if(isset($_GET["schoolYear"])){$schoolYear = $_GET["schoolYear"];}else{$schoolYear = [];}
if(isset($_GET["gender"])){$gender = $_GET["gender"];}else{$gender = [];}



//------------------------------------- Début Main

//Création du select
$usersAll = User::Get_User_All();
foreach($usersAll as $user)
{
	if(etatTest_From_User_Id($user["User_Id"]) === 2)
	{
		$usersEndTest[] = $user;
	}
}
//Récupere tout les users ayant fini le test


foreach($usersEndTest as $user)
{
	if(isset($user["Grade_Id"]))
	{
		$gradeId =  $user["Grade_Id"];
		$answerAllSchool[] = "Polytech";
		$answerAllGradeSection[] = Grade::Get_Grade_Section($gradeId);
		$answerAllGradeSectionYear[] = Grade::Get_Grade_Section_Year($gradeId);
		$answerAllGradeSchoolYear[] = Grade::Get_Grade_School_Year($gradeId);
	}
	else
	{
		$answerAllSchool[] = "Autres";
	}
	$answerAllGender[] = $user["User_Gender"];
}
$answerAllSchool = array_unique($answerAllSchool);
$answerAllGradeSection = array_unique($answerAllGradeSection);
$answerAllGradeSectionYear = array_unique($answerAllGradeSectionYear);
$answerAllGradeSchoolYear = array_unique($answerAllGradeSchoolYear);
$answerAllGender = array_unique($answerAllGender);



//Création des données
$usersSelected = usersSelected($school, $section, $sectionYear, $schoolYear, $gender);
$sizeUsersSelected = sizeof($usersSelected);

if(!empty($usersSelected))
{
	$themes = Theme::Get_All_Theme();
	$answers = [];
	$principalThemeUsers = [];
	foreach($usersSelected as $userId)
	{
		$principalThemeUsers = array_merge($principalThemeUsers,findPrincipalThemeUser($userId));
		$newAnswersSQL = Answer::Get_Answer_User($userId);
		$newAnswers = [];
		foreach($newAnswersSQL as $questionId => $answerValue)
		{
			$newAnswers[] = array("questionId" => $questionId, "answerValue" => $answerValue);
		}
		$answers = array_merge($answers,$newAnswers);
	}
	//Création de la liste des réponses des utilisateurs sélectionnés. Array de la form $answers[i] =["questionId" => $qId, "answerValue => $aV"]. 
	//Plus création du tableau qui possède tout les pricipaux types.

	foreach($themes as $themeTitle)
	{
		$resultsRadar[htmlspecialchars($themeTitle)] = 0;
		$resultsPie[htmlspecialchars($themeTitle)] = 0;
	}
	//Récupérer les différents titres de themes et les initialiser à 0

	$totalPoints = 0;
	foreach($answers as $answer)
	{
		$themeId = Question::Get_Question_Theme_Id($answer["questionId"]);
		$themeTitle = $themes[$themeId];
		$resultsRadar[$themeTitle] += $answer["answerValue"];
		$totalPoints += $answer["answerValue"];
	}
	//Stocker dans un dictionnaire la sommes de chaque theme avec le nom du theme. Ainsi que le total de points distribué pour préparer le pourcentage

	$maxScore = 0;
	foreach($resultsRadar as $themeTitle => $themeValue)
	{
		$pourcentageTheme = round(($themeValue/$totalPoints)*100);
		$resultsRadar[$themeTitle] = $pourcentageTheme;
		if($maxScore < $pourcentageTheme)
		{
			$maxScore = $pourcentageTheme;
		}
	}
	//On en crée des pourcentages et on regarde quelle est le maximum
	
	$principalThemeGlobal = [];
	foreach($resultsRadar as $themeTitle => $themeValue)
	{
		if($maxScore === $themeValue)
		{
			$principalThemeGlobal[] = $themeTitle;
		}
	}
	//Crée un tableaux de themes principaux (il peut y en avoir plusieur => meme pourcentage max)
	
	
	$totalPrincipalTheme = 0;
	foreach($principalThemeUsers as $theme)
	{
		$resultsPie[$theme] += 1;
		$totalPrincipalTheme += 1;
	}
	//Additione le nombre de principaux type entre eux et le nombre total de principaux type.
	
	foreach($resultsPie as $theme => $value)
	{
		$resultsPie[$theme] = round(($value/$totalPrincipalTheme)*100);
	}
	//Puis en cée des pourcentages
	
	$resultsPieSorted = $resultsPie;arsort($resultsPieSorted);
	$resultsRadarSorted = $resultsRadar;arsort($resultsRadarSorted);
	//Créer des tableaux triés des résultats.
}
else
{
	$messageErreur = "Il n'y a aucun résultat pour cette recherche.";
	header("Location: ../Erreur.php?erreur=".$messageErreur);
}

require ("view/statistiques.php");
?>