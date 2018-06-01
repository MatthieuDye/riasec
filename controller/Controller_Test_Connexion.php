<?php
require_once ("model/User.php");
require_once ("model/Role.php");

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
	if(isConnected())
	{
		$userId = User::Get_User_Id($_COOKIE["codeconnexion"]);
		$roleId = User::Get_User_Role_Id($userId);
		$roleTitle = Role::Get_Role_Title($roleId);
		if($roleTitle != "Administrateur")
		{
			header("Location: Accueil.php");
		}
	}
	else
	{
		header("Location: Accueil.php");
	}
}
//Pour les pages seulements autorisées par un admin, sinon renvoie à l"accueil

if(isConnected())
{
	setcookie("codeconnexion", $_COOKIE["codeconnexion"], time()+(500), "/");
}
//L"utilisateur prouve qu"il est actif, on réinitialise la date d"expiration de son cookie

$userId=User::Get_User_Id($_COOKIE["codeconnexion"]);
?>