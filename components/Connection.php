<?php 

class Connection {

	public static function OpenConnection() {

		$host = 'localhost';
		$db = 'payment';
		$user = 'root';
		$pass = '';

		$dsn = 'mysql:host=' . $host . ';dbname=' . $db;
		$pdo = new PDO($dsn, $user, $pass);

		if($pdo)
			return $pdo;
		else 
			return false;
	}
}

?>