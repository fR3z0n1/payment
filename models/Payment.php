<?php 

/**
 *  
 */
class Payment {
	
	public static function algorithmMoon($number) {

		$number_card = $number;
		$number_card = strrev($number_card);
		$new_num = '';
		$sum = 0;

		for($i = 0; $i < strlen($number_card); $i++){
			if($i % 2 !=0){
		      	$index = intval($number_card[$i]) * 2;
			    if($index >= 10){
					$index = $index - 9;
				}
		      	$new_num[$i] = $index;
		    } else { 
		      	$new_num[$i] = $number_card[$i];
		    }
			$sum = $sum + $new_num[$i];
		}

		if($sum % 10 == 0)
		  return true;
		else 
		  return false;
	}

	public static function registerPayment($trans_name, $time) {

		$url = "/payment/card/form?sessionID=$trans_name-$time";
		return $url;
	}

	public static function checkPayment($trans_id) {
		$trans = $trans_id;

		$connect = Connection::OpenConnection();

		if($connect){
			$query = $connect->prepare('SELECT `id` FROM `transactions` WHERE trans_id = :trans_id');
			$query->bindParam(':trans_id', $trans, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$connect = NULL;

			if(!empty($result)) 
				return $result;
			else 
				return false;
		}
	}

	public static function setBalance($currentBalance, $setBalance, $user_id) {

		$connect = Connection::OpenConnection();
		$newBalance = intval($currentBalance) + intval($setBalance);

		if($connect) {
			$query = $connect->prepare('UPDATE `users` SET `balance` = :newBalance WHERE `id` = :user_id');
			$query->bindParam(':newBalance', $newBalance, PDO::PARAM_INT);
			$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$result = $query->execute();
			$connect = NULL;

			if($result){
				$dataUser = unserialize($_COOKIE['dataUser']);
				$dataUser['balance'] = $newBalance;
				$dataUser = serialize($dataUser);
				setcookie('dataUser', $dataUser, time() + 1800, "/");
				return true;
			}
			else
				return false;
		} else {
			return 'Not connection ' . mysql_error();
		}
	}
	public static function getBalance($user_id) {
		$connect = Connection::OpenConnection();

		if($connect) {
			$query = $connect->prepare('SELECT `balance` FROM `users` WHERE id = :user_id');
			$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$connect = NULL;

			if($result){
				return intval($result['balance']);
			}
			else
				return false;
		} else {
			return 'Not connection ' . mysql_error();
		}
	}
}