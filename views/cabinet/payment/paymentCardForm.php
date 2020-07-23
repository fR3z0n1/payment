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
						<? if(isset($errorBalance) && $errorBalance == TRUE) echo '<p class="alert alert-danger">Недостаточно средств для перевода</p>';?>
					<form class="form-payment-card" method="post">

						<div class="img-card">
							<div class="row-img-block"><span class="visa_circle circle1"></span><span class="visa_circle circle2"></span>VISA</div>
							<div class="row row-90">
								<input id="number_card" type="text" value="<? echo $setDataPayment['number_card'];?>" name="number_card" disabled>
								<input class="input-3l" type="text" value="<? echo $setDataPayment['month'];?>" name="month" disabled>
								/ 
								<input class="input-3l" type="text" value="<? echo $setDataPayment['year'];?>" name="year" disabled>
								<span class="text-cvv">Три цифры с обратной стороны карты</span>
								<input type="text" placeholder="CVV" class="input-3l input-cvv" value="<? echo $setDataPayment['cvv'];?>" name="cvv" disabled>
							</div>
							<input type="hidden" name="first_name" value="<? echo $setDataPayment['first_name'];?>">
							<input type="hidden" name="last_name" value="<? echo $setDataPayment['last_name'];?>">
							<div class="cardholder">
								<? echo $setDataPayment['first_name'] . ' ' . $setDataPayment['last_name']; ?>
							</div>
						</div>
						<p class="info_pay">Сумма:</p>
						<input class="input-3l input-sum" type="text" name="summa" value="<? echo $setDataPayment['summa'];?>" disabled>
						<p class="info_pay">Назначение платежа:</p>
						<textarea name="nomination" placeholder="Не указан" disabled><? echo $setDataPayment['nomination']; ?></textarea>
						
						<input data-cvv class="btn btn-primary d-block mt-2" type="submit" value="Отправить" name="send_bd">
						<a href="/payment/card" class="btn btn-info" style="margin-top: 10px;">Изменить данные</a>
					</form>
				</div>
			</div>

		</div>

</div>

<script src="js/onlyNumber.js"></script>
<script src="js/cleanInput.js"></script>
<?php require_once( ROOT . '/views/template/footer.php' ); ?>