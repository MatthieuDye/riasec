<?php
class User
{
	public static function Check_Password($userPassword,$userMail)
	//User_Password x User_Mail => bool
	//données : $userPassword string correspondant au mot de passe utilisateur, $userMail string correspondant au mail de l'utilisateur
	//résultat : bool vérifiant si le mot de passe entré correspond bien au mail de l'utilisateur
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 

		$req = $bdriasec->prepare("SELECT User_Password FROM User WHERE User_Mail='".$userMail."'");

		$req->execute();
		$data=$req->fetch();

		return ($data['User_Password']==$userPassword);
		
	}
	public static function Set_User_Coockie_Code($userMail,$userCookieCode)
	//User_Mail x User_Cookie_Code => 
	//données : $userMail string correspondant au mail de l'utilisateur, $userCookieCode string correspondant au cookie que l'on souhaite attribuer à l'utilisateur
	//résultat : modifie la base de données en attribuant un code cookie à l'utilisateur dont le mail est passé en entrée
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("UPDATE User SET User_Cookie_Code =:cookie WHERE User_Mail=:mail");
		$req->bindParam(':cookie',$userCookieCode);
		$req->bindParam(':mail',$userMail);

		$req->execute();
	}

	public static function Get_User_Id($userCookieCode)
	//User_Cookie_Code => User_Id
	//données : $userCookieCode string correspondant à un code cookie
	//résultat : vérifie si un code cookie existe dans la base de données, et le cas échéant renvoie un int correspondant à l'id de l'utilisateur auquel appartient le code cookie
	{
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("SELECT User_Id FROM User WHERE User_Cookie_Code='".$userCookieCode."'");

		$req->execute();
		$data=$req->fetch();

		return $data["User_Id"]; //Verifier si null
	}

	public static function Check_Mail($mail)
	//User_Mail => [User]
	//données : string correspondant au mail à vérifier
	//résultat : vérifie si un mail existe dans la base de données, et le cas échéant renvoie un tableau contenant toutes les informations de l'utilisateur auquel est attribué le mail
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT * FROM User WHERE User_Mail='".$mail."'");
		
		$req->execute();
		$data=$req->fetch();

		return $data;
	}

	public static function Add_User($gender,$name,$firstName,$password,$mail)
	//User_Gender x User_Name x User_First_Name x User_Password x User_Mail =>
	//données : $gender string correspondant au sexe de l'utilisateur à ajouter, $name string correspondant au nom de l'utilisateur, $firstName string correspondant au prénom de l'utilisateur, $password string correspondant au mot de passe de l'utilisateur, $mail string correspondant au mail de l'utilisateur
	//résultat : modifie la base de données en ajoutant une entité à la classe "User" en fonction des données entrées
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('INSERT INTO User(User_Gender, User_Name, User_First_Name, User_Password, User_Mail) VALUES (:gender, :name,:firstname,:password,:mail)');
		$req->bindParam(':gender',$gender);
		$req->bindParam(':name',$name);
		$req->bindParam(':firstname',$firstName);
		$req->bindParam(':password',$password);
		$req->bindParam(':mail',$mail);

		$req->execute();
	}
	
	public static function Get_User_Role_Id($userId)
	//User_Id => Role_Id
	//données : $userId int correspondant à l'identifiant de l'utilisateur
	//résultat : int correspondant à l'id du rôle de l'utilisateur
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT Role_Id FROM User WHERE User_Id = ?");
		$req->execute(array($userId));
		$data=$req->fetch();
		
		return $data["Role_Id"];
	}
	
	public static function Get_User_Grade_Id($userId)
	//User_Id => Grade_Id
	//données : $userId int correspondant à l'id utilisateur
	//résultat : int correspondant à l'id du grade de l'utilisateur
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT Grade_Id FROM User WHERE User_Id = :Id");
		$req->bindParam(':Id',$userId);
		$req->execute();
		$data=$req->fetch();
		
		
		return $data['Grade_Id'];
		
	}

	public static function Set_User_Grade($userMail,$gradeId){

		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("UPDATE User SET Grade_Id =:grade WHERE User_Mail=:mail");
		$req->bindParam(':grade',$gradeId);
		$req->bindParam(':mail',$userMail);

		$req->execute();
	}
	
	public static function Set_User_Role($userId,$roleId)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("UPDATE User SET Role_Id =:roleId WHERE User_Id=:userId");
		$req->bindParam(':roleId',$roleId);
		$req->bindParam(':userId',$userId);
		
		$req->execute();
	}
	
	public static function Get_User($userId){
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("SELECT * FROM User WHERE User_Id = :userId");
		$req->bindParam(':userId',$userId);

		$req->execute();
		$data=$req->fetch();

		return $data; //Verifier si null
	}
	
	public static function Get_User_All(){
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("SELECT * FROM User");
		$req->execute();
		while($data=$req->fetch())
		{
			$result[] = $data;
		}

		return $result; //Verifier si null
	}
	
	public static function Get_User_Id_From_String($stringWhere){
		require_once('Pdo.php');
		$bdriasec=connexion();
		$req = $bdriasec->prepare("SELECT User_Id FROM User WHERE 1 = 1 ".$stringWhere);
		$req->execute();

		$results = [];
		while($data=$req->fetch())
		{
			$results[] = $data["User_Id"];
		}
		return $results; //Verifier si null
	}
	
	public static function Get_All_Admins()
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('SELECT * FROM User WHERE Role_Id=1');
		
		$req->execute();
		$data=$req->fetchAll();
		
		return $data;
	}

	public static function Update_User($name,$firstName,$gender,$mail,$id){
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('UPDATE User set User_Name=:name, User_First_Name=:firstname, User_Gender=:gender, User_Mail=:mail where User_Id=:id');
		$req->bindParam(':gender',$gender);
		$req->bindParam(':name',$name);
		$req->bindParam(':firstname',$firstName);
		$req->bindParam(':mail',$mail);
		$req->bindParam(':id',$id);

		$req->execute();
	}

	public static function Update_Password($id,$mdp){
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('UPDATE User set User_Password=:mdp where User_Id=:id');
		$req->bindParam(':mdp',$mdp);
		$req->bindParam(':id',$id);

		$req->execute();
	}
}
?>