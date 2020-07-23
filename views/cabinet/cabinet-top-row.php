<div class="row top-row">
	<div class="col-6">
  		<h2 class="general-caption payment_data_caption caption-cabinet"><span class="text-danger">My</span>Payment*</h2>
  		<p class="d-inline ml-3 font-weight-bold text-dark">Личный кабинет</p>
	</div>
	<div class="col-6 text-right line-height-50">
		<?php
			if(isset($_COOKIE['dataUser'])) {
			$user = unserialize($_COOKIE['dataUser']);
		 ?>
		<p class="d-inline font-weight-bold text-dark mx-3">Баланс: <?php echo $user['balance'] ?> руб</p>
		<p class="d-inline font-weight-bold text-dark mx-3">ID клиента - <?php echo $user['id']; ?></p>
		<p class="d-inline font-weight-bold text-dark mx-3">Ваш логин - <?php echo $user['login'];?></p>
		<?php } else { echo '<meta http-equiv="refresh" content="0; url=/logout">'; }?>
		<a class="mx-3 text-danger" href="/logout">Выход</a>
	</div>
	<hr>
</div>