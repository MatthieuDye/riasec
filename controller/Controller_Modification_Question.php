<?php
require_once('../model/Question.php');

$questionId=htmlspecialchars($_POST['id']);
$questionTitle=htmlspecialchars($_POST['modification']);

Question::Set_Question_Title($questionId,$questionTitle);

header("Location: ../Gestion_Admin_Questions.php");

?>