<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Gestion Admin</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Gestion admin ">
		<meta name="Keywords" content="test riasec hollande personnalité polytech montpellier questionnaire intérêts professionnels">
		<meta name="Subject" content="Test Riasec ">
		<meta name="Copyright" content="PolytechMontpellier">
		<meta name="Author" content="PolytechMontpellier">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<?php include ("css/css_config.php") ?>
	</head>
	<body>
	<?php require ("header.php");?>
		<div class="container">
			<h3>Gestion :</h3>
			<div class="row rowSpe">
				<a class="col s4 center-align button2" href="Gestion_Admin_Questions.php?blockId=1"><i class="amazing material-icons">mode_edit</i><h5>Modifier les questions</h5></a>
				<a class="col s4 center-align button2" href="Gestion_Admin_Classes.php"><i class="amazing material-icons">turned_in_not</i><h5>Gérer les classes</h5></a>
				<a class="col s4 center-align button2" href="Gestion_Liste_Admins.php"><i class="amazing material-icons">supervisor_account</i><h5>Gérer les administrateurs</h5></a>			
			</div>
		</div>
	<?php require ("footer.php");?>
	</body>
</html>
<script src="jQuery.js"></script>
<script src="materialize/js/materialize.js"></script>
<script>
$( document ).ready(function(){
	$(".button-collapse").sideNav();
})
</script>