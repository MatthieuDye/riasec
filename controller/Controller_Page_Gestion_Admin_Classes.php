<?php
require_once ("controller/Controller_Test_User.php");
onlineOnly();
adminOnly();



require_once ("model/Grade.php");

$lesclasses=Grade::Get_All_Grade();

require "view/gestion_admin_classes.php";

?>