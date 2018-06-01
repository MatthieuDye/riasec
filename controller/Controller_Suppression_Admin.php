<?php

require_once('../model/User.php');

$userId = htmlspecialchars($_GET['id']);


User::Set_User_Role($userId,2);

header("Location: ../Gestion_Liste_Admins.php")


?>