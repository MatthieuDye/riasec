<?php
function connexion()
{
	try
	{
		$riasec = new PDO('mysql:host=jamesterneriasec.mysql.db;dbname=jamesterneriasec;charset=utf8','jamesterneriasec','2016IGnoel');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
	return($riasec);
}
?>