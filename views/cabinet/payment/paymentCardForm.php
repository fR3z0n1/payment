<?php require_once( ROOT . '/views/template/doctype.php' ); ?>
	<title>Подтверждение платежа | MyPayment</title>
</head>
<body>

<div class="container-fluid h-100 bg-light">

	<?php require_once ROOT . '/views/cabinet/cabinet-top-row.php'; ?>

	<div class="row">

			<?php require_once ROOT . '/views/cabinet/cabinet-left-menu.php'; ?>

			<div class="col-10 right-window-cabinet">
				<div class="block-form">
					<h2 class="payment_data_caption">MyPayment</h2>

						<p class="pay_information_caption">Payment Information</p>
						<hr>
						<h4>Подтверждение платежа</h4>
						<p>Проверьте введённые данные</p>
						
					<form class="form-payment-card" method="post">

						<div class="img-card">
							<div class="row-img-block"><span class="visa_circle circle1"></span><span class="visa_circle circle2"></span>VISA</div>
							<div class="row row-90">
								<input id="number_card" type="text" value="<? echo $number_card;?>" disabled>
								<input class="input-3l" type="text" value="<? echo $month;?>" disabled>
								/ 
								<input class="input-3l" type="text" value="<? echo $year;?>" disabled>
								<span class="text-cvv">Три цифры с обратной стороны карты</span>
								<input type="text" placeholder="CVV" class="input-3l input-cvv" value="<? echo $cvv;?>" disabled>
							</div>
							<div class="cardholder"><? echo "$firstName $lastName" ?></div>
						</div>
						<p class="info_pay">Сумма:</p>
						<input class="input-3l input-sum" type="text" name="summa" value="<? echo $summa;?>" disabled>
						<p class="info_pay">Назначение платежа:</p>
						<textarea name="nomination" placeholder="Не указан" disabled><? echo $nomination; ?></textarea>
						
						<input data-cvv class="btn btn-primary d-block mt-2" type="submit" value="Отправить" name="send_bd">
						<a href="/payment/card" class="btn btn-info" style="margin-top: 10px;">Изменить данные</a>
					</form>
				</div>
			</div>

		</div>

</div>

<script type="text/javascript">
	let number_card = document.getElementById('number_card');
	let input_cvv = document.querySelector('input[data-cvv]');

	console.log(input_cvv.value);

	number_card.addEventListener('keypress', InputOnlyNumber);

	function InputOnlyNumber() {
		if(event.keyCode < 48 || event.keyCode > 57)
			event.returnValue = false;
	}
</script>
<script src="js/cleanInput.js"></script>
<?php require_once( ROOT . '/views/template/footer.php' ); ?>