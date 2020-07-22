<?php include_once( ROOT . '/views/template/doctype.php' ); ?>
<title>Главная | MyPayment</title>

</head>
<body>

	<div class="containter-fluid h-100 overflow-hidden">
		<?php include_once( ROOT . '/views/template/navbar.php' ); ?>

		<div class="row h-100">
			<div class="col-lg-6 col-xs-12 bg-primary">
				<div class="row general-left-block">
					<p class="general-note-up">Тестовое задание для получения стажировки</p>
					<p class="general-note-down">Разработка абстрактной платёжной системы "Оплата банковской картой"
					<br></p>
					<?php 
						if(!isset($_COOKIE['dataUser'])) {
							$href = '<a href="/preview"><button class="btn btn-light rounded px-5 py-2">Войти в Payment</button></a>';
							echo $href;
						}
					?>
					
				</div>
				
			</div>

			<div class="general-right-block col-lg-6 col-xs-12 bg-primary">
				<div class="block-img">
					<img src="/images/general-img2.png">
				</div>
			</div>
		</div>
	</div>

<?php include_once( ROOT . '/views/template/footer.php' ); ?>
