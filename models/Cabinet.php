<?php

class Cabinet {
	public static function getDataUser($id) {
		$connect = Connection::OpenConnection();

		$result = $connect->query("SELECT * FROM `users` WHERE id = '$id'", PDO::FETCH_ASSOC);
		$dataUser = $result->fetch();
		$connect = null;
		$result = null;

		return $dataUser;
	}
	public static function editDataUser($id, $lastName, $firstName, $phone) {
		$connect = Connection::OpenConnection();

		$result = $connect->query("UPDATE `users` SET `firstname` = '$firstName', `lastname` = '$lastName', `phone` = '$phone' WHERE `users`.`id` = '$id'");
		$connect = null;
		if($result)
			return true;
		else 
			return false;
	}

}

?>