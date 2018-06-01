<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Questions</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Modifiez la formulations des nombreuses questions du test riasec. ">
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
			 
				<a class='dropdown-button btn' href='#' data-activates='dropdown1'>Choisissez un groupe de questions</a>


				<ul id='dropdown1' class='dropdown-content'>
					<li><a href="/Gestion_Admin_Questions.php?blockId=1">Groupe 1</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=2">Groupe 2</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=3">Groupe 3</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=4">Groupe 4</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=5">Groupe 5</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=6">Groupe 6</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=7">Groupe 7</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=8">Groupe 8</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=9">Groupe 9</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=10">Groupe 10</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=11">Groupe 11</a></li>
					<li><a href="/Gestion_Admin_Questions.php?blockId=12">Groupe 12</a></li>
				  </ul>
			<table class="bordered"><h4>Groupe <?php echo $_GET['blockId'];?></h4>
				<thead>
				  <tr>
					  <th data-field="id">Lettre</th>
					  <th data-field="name">Intitulé</th>
					  <th data-field="theme">Type</th>
				  </tr>
				</thead>

				<tbody>
				<!--	<form method='get' action="/controller/Controller_Modification_Question.php">
						<select name="blockId">
							<option value="1">Groupe 1</option>
							<option value="2">Groupe 2</option>
							<option value="3">Groupe 3</option>
							<option value="4">Groupe 4</option>
							<option value="5">Groupe 5</option>
							<option value="6">Groupe 6</option>
							<option value="7">Groupe 7</option>
							<option value="8">Groupe 8</option>
							<option value="9">Groupe 9</option>
							<option value="10">Groupe 10</option>
							<option value="11">Groupe 11</option>
							<option value="12">Groupe 12</option>
						</select>
						<input type="submit" value="Valider" />
					</form> -->
					
				
					
					<?php
					foreach($lesquestions as $row)
					{?>
					<tr>
						<td width=70><?php echo $row['Question_Letter'];?></td>
						<td>
							<form style="padding-right:10%" action="/controller/Controller_Modification_Question.php" method="post">
								<div>
									<input type="text" id="modification" name="modification" value="<?php echo $row['Question_Title'];?>">
								</div>
								<div>
									<input id="id" name="id" type="hidden" class="validate" value="<?php echo $row["Question_Id"];?>">
								</div>
								
								<button class="btn waves-effect waves-light" type="submit" name="action">Modifier
								</button>
							</form>
						</td>
						<td width=70><?php echo $row['Theme_Title'];?></td>
					</tr>	
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>