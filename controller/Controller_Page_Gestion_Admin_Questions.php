<?php
require_once ("controller/Controller_Test_User.php");
adminOnly();

require_once("model/Question.php");
require_once("model/Theme.php");

if(isset($_GET['blockId']))
{
	$blockId=htmlspecialchars($_GET['blockId']);
}
else $blockId=1;

$lesquestions = Question::Get_Question_Block($blockId);
foreach($lesquestions as $cle => $question)
{
	$lesquestions[$cle]["Theme_Title"] = Theme::Get_Theme_Title($question["Theme_Id"]);
}
require('view/gestion_admin_questions.php');
?>