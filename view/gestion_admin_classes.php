<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Gestion Classes</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Rubrique réservé aux administrateurs. Gérez les classes et modifiez le code d'inscription">
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
			<h4>Les Classes</h4>

			<div class="container">
			<h5 class="center-align">Ajouter une nouvelle classe</h5>
			<div class="row z-depth-4 blue-grey lighten-5">
				<form class="col s12" method="post" action="/controller/Controller_Ajout_Classe.php">
					<div class="row">
						<div class="input-field col s9">
							<input id="section" name="section" type="text" class="validate">
							<label for="section" data-error="wrong" data-success="right">Libellé de la filière</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s9">
							<input id="year" name="year" type="text" class="validate">
							<label for="year" data-error="wrong" data-success="right">Année</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s9">
							<input id="promotion" name="promotion" type="text" class="validate">
							<label for="promotion" data-error="wrong" data-success="right">Promotion</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s9">
							<input id="code" name="code" type="text" class="validate">
							<label for="code" data-error="wrong" data-success="right">Code</label>
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


			<br>
				<table class="striped bordered">
					<thead>
						<tr>
							<th>Libellé</th>
							<th>Année</th>
							<th>Promotion</th>
							<th>Code</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($lesclasses as $row)
						{
							echo "<tr><td>".$row["Grade_Section"]."</td>";
							echo "<td>".$row["Grade_Section_Year"]."</td>";
							echo "<td>".$row["Grade_School_Year"]."</td>";
							echo "<td>
									<form method=\"post\" action=\"/controller/Controller_Modification_Code_Classes.php\">	
										<div>
											<input id=\"code\" name=\"code\" type=\"text\" class=\"validate\" placeholder=\"".$row["Grade_Code"]."\">
											
										</div>
										<div>
											<input id=\"id\" name=\"id\" type=\"hidden\" class=\"validate\" value=\"".$row["Grade_Id"]."\">
											
										</div>
								
									
										
										<button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Modifier
											<i class=\"material-icons right\">send</i>
										</button>
									</form>
									</td>";

							echo "<td> <a href=\"/controller/Controller_Suppression_Classe.php?id=".$row["Grade_Id"]."\">Supprimer </a> </td></tr>";
						}

						?>
						
					</tbody>
				</table>
	
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