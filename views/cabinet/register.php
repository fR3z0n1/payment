<?php include_once( ROOT . '/views/template/doctype.php' ); ?>

	<title>Регистрация | MyPayment</title>
</head>

<body>
	<div class="general-block-auth mx-auto">
		<h3>Регистрация в системе</h3>
  		<form class="form-auth form-register" method="post">
  			<h2 class="general-caption caption-login payment_data_caption">MyPayment*</h2>
			<?php 
				
				if(isset($errors) && $errors == false) { 
					echo '<p class="alert alert-success" role="alert">Вы зарегистрировались</p>';
					echo '	<script> 
								setTimeout(() => window.location.replace("/cabinet/home"), 2000);
							</script>';
				}
				if(isset($errors) && $errors == true) { 
					for ($i=0; $i < count($errors); $i++) { 
					 	echo '<p class="alert alert-danger" role="alert"> - ' . $errors[$i] . '</p>';
					}
				}
			?>
			<input class="border rounded" type="text" placeholder="Login" name="login" required="">
			<input class="border rounded" type="email" placeholder="Email" name="email" required="">
			<input class="border rounded" type="password" placeholder="Password" name="password" required="">
			<input class="btn btn-primary rounded px-4" type="submit" value="Регистрация" name="submit">
			<a href="/login">У меня есть аккаунт</a>
		</form>
		<a href="/"><button class="btn btn-info d-block mx-auto">Вернуться на сайт</button></a>
	</div>
</body>
</html>