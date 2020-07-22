<?php require_once( ROOT . '/views/template/doctype.php' ); ?>
	<title>Ошибка платежа | MyPayment</title>
</head>
<body>

<div class="container-fluid h-100 bg-light">

	<?php require_once ROOT . '/views/cabinet/cabinet-top-row.php'; ?>

	<div class="row">

			<?php require_once ROOT . '/views/cabinet/cabinet-left-menu.php'; ?>

			<div class="col-10 right-window-cabinet">
				<h3>Ошибка проведения платежа</h3>
				<? 
					if(isset($errors)){
						foreach ($errors as $error) {
							echo '<p class="alert alert-danger">' . $error . '</p>';
						}
					}
				?>
			</div>

		</div>

</div>

<?php require_once( ROOT . '/views/template/footer.php' ); ?>