<?php include_once ROOT . '/views/template/doctype.php'; ?>
</head>
<body>
	
	<div class="block-form">
		<h2 class="payment_data_caption">Card payment | MyPayment</h2>
		<form class="form-payment-card" method="post">
			<p class="pay_information_caption">Payment Information</p>
			<hr>
			<input type="text" name="first_name" id="first_name" placeholder="First name">
			<input type="text" name="last_name" id="last_name" placeholder="Last name">
			<input type="text" name="email" id="email" placeholder="Your Email">
			<input type="text" name="email" id="numCard" placeholder="Card number">
			
			<input class="btn btn-primary" type="submit" value="Confirm">
		</form>
	</div>	

<?php include_once ROOT . '/views/template/footer.php'; ?>