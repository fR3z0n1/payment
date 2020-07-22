<?php 

class UserController {

	public function actionLogin() {

		$email = '';
		$password = '';

		if(isset($_POST['submit'])){

			$errors = false;

			if(!empty($_POST['email']))
				$email = $_POST['email'];

			if(!empty($_POST['password']))
				$password = $_POST['password'];

			if(User::checkUserData($email, htmlspecialchars($password)))
			{
				$user = User::checkUserData($email, htmlspecialchars($password));
				$dataUser = serialize($user);
				setcookie('dataUser', $dataUser, time() + 3600*12);

				$errors = array();
			}
			else {
				$errors[] = 'Пароль или логин введён неверно';
			}
		}	

		require_once( ROOT . '/views/cabinet/login.php' );
		return true;
	}

	public function actionReg() {

		$login = '';
		$email = '';
		$password = '';

		if(isset($_POST['submit'])){

			$errors = false; 
			
			$login = $_POST['login'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			if(!User::checkPassword($password))
				$errors[] = 'Пароль менее 5 символов';

			if(User::checkEmailExist($email))
				$errors[] = 'Такой email уже используется';
			if($errors == false) {
				$createUser = User::createUser($login, $email, password_hash(htmlspecialchars($password), PASSWORD_DEFAULT));
				if($createUser){
					$userId = User::checkByIdUser($login);

					$user = ['login' => $login, 'id' => $userId, 'balance' => 0];
					$dataUser = serialize($user);
					setcookie('dataUser', $dataUser, time() + 3600*12);

					header('Location: /cabinet/home');
					exit();
				}
			}
		}

		require_once( ROOT . '/views/cabinet/register.php' );
		return true;
	}

	public function actionLogout() {
        
        setcookie(session_name(),'',time() - 3600);
        setcookie('dataUser', '', time() - 3600);
        session_destroy();
        header("Location: /");
        exit();
    }

    public function actionPreview() {

        require_once( ROOT . '/views/cabinet/preview.php' );
		return true;
    }
}