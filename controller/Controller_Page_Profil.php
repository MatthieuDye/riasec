<?php
require_once ("controller/Controller_Test_User.php");
onlineOnly();

require_once ("model/User.php");

$cookieId = $_COOKIE['codeconnexion'];
$userId = User::Get_User_Id($cookieId);
$info = User::Get_User($userId);

require "view/profil.php";
?>