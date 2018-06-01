<?php
require_once('../model/Grade.php');

$gradeId = htmlspecialchars($_POST['id']);
$gradeCode = htmlspecialchars($_POST['code']);

echo $_POST['id'];
Grade::Update_Code($gradeId,$gradeCode);

header("Location: ../Gestion_Admin_Classes.php")


?>