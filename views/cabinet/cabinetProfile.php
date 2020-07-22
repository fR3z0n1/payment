<?php require_once( ROOT . '/views/template/doctype.php' ); ?>
	<title>Личный кабинет | MyPayment</title>
</head>

<div class="container-fluid h-100 bg-light overflow-hidden">

	<?php require_once ROOT . '/views/cabinet/cabinet-top-row.php'; ?>

	<div class="row h-100">

			<?php require_once ROOT . '/views/cabinet/cabinet-left-menu.php'; ?>

			<div class="col-10 right-window-cabinet">
				<form method="post" class="cabinet-form-editprofile">
					<h4>Основные данные профиля</h4>
					<?php if(isset($result) && $result == true) echo '<p class="alert alert-success">Данные изменены</p>'; ?>
					<input type="text" name="firstName" placeholder="Ваше имя..." value="<?php echo $firstName; ?>">
					<input type="text" name="lastName" placeholder="Ваша фамилия..." value="<?php echo $lastName; ?>">
					<input type="tel" name="phone" placeholder="Ваш номер телефона..." value="<?php echo $phone; ?>">
					<input type="submit" name="submit" value="Изменить" class="btn btn-info">
				</form>
			</div>

		</div>

</div>

<?php require_once( ROOT . '/views/template/footer.php' ); ?>