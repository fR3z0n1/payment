<?php 

class User {

	public static function checkEmail() {
		if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
	}
	public static function checkPassword($password) {
		
		if (strlen($password) >= 5) {
            return true;
        } else {
            return false;
        }
	}
	public static function checkHashPassword($email) {

		$connect = Connection::OpenConnection();
		if($connect != false){

			$sql = 'SELECT `password` FROM `users` WHERE email = :email';
			$result = $connect->prepare($sql);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->execute();

			$result = $result->fetch(PDO::FETCH_ASSOC);
			$connect = null;

			return $result['password'];
		} 
		return false;
	}

	public static function checkUserData($email, $password) {
		
		$connect = Connection::OpenConnection();
		if($connect != false){

			$pass_hash = User::checkHashPassword($email);
			if(password_verify($password, $pass_hash)){
				
				// $sql = 'SELECT * FROM `users` WHERE email = :email AND password = :password';
				$sql = 'SELECT * FROM `users` WHERE email = :email';
				$result = $connect->prepare($sql);
				$result->bindParam(':email', $email, PDO::PARAM_STR);
				$result->execute();

				$user = $result->fetch(PDO::FETCH_ASSOC);
				$connect = null;
				if($user){
					return $user;
				} else
					return false;
			}			
		} 
		else
			die();
	}
	public static function checkEmailExist($email) {
		$connect = Connection::OpenConnection();

		if($connect != false){
			$sql = 'SELECT `id` FROM `users` WHERE email = :email';
			$result = $connect->prepare($sql);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->execute();

			$existEmail = $result->fetch();
			$connect = null;
			if($existEmail){
				return true;
			} else 
				return false;
		}			
	}
	public static function createUser($login, $email, $password) {
		$connect = Connection::OpenConnection();

		$sql = 'INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES (NULL, :login, :email, :password)';
		$result = $connect->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();

		if($result)
			return true;
		else 
			return false;
	}
	public static function checkByIdUser($login) {
		$connect = Connection::OpenConnection();

		if($connect != false){
			$sql = 'SELECT `id` FROM `users` WHERE login = :login';
			$result = $connect->prepare($sql);
			$result->bindParam(':login', $login, PDO::PARAM_STR);
			$result->execute();

			$existId = $result->fetch(PDO::FETCH_ASSOC);
			$connect = null;
			if($existId){
				return $existId['id'];
			} else 
				return false;
		}			
	}
}