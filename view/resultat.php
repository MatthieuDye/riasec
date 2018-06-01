<!doctype html>
<html lang="fr">
	<head>
		<title>Resultats</title>
		<meta name="Content-Type" content="UTF-8">
		<meta name="Content-Language" content="fr">
		<meta name="Description" content="Resultats de votre test riasec. Retrouver l'interet professionel qui vous représente au travers de vos réponses aux différentes questions ">
		<meta name="Keywords" content="test resultats questions riasec hollande personnalité questionnaire intérêts professionnels">
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
					<h2>Vos résultats :</h2>
					<br>
					<p><?php echo $sizeUsersAll;?> personnes ont fait le test.</p>
				<?php if(Is_Grade_Member()==0){?>
						<button class="btn waves-effect waves-light" type="submit" name="action">    <?php echo "<a href=\"/controller/Controller_Suppression_Reponses.php?id=".$idUser."\"> Supprimer mes réponses</a> " ?>
							<i class="material-icons right">send</i>
						</button><?php 
					} 
					else
					{
					?>
						<p>Pour refaire le test vous pouvez vous réinscrire en tant qu'externe à l'école.</p>
					<?php
					}?>
				</div>
				<div class="input-field col s12">
					<table class="striped bordered">
						<thead>
							<tr>
								<th>Type</th>
								<th>Pourcentage</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($resultsUserSorted as $label => $value)
							{?>
								<tr>
									<td><?php echo htmlspecialchars($label);?></td>
									<td><?php echo $value;?>%</td>
								</tr>
							<?php
							}?>
						</tbody>
					</table>
				</div>
				<div class="input-field col s12">
					<p>Le test Riasec a décelé chez vous comme type de personnalité principal : <?php foreach($principalTheme as $themeTitle){ echo htmlspecialchars($themeTitle)." "; } ?> </p>
				</div>
				<div class="input-field col s12">
					<?php foreach ($principalTheme as $themeTitle){ ?>
					<a href="/view/themesPdf/<?php echo htmlspecialchars($themeTitle);?>.pdf" target="_blank">Voir la description du type <?php echo htmlspecialchars($themeTitle);?>.</a><br>
					<?php } ?>
				</div>
				<div class="input-field col s12">
					<br>
					<label>Radar Chart</label>
					<canvas id="radarChart" style="max-width:500px;max-height:500px"></canvas>
				</div><br>
				<div class="input-field col s12">
					<br>
					<label>Pie Chart</label>
					<canvas id="pieChart" style="max-width:500px;max-height:500px"></canvas>
				</div>
				<div class="input-field col s12">
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
			</div>
		</div>
		<?php require ("view/footer.php");?>
	</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
<script>
var labels = [];
var dataUser = [];
var dataAll = [];
<?php
foreach($resultsUser as $label => $data)
{
	echo "labels.push('".$label."');";
	echo "dataUser.push('".$data."');";
}
foreach($resultsAll as $data)
{
	echo "dataAll.push('".$data."');";
}
?>

var data = {
    labels: labels,
    datasets: [
	{
			label: "Vous ",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            pointBackgroundColor: "rgba(255,99,132,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,99,132,1)",
            data: dataUser
		},
		{
            label: "Les autres ",
            backgroundColor: "rgba(179,181,198,0.2)",
            borderColor: "rgba(179,181,198,1)",
            pointBackgroundColor: "rgba(179,181,198,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(179,181,198,1)",
            data: dataAll
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
            data: dataUser,
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