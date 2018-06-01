<!doctype html>
<html lang="fr">
	<head>
		<title>Administrateur</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Espace de gestion administrateur">
		<meta name="Keywords" content="test riasec hollande personnalité polytech montpellier questionnaire intérêts professionnels">
		<meta name="Subject" content="Test Riasec ">
		<meta name="Copyright" content="PolytechMontpellier">
		<meta name="Author" content="PolytechMontpellier">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<?php include ("css/css_config.php") ?>
	</head>
	<body>
		<?php require ("view/header.php");?>
		<div class="container">
			<h3>Administrateur :</h3>
			<div class="row rowSpe">
				<a class="col s4 center-align button2" href="Profil.php"><i class="amazing material-icons">perm_identity</i><h5>Profil</h5></a>
				<a class="col s4 center-align button2" href="Gestion_Admin.php"><i class="amazing material-icons">settings</i><h5>Gestion</h5></a>
				<a class="col s4 center-align button2" href="Statistiques.php"><i class="amazing material-icons">equalizer</i><h5>Statistiques</h5></a>
			</div>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>