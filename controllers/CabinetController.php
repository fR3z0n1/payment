<?php 

/**
 * Личный кабинет
 */
class CabinetController
{
	public function actionHome() {

		include_once ROOT . '/views/cabinet/cabinetHome.php';
		return true;
	}
	public function actionEdit() {

		if(isset($_POST['submit'])){
			$lastName = '';
			$firstName = '';
			$phone = '';

			if(!empty($_POST['lastName']))
				$lastName = $_POST['lastName'];
			if(!empty($_POST['firstName']))
				$firstName = $_POST['firstName'];
			if(!empty($_POST['phone']))
				$phone = $_POST['phone'];

			$result = Cabinet::editDataUser($_SESSION['user']['id'], $lastName, $firstName, $phone);
		}

		$dataUser = Cabinet::getDataUser($_SESSION['user']['id']);

		$lastName = $dataUser['lastname'];
		$firstName = $dataUser['firstname'];
		$phone = $dataUser['phone'];

		include_once ROOT . '/views/cabinet/cabinetProfile.php';
		return true;
	}
}