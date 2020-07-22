<?php 

class SiteController {

	public function actionIndex() {

		return include_once( ROOT . '/views/index.php' );
	}
	public function actionContact() {
		
		return include_once( ROOT . '/views/contacts.php' );
	}

}

?>