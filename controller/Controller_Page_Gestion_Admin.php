<?php
require_once ("controller/Controller_Test_User.php");
onlineOnly();
adminOnly();


require_once ("model/User.php");

$cookieCode = $_COOKIE["codeconnexion"];
$userId = User::Get_User_Id($cookieCode);
$isAdmin = isAdmin($userId);

require "view/gestion_admin.php";
//Possibilité de rajouter/enlever un administrateur ainsi que de réinitialiser le test d'un utilisateur
?>