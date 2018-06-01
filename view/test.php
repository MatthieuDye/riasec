<!doctype html>
<html lang="fr">
  <head>
  	<title>Questionnaire Riasec</title>
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
		<div class="container">
			<div class="row z-depth-4 blue-grey lighten-5">
				<div class="input-field col s12">
				<p>*Instructions en bas de page</p>
				<h4>Groupe <?php echo $numGroup; ?></h4>
				<br>
				<form method="post" action="/controller/Controller_Ajout_Reponse.php">
					<table class="striped bordered">
						<thead>
							<tr>
								<th>Propositions</th>
								<th>1°</th>
								<th>2°</th>
								<th>3°</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($lesquestions as $row)
							{

								echo "
								<tr>
								<td>".$row['Question_Title']."</td>

								<td><input name=\"answer1\" class=\"".$row['Question_Letter']."\" type=\"radio\" id=\"".$row['Question_Letter']."1\" value=\"".$row['Question_Id']."\"/><label for=\"".$row['Question_Letter']."1\"></label></td>

								<td><input name=\"answer2\" class=\"".$row['Question_Letter']."\" type=\"radio\" id=\"".$row['Question_Letter']."2\" value=\"".$row['Question_Id']."\"/><label for=\"".$row['Question_Letter']."2\"></label></td>

								<td><input name=\"answer3\" class=\"".$row['Question_Letter']."\" type=\"radio\" id=\"".$row['Question_Letter']."3\" value=\"".$row['Question_Id']."\"/><label for=\"".$row['Question_Letter']."3\"></label></td>
								</tr>";



							}
							?>
							
						</tbody>
					</table>
					<br>
					<button class="btn waves-effect waves-light" type="submit" name="action">Continuer
						<i class="material-icons right">send</i>
					</button>
				</form>
				<h4 style="margin-top:50px">Instructions :</h4>
				<p>Vous trouverez sur ces prochaines pages 12 groupes de phrases, composées chacune de 6 propositions.<br>
				Dans chaque groupe de phrase, il s’agit de repérer et de classer par ordre de préférence les 3 propositions qui vous caractérisent le plus au travail.<br>
				Il n’y a pas ici ni bonnes, ni mauvaises réponses, elles seront toutes bonnes si elles expriment votre choix spontané.<br>
				Votre temps n’est pas limité.
				</p>
				</div>
			</div>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>

<script src="materialize/js/materialize.js"></script>
<script>
$("input[type=radio]").click(function(){
	$("."+$(this).attr("class")).not($(this)).attr("checked",false);
});
</script>