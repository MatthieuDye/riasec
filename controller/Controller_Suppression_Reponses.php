<?php
require_once('../model/Answer.php');

$userId = htmlspecialchars($_GET['id']);


Answer::Delete_All_Answer_User($userId);

header("Location: ../Accueil.php")


?>