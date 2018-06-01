<?php
require_once ("Controller_Test_User.php");
onlineOnly();
adminOnly();


require_once ("model/User.php");

$cookieCode = $_COOKIE["codeconnexion"];
$userId = User::Get_User_Id($cookieCode);
$isAdmin = isAdmin($userId);
$lesadmins = User::Get_All_Admins();

require("view/gestion_liste_admins.php");
?>