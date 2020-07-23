<?php 

return array(
    //Баланс
    'payment/balance/success' => 'payment/balanceSuccess',
    'payment/balance/error' => 'payment/balanceError',
    'payment/balance' => 'payment/balance',
    //Оплаты
    'payment/card/success' => 'payment/paymentSuccess',
    'payment/card/error' => 'payment/paymentError/$1',
    'payment/card/form' => 'payment/cardForm/$1',
    'payment/register' => 'payment/regPay',
    'payment/card' => 'payment/card',
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