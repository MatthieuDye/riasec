<?php
require_once ("controller/Controller_Test_User.php");

$messageValidation = htmlspecialchars($_GET["validation"]);

require("view/page_validation.php");

?>