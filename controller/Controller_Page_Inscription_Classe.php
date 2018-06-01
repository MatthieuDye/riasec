<?php
require_once ('model/Grade.php');
require_once ("controller/Controller_Test_User.php");
offlineOnly();

$GradeCode = htmlspecialchars($_POST['code']);

$gradeId=Grade::Get_Grade_Id($GradeCode);
$section=Grade::Get_Grade_Section($gradeId);
$year=Grade::Get_Grade_Section_Year($gradeId);

$class=$section." ".$year;

if(is_null($gradeId))
{
	$messageErreur = 'Le code classe est invalide ! ';
		
	header("Location: ../Erreur.php?erreur=".$messageErreur);
}
else
{
	require_once ("view/inscription_classe.php");
}




?>