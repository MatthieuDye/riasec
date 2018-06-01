<?php

require_once ("model/Theme.php");
require_once ("model/Question.php");
require_once ("model/Answer.php");
require_once ("model/Grade.php");

function findPrincipalTheme($answers)
{
	$themes = Theme::Get_All_Theme();
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
	}
	//Stocker dans un dictionnaire la sommes de chaque theme avec le nom du theme. Ainsi que le total de points distribué pour préparer le pourcentagen (utilisateur)
	
	$maxScore = 0;
	foreach($results as $themeTitle => $themeValue)
	{
		if($maxScore < $themeValue)
		{
			$maxScore = $themeValue;
		}
	}
	//on trouve le score max

	$principalTheme = [];
	foreach($results as $themeTitle => $themeValue)
	{	
		if($maxScore === $themeValue)
		{
			$principalTheme[] = $themeTitle;
		}
	}
	//On trouve le ou les themes principaux
	
	return $principalTheme;
}

function findPrincipalThemeUser($userId)
{
	$answersUser = Answer::Get_Answer_User($userId);
	return findPrincipalTheme($answersUser);
}

function gradesSelected($sections,$sectionsYear, $schoolsYear)
{
	//Crée un tableau de Grade_Id selectionnés en fonction des entrées
	
	$sectionSQL = "";
	$sectionYearSQL = "";
	$schoolYearSQL = "";
	
	if(!empty($sections))
	{
		$sectionSQL = " AND (1 = 2";
		foreach($sections as $section)
		{
			$sectionSQL = $sectionSQL." OR Grade_Section = \"".$section."\"";
		}
		$sectionSQL = $sectionSQL." )";
	}
	if(!empty($sectionsYear))
	{
		$sectionYearSQL = " AND (1 = 2";
		foreach($sectionsYear as $sectionYear)
		{
			$sectionYearSQL = $sectionYearSQL." OR Grade_Section_Year = ".$sectionYear;
		}
		$sectionYearSQL = $sectionYearSQL." )";
	}
	if(!empty($schoolsYear))
	{
		$schoolYearSQL = " AND (1 = 2";
		foreach($schoolsYear as $schoolYear)
		{
			$schoolYearSQL = $schoolYearSQL." OR Grade_School_Year = ".$schoolYear;
		}
		$schoolYearSQL = $schoolYearSQL." )";
	}
	
	$gradesIdFromGrade = Grade::Get_Grade_Id_From_String($sectionSQL.$sectionYearSQL.$schoolYearSQL);
	
	return $gradesIdFromGrade;
}

function usersSelected($schools, $sections, $sectionsYear, $schoolsYear, $genders)
{
	//Récupère tout les id des utilisateurs ayant fini le test et correspondont aux caractéristiques entrées
	$schoolSQL = "";
	$genderSQL = "";
	$gradeSQL = "";
	if(!empty($schools))
	{
		$schoolSQL = "AND (1 = 2";
		foreach($schools as $school)
		{
			if($school === "Polytech")
			{
				$schoolSQL = $schoolSQL." OR Grade_Id > 0";
			}
			else
			{
				$schoolSQL = $schoolSQL." OR Grade_Id IS NULL";
			}
		}
		$schoolSQL = $schoolSQL." )";
	}
	if(!empty($sections) || !empty($sectionsYear) || !empty($schoolsYear))
	{
		
		$gradesSelected = gradesSelected($sections, $sectionsYear, $schoolsYear);
		$gradeSQL = " AND ( 1 = 2";
		if(!empty($gradesSelected))
		{
			
			foreach($gradesSelected as $gradeId)
			{
				$gradeSQL = $gradeSQL." OR Grade_Id = ".$gradeId;
			}
		}
		$gradeSQL = $gradeSQL.")";
	}
	if(!empty($genders))
	{
		$genderSQL = " AND (1 = 2";
		foreach($genders as $gender)
		{
			$genderSQL = $genderSQL." OR User_Gender = '".$gender."'";
		}
		$genderSQL = $genderSQL." )";
	}
	
	$usersIdFromUser = User::Get_User_Id_From_String($schoolSQL.$genderSQL.$gradeSQL);
	//On obtient une liste d'users correspondants aux carecteristiques entrées
	
	if(!empty($usersIdFromUser))
	{
		//Verifiz que l'user a termine le test
		$usersSelected = [];
		foreach($usersIdFromUser as $userId)
		{
			if(etatTest_From_User_Id($userId) == 2)
			{
				$usersSelected[] = $userId;
			}
		}
		return $usersSelected;
	}
	else
	{
		return null;
	}
	
}
?>