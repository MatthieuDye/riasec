<!doctype html>
<html lang="fr">
	<head>
		<title>Profil</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Gérez vos informations personnels et modifiez votre mot de passe ">
		<meta name="Keywords" content="test profil riasec hollande personnalité polytech intérêts professionnels">
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
			<ul class="collection with-header">
			    <li class="collection-header"><h4>Vos informations</h4></li>
			    <li class="collection-item"><?php echo $info['User_Name'] ?></li>
			    <li class="collection-item"><?php echo $info['User_First_Name'] ?></li>
			    <li class="collection-item"><?php echo $info['User_Gender'] ?></li>
			    <li class="collection-item"><?php echo $info['User_Mail'] ?></li>
			</ul>
		</div>
		<a href="Modification_User.php" class="waves-effect waves-light btn">Modifier des informations ?</a>
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