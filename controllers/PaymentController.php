<?php 

class PaymentController {

	public function actionCard() {

		include_once ROOT . '/views/cabinet/payment/paymentCard.php';
		return true;
	}
	public function actionBalance() {


		include_once ROOT . '/views/cabinet/balance/balanceForm.php';
		// include_once ROOT . '/views/cabinet/balance/payment.php';
		return true;
	}

	public function actionBalanceSuccess() {
		include_once ROOT . '/views/cabinet/balance/balanceSuccess.php';
		return true;
	}
	public function actionBalanceError() {
		include_once ROOT . '/views/cabinet/balance/balanceError.php';
		return true;
	}

	public function actionCardForm($sessionID) {

		$transNameFull = $_GET['sessionID'];
		$transName = strstr($transNameFull, '-', true);	
		$dataUser = unserialize($_COOKIE['dataUser']);

		$setDataPayment = [
			'year' => '',
			'month' => '',
			'cvv' => '',
			'number_card' => '',
			'first_name' => '',
			'last_name' => '',
			'errors' => false,
			'payment_type' => 'transfer',
		];

		if(isset($_COOKIE[$transName])){
			$payment = unserialize($_COOKIE[$transName]);

			foreach ($payment as $key => $value) {
				$setDataPayment[$key] = $value;
			}

		} else {
			header('Location: /payment/card');
			exit();
		}

		if(isset($_POST['send_bd'])){

			$connect = Connection::OpenConnection();
			$user_balance = Payment::getBalance($setDataPayment['user_id']);

			if($user_balance > 0 && $setDataPayment['summa'] <= $user_balance){
				if($connect == true && $setDataPayment['errors'] === false){

					if(Payment::checkPayment($setDataPayment['trans_name']) == false)
					{
						$query = $connect->prepare(
							'INSERT INTO `transactions`(`id`, `id_session`, `user_id`, `trans_id`, `data_trans`, `payment_type`, `summa`, `date_at`) VALUES (NULL, :sessionID, :user_id, :transID, :arrayPayment, :is_transfer, :summa, NULL)'
						);
						$query->bindParam(':sessionID', $setDataPayment['session_id'], PDO::PARAM_STR);
						$query->bindParam(':user_id', $setDataPayment['user_id'], PDO::PARAM_INT);
						$query->bindParam(':transID', $setDataPayment['trans_name'], PDO::PARAM_STR);
						$query->bindParam(':arrayPayment', $_COOKIE[$transName], PDO::PARAM_STR);
						$query->bindParam(':is_transfer', $setDataPayment['payment_type'], PDO::PARAM_STR);
						$query->bindParam(':summa', $setDataPayment['summa'], PDO::PARAM_STR);
						$result = $query->execute();
						$connect = NULL;

						if($result) {
							setcookie($transName, " ", time() - 1800, "/payment");
							$currentBalance = $user_balance;

							$balance = Payment::setBalance($currentBalance, -$setDataPayment['summa'], $setDataPayment['user_id']);

							$dataUser['balance'] = Payment::getBalance($setDataPayment['user_id']);					
							$dataUser = serialize($dataUser);
							setcookie('dataUser', $dataUser, time() + 3600, "/");
							header('Location: /payment/card/success');
							exit;
						}
					} else {
						setcookie($transName, " ", time() - 1800, "/payment");
						header('Location: /payment/card/error');
						exit;
					}

				} else {
					header('Location: /payment/card/error?sessionID=' . $transNameFull);
					exit;	
				}
			} else {
				$errorBalance = TRUE;
			}
		}

		include_once ROOT. '/views/cabinet/payment/paymentCardForm.php';
		return true;
	}
	public function actionRegPay() {

		$data_user = unserialize($_COOKIE['dataUser']);

		$setDataPayment = [
			'year' => '',
			'month' => '',
			'cvv' => '',
			'number_card' => '',
			'first_name' => '',
			'last_name' => '',
			'errors' => false,
			'nomination' => '',
			'user_id' => $data_user['id'],
			'summa' => '',
		];

		if(isset($_POST['submit'])){

			if(!empty($_POST['year']) && !empty($_POST['month'])) {
				$setDataPayment['year'] = $_POST['year'];
				$setDataPayment['month'] = $_POST['month'];
			}
			else 
				$setDataPayment['errors'][] = 'Вы не ввели срок действия карты';

			if(!empty($_POST['cvv_card']))
				$setDataPayment['cvv'] = $_POST['cvv_card'];
			else 
				$setDataPayment['errors'][] = 'Вы не ввели CVV карты';

			if(!empty($_POST['first_name']) && !empty($_POST['last_name'])){
				$setDataPayment['first_name'] = $_POST['first_name'];
				$setDataPayment['last_name'] = $_POST['last_name'];
			}
			else 
				$setDataPayment['errors'][] = 'Вы не ввели данные получателя(CardHolder)';

			if(!empty($_POST['number_card'])){
				$setDataPayment['number_card'] = filter_var($_POST['number_card'], FILTER_SANITIZE_NUMBER_INT);
			 	$setDataPayment['number_card'] = str_replace('-', '', $setDataPayment['number_card']);
			}
			else {
				$setDataPayment['errors'][] = 'Вы не ввели номер карты';
			}

			if(!empty($_POST['nomination'])) {
				$setDataPayment['nomination'] = $_POST['nomination'];
			}
			else 
				$setDataPayment['errors'][] = 'Не указано назначение платежа';

			if(!empty($_POST['summa'])) {
				$setDataPayment['summa'] = $_POST['summa'];
			}
			else 
				$setDataPayment['errors'][] = 'Не указана сумма';

			if(!empty($_POST['number_card'])){

				$setDataPayment['number_card'] = filter_var($_POST['number_card'], FILTER_SANITIZE_NUMBER_INT);
				$setDataPayment['number_card'] = str_replace('-', '', $setDataPayment['number_card']);
				$result_card = Payment::algorithmMoon($setDataPayment['number_card']);
				if(!$result_card) 
					$setDataPayment['errors'][] = 'Карта не прошла алгоритм Луна';
			} 
			else 
				$setDataPayment['errors'][] = 'Вы не ввели номер карты';
		}

		if(isset($_POST['submit'])){

			$transName = 'trans_' . uniqid();

			$dataPayment = array(
				'session_id' => session_id(),
				'date_at' => time(),
				'trans_name' => $transName,
			 );

			foreach ($setDataPayment as $key => $value) {
				$dataPayment[$key] = $value;
			}

			$dataPayment = serialize($dataPayment);

			setcookie($transName, $dataPayment, time() + 1800);

			$url = Payment::registerPayment($transName, time());
			header("Location: $url");
			exit();
		}
	}

	public function actionPaymentError() {

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

	public function actionPaymentSuccess() {

		include_once ROOT . '/views/cabinet/payment/paymentSuccess.php';
		return true;
	}
}