<?php require_once( ROOT . '/views/template/doctype.php' ); ?>
	<title>Перевод на VISA | MyPayment</title>
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

					<form action="/payment/register" class="form-payment-card" method="post">

						<div class="img-card">
							<div class="row-img-block"><span class="visa_circle circle1"></span><span class="visa_circle circle2"></span>VISA</div>
							<div class="row row-90">
								<input data-format="number" type="text" name="number_card" id="number_card" placeholder="Card number xxxx-xxxx-xxxx-xxxx">
								<select class="input-3l" name="month">
									<option disabled selected>М</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select> 
								/ 
								<select class="input-3l" name="year">
									<option disabled selected>Г</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
								</select>
								<span class="text-cvv">Три цифры с обратной стороны карты</span>
								<input data-format="number" type="text" name="cvv_card" placeholder="CVV" class="input-3l input-cvv">
							</div>
						</div>
						<p class="info_pay">Сумма:</p>
						<input class="input-3l input-sum" data-format="number" type="text" name="summa">
						<!-- onkeypress="InputOnlyNumber();" -->
						<p class="info_pay">Данные получателя:</p>
						<input type="text" name="first_name" id="first_name" placeholder="First name">
						<input type="text" name="last_name" id="last_name" placeholder="Last name">
						<p class="info_pay">Назначение платежа:</p>
						<textarea name="nomination" placeholder="Nomination..."></textarea>
						
						<input data-cvv class="btn btn-primary d-block mt-2" type="submit" value="Confirm" name="submit">
					</form>
				</div>
			</div>

		</div>

</div>

<script type="text/javascript">

	let input_num_arr = document.querySelectorAll('input[data-format=number]');

	for (var i = 0; i < input_num_arr.length; i++) {
		input_num_arr[i].addEventListener('keypress', function () {
		if(event.keyCode < 48 || event.keyCode > 57)
			event.returnValue = false;
		});
	}

</script>
<script src="js/cleanInput.js"></script>
<?php require_once( ROOT . '/views/template/footer.php' ); ?>