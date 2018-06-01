<!doctype html>
<html lang="fr">
	<head>
		<title>Erreur</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Erreur">
		<meta name="Keywords" content="test riasec hollande personnalité polytech montpellier questionnaire intérêts professionnels">
		<meta name="Subject" content="Test Riasec ">
		<meta name="Copyright" content="PolytechMontpellier">
		<meta name="Author" content="PolytechMontpellier">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<?php include ("css/css_config.php"); ?>
	</head>
	<body>
		<?php require ("view/header.php");?>
		<div class="container">
			<h3>Erreur : </h3>
			<p><?php echo $messageErreur; ?></p>
			<a class="btn waves-effect waves-light" href="javascript:history.back()"> Retour </a>	
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>