<!doctype html>
<html lang="fr">
	<head>
		<title>Changement de mot de passe</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Modification du mot de passe ">
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
			<h3>Changement de Mot de Passe </h3>
			<div class="row z-depth-4 blue-grey lighten-5">
				<form class="col s12" method="post" action="/controller/Controller_Changement_Mot_De_Passe.php">
					<div class="row">
						<div class="input-field col s9">
							<input id="password" name="password" type="password" class="validate">
							<label for="password" data-error="wrong" data-success="right">Nouveau mot de passe</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s9">
							<input id="password_check" name="password_check" type="password" class="validate">
							<label for="password_check" data-error="wrong" data-success="right">Vérification du mot de passe</label>
						</div>
						<input id="code" name="code" type="hidden" class="validate" value=<?php echo "\"".$code."\"" ; ?>>
					</div>
					<div class="row">
						<div class="input-field col s9">
							<button class="btn waves-effect waves-light" id="submit" value="valider">Modifier
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
			
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>