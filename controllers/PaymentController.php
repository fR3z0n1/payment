<?php 

class PaymentController {

	public function actionCard() {

		include_once ROOT . '/views/cabinet/payment/paymentCard.php';
		return true;
	}
	public function actionBalance() {
		echo 'action balance';
		return true;
	}

	public function actionCardForm($sessionID) {

		$year = '';
		$month = '';
		$cvv = '';
		$number_card = '';
		$firstName = '';
		$lastName = '';
		$errors = false;
		$payment_type = 'transfer';
		$transName = $_GET['sessionID'];
		$transName = strstr($transName, '-', true);	

		/////////////

		// $setDataPayment = [
		// 	'year' => '',
		// 	'month' => '',
		// 	'cvv' => '',
		// 	'number_card' => '',
		// 	'firstName' => '',
		// 	'lastName' => '',
		// 	'errors' => false,
		// 	'payment_type' => 'transfer',
		// ];

		// if(isset($_COOKIE[$transName])){
		// 	$payment = unserialize($_COOKIE[$transName]);

		// 	foreach ($payment as $key => $value) {
		// 		$setDataPayment[$key] = $value;
		// 	}
		// 	echo '<pre>';
		// 	print_r($setDataPayment);
		// 	echo '</pre>';

		// 	exit;
		// } else {
		// 	header('Location: /payment/card');
		// 	exit();
		// }

		///////////


		if(isset($_COOKIE[$transName])){
			$payment = unserialize($_COOKIE[$transName]);

			foreach ($payment as $key => $value) {
				$$key = $value;
			}
		} else {
			header('Location: /payment/card');
			exit();
		}

		if(isset($_POST['send_bd'])){

			$connect = Connection::OpenConnection();

			if($connect == true && $payment['errors'] === false){

				if(Payment::checkPayment($_GET['sessionID']) == false)
				{
					$query = $connect->prepare(
					'INSERT INTO `transactions`(`id`, `id_session`, `user_id`, `trans_id`, `data_trans`, `payment_type`, `summa`, `date_at`) VALUES (NULL, :sessionID, :user_id, :transID, :arrayPayment, :is_transfer, :summa, NULL)'
					);
					$query->bindParam(':sessionID', $payment['session_id'], PDO::PARAM_STR);
					$query->bindParam(':user_id', $payment['user_id'], PDO::PARAM_INT);
					$query->bindParam(':transID', $_GET['sessionID'], PDO::PARAM_STR);
					$query->bindParam(':arrayPayment', $_COOKIE[$transName], PDO::PARAM_STR);
					$query->bindParam(':is_transfer', $payment_type, PDO::PARAM_STR);
					$query->bindParam(':summa', $summa, PDO::PARAM_STR);
					$result = $query->execute();
					$connect = NULL;

					if($result) {
						setcookie($transName, " ", time() - 1800, "/payment");
						header('Location: /payment/success');
						exit;
					}
				} else {

				}

			} else {
				header('Location: /payment/error?sessionID=' . $_GET['sessionID']);
				exit;	
			}
		}

		include_once ROOT. '/views/cabinet/payment/paymentCardForm.php';
		return true;
	}
	public function actionRegPay() {

		$year = '';
		$month = '';
		$cvv = '';
		$number_card = '';
		$firstName = '';
		$lastName = '';
		$errors = false;
		$nomination = '';
		$dataUser = unserialize($_COOKIE['dataUser']);
		$user_id = $dataUser['id'];
		$summa = '';

		if(isset($_POST['submit'])){

			if(!empty($_POST['year']) && !empty($_POST['month'])) {
				$year = $_POST['year'];
				$month = $_POST['month'];
			}
			else 
				$errors[] = 'Вы не ввели срок действия карты';

			if(!empty($_POST['cvv_card']))
				$cvv = $_POST['cvv_card'];
			else 
				$errors[] = 'Вы не ввели CVV карты';

			if(!empty($_POST['first_name']) && !empty($_POST['last_name'])){
				$firstName = $_POST['first_name'];
				$lastName = $_POST['last_name'];
			}
			else 
				$errors[] = 'Вы не ввели данные получателя(CardHolder)';

			if(!empty($_POST['number_card'])){
				$number_card = filter_var($_POST['number_card'], FILTER_SANITIZE_NUMBER_INT);
			 	$number_card = str_replace('-', '', $number_card);
			}
			else {
				$errors[] = 'Вы не ввели номер карты';
			}

			if(!empty($_POST['nomination'])) {
				$nomination = $_POST['nomination'];
			}
			else 
				$errors[] = 'Не указано назначение платежа';

			if(!empty($_POST['summa'])) {
				$summa = $_POST['summa'];
			}
			else 
				$errors[] = 'Не указана сумма';

			if(!empty($_POST['number_card'])){

				$number_card = filter_var($_POST['number_card'], FILTER_SANITIZE_NUMBER_INT);
				$number_card = str_replace('-', '', $number_card);
				$result_card = Payment::algorithmMoon($number_card);
				if(!$result_card) 
					$errors[] = 'Карта не прошла алгоритм Луна';
			} 
			else 
				$errors[] = 'Вы не ввели номер карты';
		}

		if(isset($_POST['submit'])){

			$transName = 'trans_' . uniqid();

			$dataPayment = array(
				'session_id' => session_id(),
				'user_id' => $user_id,
				'trans_name' => $transName,
				'year' => $year,
				'month' => $month,
				'cvv' => $cvv,
				'number_card' => $number_card,
				'summa' => $summa,
				'firstName' => $firstName,
				'lastName' => $lastName,
				'nomination' => $nomination,
				'date_at' => time(),
				'errors' => $errors,
			 );

			$dataPayment = serialize($dataPayment);

			setcookie($transName, $dataPayment, time() + 1800);

			$url = Payment::registerPayment($transName, time());
			header("Location: $url");
			exit();
		}
	}

	public function actionError() {

		$transName = $_GET['sessionID'];
		$transName = strstr($transName, '-', true);	

		if(isset($_COOKIE[$transName])){
			$dataPayment = unserialize($_COOKIE[$transName]);

			if($dataPayment['errors']){
				$errors = $dataPayment['errors'];
				setcookie($transName, " ", time() - 1800, "/payment");
			}
		}

		include_once ROOT . '/views/cabinet/payment/paymentError.php';
		return true;
	}

	public function actionSuccess() {

		include_once ROOT . '/views/cabinet/payment/paymentSuccess.php';
		return true;
	}
}