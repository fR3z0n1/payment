<?php 

include_once '../models/Payment.php';
include_once '../components/Connection.php';

$payment = new Payment();

$dataPaymentBalance = [
	'number_card' => '',
	'month' => '',
	'year' => '',
	'cvv' => '',
	'summa' => '',
	'errors' => false
];

if(isset($_POST['send_balance'])){

	if(!empty($_POST['summa'])){
		$dataPaymentBalance['summa'] = $_POST['summa'];
	} else {
		$dataPaymentBalance['errors'][] = 'Не указана сумма';
	}

	if(!empty($_POST['number_card'])){
		$dataPaymentBalance['number_card'] = $_POST['number_card'];

		if($payment->algorithmMoon($dataPaymentBalance['number_card']) === false){
			$dataPaymentBalance['errors'][] = 'Карта не прошла алгоритм луны';
		}

	} else {
		$dataPaymentBalance['errors'][] = 'Не указан номер карты';
	}

	if(!empty($_POST['month']) && !empty($_POST['year'])){
		$dataPaymentBalance['month'] = $_POST['month'];
		$dataPaymentBalance['year'] = $_POST['year'];
	} else {
		$dataPaymentBalance['errors'][] = 'Не указан срок карты';
	}

	if(!empty($_POST['cvv_card'])){
		$dataPaymentBalance['cvv'] = $_POST['cvv_card'];
	} else {
		$dataPaymentBalance['errors'][] = 'Не указан код с обратной стороны карты';
	}

	if($dataPaymentBalance['errors'] === false){
		
		$dataUser = unserialize($_COOKIE['dataUser']);
		$balance = $dataUser['balance'];
		$setBalance = Payment::setBalance($balance, $dataPaymentBalance['summa'], $dataUser['id']);

		if($setBalance === true) {
			header('Location: /payment/balance/success');
			unset($dataPaymentBalance);
			exit;
		} else {
			header('Location: /payment/balance/error');
			unset($dataPaymentBalance);
			exit;
		}

	} else {
		unset($dataPaymentBalance);
		header('Location: /payment/balance/error');
	}
}
