<?php
	
require_once ("controller/Controller_Test_User.php");
onlineOnly();

require_once ("model/User.php");
	$cookieId = $_COOKIE['codeconnexion'];
	$id = User::Get_User_Id($cookieId);
	$info = User::Get_User($id);

require "view/modification.php";

?>