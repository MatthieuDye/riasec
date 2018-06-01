<!doctype html>
<html lang="fr">
	<head>
		<title>Gestion Admin</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Page contenu le menu des fonctionnalités administrateur ">
		<meta name="Keywords" content="test riasec hollande personnalité polytech montpellier questionnaire intérêts professionnels">
		<meta name="Subject" content="Test Riasec ">
		<meta name="Copyright" content="PolytechMontpellier">
		<meta name="Author" content="PolytechMontpellier">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>

		<div class="container">
			<h5 class="center-align">Que voulez-vous modifier ?</h5>
				<form action="#">
	  				<p>
	    				<input name="group1" type="radio" id="test1" />
	    				<label for="test1">Nom</label>
	   				</p>
				    <p>
				    	<input name="group1" type="radio" id="test2" />
				    	<label for="test2">Prénom</label>
				    </p>
				    <p>
				    	<input name="group1" type="radio" id="test3"  />
				    	<label for="test3">Sexe</label>
				    </p>
				    <p>
			        	<input name="group1" type="radio" id="test4"/>
			        	<label for="test4">Email</label>
					</p>
					<p>
			        	<input name="group1" type="radio" id="test5"/>
			        	<label for="test5">Mot de passe</label>
					</p>
				</form>
		</div>
		<?php require ("view/footer.php");?>
	</body>


</html>
<script src="jQuery.js"></script>
<script src="materialize/js/materialize.js"></script>
<script>
$( document ).ready(function(){
	$(".button-collapse").sideNav();
})
</script>