<style type="text/css">
</style>

<nav class="navbar navbar-expand-lg navbar-light menu">
  <h2 class="general-caption payment_data_caption" style="user-select: none;">MyPayment**</h2>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="/">Главная<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="about">О проекте</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="about">Документация</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="about">API</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
    </ul>
    <?php if(isset($_COOKIE['dataUser'])) :?>
        <a class="nav-link bg-light text-dark rounded" href="/cabinet/home">Личный кабинет</a>
    <?php else: ?>
        <a class="nav-link bg-light text-dark rounded" href="/login">Войти</a>
        <a class="nav-link" href="/reg">Зарегистрироваться</a>
    <?php endif; ?>
  </div>
</nav>