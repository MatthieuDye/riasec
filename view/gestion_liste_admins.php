<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Gestion des Admins</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Page pour les administrateur. Gérez les personnes possédant le rôle d'administrateur. ">
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
			<table class="bored highlight grey lighten-5">
				<thead>
					<tr>
						<th>Gestion des administrateurs</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($lesadmins as $row)
							{
								echo "<tr><td>".$row['User_Name']."</td>";
								echo "<td>".$row['User_First_Name']."</td>";
								echo "<td>".$row['User_Mail']."</td>";
								echo "<td> <a href=\"/controller/Controller_Suppression_Admin.php?id=".$row["User_Id"]."\">Supprimer </a> </td></tr>";
							}
					?>
				</tbody>
			</table>
				
		<div class="container">
			<h5 class="center-align">Ajouter un nouvel administrateur</h5>
			<div class="row z-depth-4 blue-grey lighten-5">
				<form class="col s12" method="post" action="/controller/Controller_Ajout_Admin.php">
					<div class="row">
						<div class="input-field col s9">
							<input id="mail" name="mail" type="text" class="validate">
							<label for="mail" data-error="wrong" data-success="right">Mail de l'utilisateur</label>
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s9">
							<button class="btn waves-effect waves-light" id="submit" value="valider">Ajouter
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>