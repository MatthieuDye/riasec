<?php

require_once ("controller/Controller_Test_User.php");
onlineOnly();
if(etatTest() != 2)
{
	header("Location: Accueil.php");
}

require_once ("controller/Controller_Resultat.php");
require_once ("model/User.php");
require_once ("model/Answer.php");
require_once ("model/Theme.php");
require_once ("model/Question.php");

$cookieCode = $_COOKIE["codeconnexion"];
$userId = User::Get_User_Id($cookieCode);
$answersUser = Answer::Get_Answer_User($userId);
$themes = Theme::Get_All_Theme();
$resultsUser = [];
foreach($themes as $themeTitle)
{
	$resultsUser[htmlspecialchars($themeTitle)] = 0;
	$resultsAll[htmlspecialchars($themeTitle)] = 0;
}


//Créer les résultats de l'utilisateur

//Récupérer les différents titres de themes et les initialiser à 0

$totalPointsUser = 0;
foreach($answersUser as $questionId => $answerValue)
{
	$themeId = Question::Get_Question_Theme_Id($questionId);
	$themeTitle = $themes[$themeId];
	$resultsUser[$themeTitle] += $answerValue;
	$totalPointsUser += $answerValue;
}
//Stocker dans un dictionnaire la sommes de chaque theme avec le nom du theme. Ainsi que le total de points distribué pour préparer le pourcentagen (utilisateur)

$maxScore = 0;
foreach($resultsUser as $themeTitle => $themeValue)
{
	$pourcentageTheme = round(($themeValue/$totalPointsUser)*100);
	$resultsUser[$themeTitle] = $pourcentageTheme;
}
//On en crée des pourcentages (utilisateur) 

$principalTheme = findPrincipalThemeUser($userId);

$resultsUserSorted = $resultsUser;arsort($resultsUserSorted);
//Créer un tableaux trié des résultats.




//On passe aux résultats de tous les utilisateurs (qui ont fini le test) All

$answersAll = [];

$usersIdAll = usersSelected(null, null, null, null, null); //Récupère toutles utilisateurs ayant terminé leur test
$sizeUsersAll = sizeof($usersIdAll);

foreach($usersIdAll as $userId)
{
	$newAnswersSQL = Answer::Get_Answer_User($userId);
	$newAnswers = [];
	foreach($newAnswersSQL as $questionId => $answerValue)
	{
		$newAnswers[] = array("questionId" => $questionId, "answerValue" => $answerValue);
	}
	$answersAll = array_merge($answersAll,$newAnswers);
}
//Création de la liste des réponses des utilisateurs sélectionnés. Array de la form $answers[i] =["questionId" => $qId, "answerValue" => $aV].

$totalPoints = 0;
foreach($answersAll as $answer)
{
	$themeId = Question::Get_Question_Theme_Id($answer["questionId"]);
	$themeTitle = $themes[$themeId];
	$resultsAll[$themeTitle] += $answer["answerValue"];
	$totalPoints += $answer["answerValue"];
}
//Stocker dans un dictionnaire la sommes de chaque theme avec le nom du theme. Ainsi que le total de points distribué pour préparer le pourcentage


foreach($resultsAll as $themeTitle => $themeValue)
{
	$pourcentageTheme = round(($themeValue/$totalPoints)*100);
	$resultsAll[$themeTitle] = $pourcentageTheme;
}
//On en crée des pourcentages


$cookie = $_COOKIE["codeconnexion"];
$idUser = User::Get_User_Id($cookie);

require ("view/resultat.php");
?>