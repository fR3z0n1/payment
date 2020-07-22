<?php 

return array(
    //Оплаты
    'payment/success' => 'payment/success',
    'payment/error' => 'payment/error/$1',
    'payment/card/form' => 'payment/cardForm/$1',
    'payment/register' => 'payment/regPay',
    'payment/card' => 'payment/card',
    'payment/balance' => 'payment/balance',
	//Кабинет
	'cabinet/home' => 'cabinet/home',
    'cabinet/edit' => 'cabinet/edit',
   //Контакты
    'preview' => 'user/preview',
    //Prev
    'contacts' => 'site/contact',
    'logout' => 'user/logout',
    'login' => 'user/login',
    'reg' => 'user/reg',
    //Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '(^.*$)' => 'site/index', // actionIndex в SiteControlle
);