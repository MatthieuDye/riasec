<?php
require_once('../model/Grade.php');

$gradeId = htmlspecialchars($_GET['id']);


Grade::Supprimer_Classe($gradeId);

header("Location: ../Gestion_Admin_Classes.php")


?>