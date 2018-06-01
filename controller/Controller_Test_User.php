<?php
require_once ("model/User.php");
require_once ("model/Role.php");
require_once ("model/Answer.php");
require_once ("model/Block.php");

function isConnected()
{
	if (isset($_COOKIE["codeconnexion"]))
	{
		
		$cookieperso = $_COOKIE["codeconnexion"];
		$userId = User::Get_User_Id($cookieperso);
		if (empty($userId)) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		
		return false;
	}
}
//Indique si un utilisateur est connecté.

function isAdmin()
{
	if(isConnected())
	{
		$userId = User::Get_User_Id($_COOKIE["codeconnexion"]);
		$roleId = User::Get_User_Role_Id($userId);
		$roleTitle = Role::Get_Role_Title($roleId);
		if($roleTitle != "Administrateur")
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		return false;
	}
}

function onlineOnly()
{
	if(!isConnected())
	{
		header("Location: Connexion.php");
	}
}
//Pour les pages autorisées seulement par les utilisateurs connectés. Renvoie à la connexion sinon

function offlineOnly()
{
	if(isConnected())
	{
		header("Location: Accueil.php");
	}		
}
//Pour les pages autorisées seulement par les utilisateurs non connectés. Renvoie à la page d"accueil sinon

function adminOnly()
{
	if(!isAdmin())
	{
		header("Location: Accueil.php");
	}
}
//Pour les pages seulements autorisées par un admin, sinon renvoie à l"accueil

function etatTest_From_User_Id($userId)
{
	$answers = Answer::Get_Answer_User($userId);
	if(empty($answers))
	{
		return 0;
	}
	else
	{
		$maxBlockNumber = Block::Get_Max_Block_Number();
		$totalValues = 0;
		foreach($answers as $answerValue)
		{
			$totalValues += $answerValue;
		}
		
		if($totalValues != $maxBlockNumber*6) //3 + 2 + 1 = 6. Soit 6 points a repartir par Blocke de question
		{
			return 1;
		}
		else
		{
			return 2;
		}
	}	
}

function etatTest()
{
	if(!isConnected())
	{
		return 0;
	}
	else
	{
		$userId = User::Get_User_Id($_COOKIE["codeconnexion"]);
		return etatTest_From_User_Id($userId);	
	}
}

//Retourne 0 si l'utilisateur n'a pas encore commencé le test. 1 s'il l'a commencé mais pas terminé. 2 s'il l'a terminé.

if(isConnected())
{
	setcookie("codeconnexion", $_COOKIE["codeconnexion"], time()+(600), "/");
}
//L"utilisateur prouve qu"il est actif, on réinitialise la date d"expiration de son cookie

if (isset($_COOKIE["codeconnexion"]))
	{
		$userId=User::Get_User_Id($_COOKIE["codeconnexion"]);
	}

function Is_Grade_Member()
{
	$cookie = $_COOKIE["codeconnexion"];
	$idUser = User::Get_User_Id($cookie);
	$gradeid=User::Get_User_Grade_Id($idUser);
	if (is_null($gradeid))
	{
		return 0;
	}
	else
	{
		return 1;
	}
}
?>