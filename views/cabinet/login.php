<?php include_once( ROOT . '/views/template/doctype.php' ); ?>

	<title>Авторизация | MyPayment</title>
</head>

<body>
	<div class="general-block-auth mx-auto">
		<h3>Вход в личный кабинет</h3>
  		<form class="form-auth" method="post">
  			<h2 class="general-caption caption-login payment_data_caption">MyPayment*</h2>
			<?php 
				if(isset($errors) && $errors == true) { 
					foreach ($errors as $err) {
						echo '<p class="alert alert-danger" role="alert"> - ' . $err . '</p>';
					}
				}
				else if(isset($errors) && $errors == false) { 
					
					echo '<p class="alert alert-success" role="alert">Вы авторизованы</p>';
					echo '	<script> 
								setTimeout(() => window.location.replace("/cabinet/home"), 2000);
							</script>';
				}
			?>
			<input class="border rounded" type="email" placeholder="Email" name="email" required="">
			<input class="border rounded" type="password" placeholder="Password" name="password" required="">
			<input class="btn btn-primary rounded px-4" type="submit" value="Войти" name="submit">
			<a href="/reg">Зарегистироваться</a> | <a href="/recovery">Забыли пароль?</a>
		</form>
		<a href="/"><button class="btn btn-info d-block mx-auto">Вернуться на сайт</button></a>
	</div>
</body>
</html>