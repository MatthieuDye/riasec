<?php
class User
{
	public static function Check_Password($userPassword,$userMail)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();
	   //connecté à la base de donnée 

		$req = $bdriasec->prepare("SELECT User_Password FROM User WHERE User_Mail='".$userMail."'");

		$req->execute();
		$data=$req->fetch();

		return ($data['User_Password']==$userPassword);
		
	}
	public static function Set_User_Coockie_Code($userMail,$userCookieCode){

		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("UPDATE User SET User_Cookie_Code =:cookie WHERE User_Mail=:mail");
		$req->bindParam(':cookie',$userCookieCode);
		$req->bindParam(':mail',$userMail);

		$req->execute();
	}

	public static function Get_User_Id ($userCookieCode){
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("SELECT User_Id FROM User WHERE User_Cookie_Code='".$userCookieCode."'");

		$req->execute();
		$data=$req->fetch();

		return $data["User_Id"]; //Verifier si null
	}

	public static function Check_Mail($mail){
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->query("SELECT * FROM User WHERE User_Mail='".$mail."'");
		

		$data=$req->fetch();

		return $data;
	}

	public static function Add_User($gender,$name,$firstName,$password,$mail){
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
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT Role_Id FROM User WHERE User_Id = ?");
		$req->execute(array($userId));
		$data=$req->fetch();
		
		return $data["Role_Id"];
	}
	
	public static function Get_User_Grade_Id($userId)
	{
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("SELECT Grade_Id FROM User WHERE User_Id = ?");
		$req->execute(array($userId));
		$data=$req->fetch();
		
		if(isset($data["Grade_Id"]))
		{
			return $data["Grade_Id"];
		}
		else
		{
			return null;
		}
	}

	public static function Set_User_Grade($userMail,$gradeId){

		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare("UPDATE User SET Grade_Id =:grade WHERE User_Mail=:mail");
		$req->bindParam(':grade',$gradeId);
		$req->bindParam(':mail',$userMail);

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
	
	public static function Get_User_Id_From_String($stringWhere){
		require_once('Pdo.php');
		$bdriasec=connexion();


		$req = $bdriasec->prepare("SELECT User_Id FROM User WHERE 1 = 1".$stringWhere);

		$req->execute();
		while($data=$req->fetch())
		{
			$results[] = $data["User_Id"];
		}

		return $results; //Verifier si null
	}

	public static function Update_User($name,$firstName,$gender,$mail,$id){
		require_once('Pdo.php');
		$bdriasec=connexion();

		$req = $bdriasec->prepare('UPDATE INTO User set User_Name=:name, User_First_Name=:firstname, User_Gender=:gender, User_Mail=:mail where User_Id=:id');
		$req->bindParam(':gender',$gender);
		$req->bindParam(':name',$name);
		$req->bindParam(':firstname',$firstName);
		$req->bindParam(':mail',$mail);
		$req->bindParam(':id',$id);

		$req->execute();
	}
}
?>