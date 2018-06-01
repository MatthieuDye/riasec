<!doctype html>
<html lang="fr">
	<head>
		<title>Statistiques Résultats</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Graphiques et Statistisques des resultats obtenus par les élèves en fonction de leurs fillière et année d'étude">
		<meta name="Keywords" content="test statistiques riasec hollande personnalité polytech montpellier questionnaire">
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
			<h3>Statistiques :</h3>
			<div class="row z-depth-4 blue-grey lighten-5">
				<form class="col s12" method="get" action="Statistiques.php">
					<div class="row">
						<div class="input-field col s12">
							<p>Voir les résultats sur</p>
							<br>
						</div>
						<br>
						<div class="input-field col s12">
							<select multiple name="school[]">
								<option value="" disabled selected>Cocher des écoles</option>
								<?php
								foreach($answerAllSchool as $school)
								{
									$selected = "";
									foreach($_GET["school"] as $getSchool)
									{
										if($school === $getSchool)
										{
											$selected = "selected";
										}
									}
									echo "<option value ='".$school."' ".$selected.">".$school."</option>";
								}
								?>
							</select>
							<label>Ecole</label>
						</div>
						<br>
						<div class="input-field col s12">
							<select multiple name="section[]">
							<option value="" disabled selected>Cocher des sections</option>
								<?php
								foreach($answerAllGradeSection as $sectionTitle)
								{
									$selected = "";
									foreach($_GET["section"] as $getSectionTitle)
									{
										if($sectionTitle === $getSectionTitle)
										{
											$selected = "selected";
										}
									}
									echo "<option value ='".$sectionTitle."' ".$selected.">".$sectionTitle."</option>";
								}
								?>
							</select>
							<label>Section</label>
						</div>
						<br>
						<div class="input-field col s12">
							<select multiple name="sectionYear[]">
								<option value="" disabled selected>Cocher une ou des années de sections</option>
								<?php
								foreach($answerAllGradeSectionYear as $sectionYear)
								{
									$selected = "";
									foreach($_GET["sectionYear"] as $getSectionYear)
									{
										if($sectionYear === $getSectionYear)
										{
											$selected = "selected";
										}
									}
									echo "<option value ='".$sectionYear."' ".$selected.">".$sectionYear."A</option>";
								}
								?>
							</select>
							<label>Année de section</label>
						</div>
						<br>
						<div class="input-field col s12">
							<select multiple name="schoolYear[]">
								<option value="" disabled selected>Cocher une ou des années scolaires</option>
								<?php
								foreach($answerAllGradeSchoolYear as $schoolYear)
								{
									$selected = "";
									foreach($_GET["schoolYear"] as $getSchoolYear)
									{
										if($schoolYear === $getSchoolYear)
										{
											$selected = "selected";
										}
									}
									echo "<option value ='".$schoolYear."' ".$selected.">".$schoolYear."</option>";
								}
								?>
							</select>	
							<label>Année scollaire</label>
						</div>
						<br>
						<div class="input-field col s12">
							<select multiple name="gender[]">
								<option value="" disabled selected>Cocher un ou des sexes</option>
								<?php
								foreach($answerAllGender as $gender)
								{
									$selected = "";
									foreach($_GET["gender"] as $getGender)
									{
										if($gender === $getGender)
										{
											$selected = "selected";
										}
									}
									echo "<option value ='".$gender."' ".$selected.">".$gender."</option>";
								}
								?>
							</select>	
							<label>Sexe</label>
						</div>
						<br>
						<div class="input-field col s12">
							<br>
							<button class="btn waves-effect waves-light" type="submit" name="action">Voir
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<br>
			<p>Statistisques sur <?php echo $sizeUsersSelected; ?> personne(s)</p>
			
			<br>
			<h5>Moyenne des profils</h5>
			<br>
			<table class="striped bordered">
				<thead>
					<tr>
						<th>Type</th>
						<th>Pourcentage</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($resultsRadarSorted as $label => $value)
					{?>
						<tr>
							<td><?php echo $label;?></td>
							<td><?php echo $value;?>%</td>
						</tr>
					<?php
					}?>
				</tbody>
			</table>
			<br>
			<label>Graphique sur la moyenne des profils</label>
			<canvas id="radarChart" style="max-width:500px;max-height:500px"></canvas>
			<br>
			<h5 style="margin-top:100px">Proportion des profils dominants</h5>
			<br>
			<table class="striped bordered">
				<thead>
					<tr>
						<th>Type</th>
						<th>Pourcentage</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($resultsPieSorted as $label => $value)
					{?>
						<tr>
							<td><?php echo $label;?></td>
							<td><?php echo $value;?>%</td>
						</tr>
					<?php
					}?>
				</tbody>
			</table>
			<br>
			<label for="pieChart">Graphique sur la proportion des profils dominants</label>
			<canvas id="pieChart" style="max-width:500px;max-height:500px"></canvas>
			<br>
			<h4>Descriptions de chaques types :</h4>
			<?php
			foreach($themes as $themeTitle)
			{
				echo "<li><a href='view/themesPdf/".$themeTitle.".pdf' target='_blank'>".$themeTitle."</a></li>";
			}
			?>
			<br>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>


<script>
var labels = [];
var data = [];
var dataPie = [];
<?php
foreach($resultsRadar as $label => $data)
{
	echo "labels.push('".$label."');";
	echo "data.push('".$data."');";
	echo "dataPie.push('".$resultsPie[$label]."');";
}
?>

var data = {
    labels: labels,
    datasets: [
        {
            label: "Moyenne des résultats ",//Proportion des profils dominants
            backgroundColor: "rgba(179,181,198,0.2)",
            borderColor: "rgba(179,181,198,1)",
            pointBackgroundColor: "rgba(179,181,198,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(179,181,198,1)",
            data: data
        }
    ]
};
var ctx1 = document.getElementById("radarChart");
new Chart(ctx1, {
    type: "radar",
    data: data,
    options: {
		scale: {
			reverse: false,
			ticks: {
				beginAtZero: true
			}
		}
    }
});
//Radar Chart

var data = {
    labels: labels,
    datasets: [
        {
            data: dataPie,
            backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56",
				"#10e610",
				"#002098",
				"#af7cad"
            ],
            hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56",
				"#10e610",
				"#002098",
				"#af7cad"
            ]
        }]
};
var ctx2 = document.getElementById("pieChart");
var myPieChart = new Chart(ctx2,{
    type: 'pie',
    data: data,
    options: {}
});
</script>
