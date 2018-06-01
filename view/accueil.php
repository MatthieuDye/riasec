<!doctype html>
<html lang="fr">
	<head>
		<title>Accueil Test Riasec</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Questionnaire en 12 parties du test Riasec appelé aussi test de Hollande. ">
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
		<div>
			<h4 class="center-align">Bienvenue sur le test Riasec</h4>
		</div>
		<br>
		<div class="container">
			<div class="row rowSpe">
				<?php if(etatTest() === 0){?><a href="Test.php" class="col s12 m6 center-align button2" ><i class="amazing material-icons">play_circle_outline</i><h5>Faire le test</h5></a><?php } ?>
				<?php if(etatTest() === 1){?><a href="Test.php" class="col s12 m6 center-align button2" ><i class="amazing material-icons">replay</i><h5>Reprendre le test</h5></a><?php } ?>
				<?php if(etatTest() === 2){?><a href="Resultat.php" class="col s12 m6 center-align button2"><i class="amazing material-icons">class</i><h5>Revoir ses résultats</h5></a><?php } ?>
				<?php if(isAdmin()){?><a href="Administrateur.php" class="col s12 m6 center-align button2"><i class="amazing material-icons">supervisor_account</i><h5>Administrateur</h5></a><?php } ?>
				<?php if(!isAdmin() && isConnected()){?><a href="Profil.php" class="col s12 m6 center-align button2"><i class="amazing material-icons">perm_identity</i><h5>Profil</h5></a><?php } ?>
				<?php if(!isConnected()){?><a href="Connexion.php" class="col s12 m6 center-align button2"><i class="amazing material-icons">input</i><h5>Connexion</h5></a><?php } ?>
			</div>
			<br>
			<div class="row z-depth-4 blue-grey lighten-5">
				<div class="input-field col s12">
					<h4>Analyse du questionnaire</h4>
					<p>Ce questionnaire s’appuie sur une typologie définie par John HOLLAND, psychologue de formation. Elle distingue 6 types d’intérêts professionnels, chacun renvoyant aux environnements professionnels et aux métiers qui correspondent au mieux à chaque personnalité.<br>
					Trouver un métier qui convient à qui l’on est vraiment est un gage de stabilité, de satisfaction et de réussite professionnelle. L’idée est, qu’en connaissant son profil typologique, un peut faire un pronostic sur le type d’environnement professionnel qui nous convient.<br>
					Aucun d’entre nous ne peut se définir exclusivement au travers d’un seul type mais l’on peut toutefois déterminer celui qui est dominant (score le plus élevé).</p>
				</div>
			</div>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>