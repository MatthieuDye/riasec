<?php
require_once ("controller/Controller_Test_User.php");
onlineOnly();

require_once ("model/Question.php");
require_once ("model/Block.php");
require_once ("model/Answer.php");
require_once ("model/User.php");


$userId=User::Get_User_Id($_COOKIE["codeconnexion"]);
$numGroup=Answer::Get_Max_Block_User($userId);
if ($numGroup>12)
{
	header("Location: Resultat.php");
}
else 
{
	$lesquestions=Question::Get_Question_Block($numGroup);

	require ("view/test.php");
}




?>