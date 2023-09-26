<?php

if ($HTTP_GET_VARS['origin'] == 'checkout_payment.php') {
  define('NAVBAR_TITLE', 'Realizar Pedido');
  define('TOP_BAR_TITLE', 'Realizar Pedido');
  define('HEADING_TITLE', 'Comprar aqui é muito fácil.');
  define('TEXT_STEP_BY_STEP', 'Te ajudaremos a efetuar a sua compra passo a passo.');
} else {
define('NAVBAR_TITLE', 'Login');
define('TOP_BAR_TITLE', 'Login to \'' . STORE_NAME . '\'');
  define('HEADING_TITLE', 'My Login.<P><font color="#000000" size="2"><center>If you are already customer among with his/her e-mail and password.<br> If it is not enters with yours e-mail to register.</center>');
  define('TEXT_STEP_BY_STEP', ''); // should be empty
}
define('TEXT_VISITORS_CART', '');
define('ENTRY_EMAIL_ADDRESS2', 'E-Mail Address:');
define('TEXT_NEW_CUSTOMER', 'I am a new member.');
define('TEXT_RETURNING_CUSTOMER', '');
define('TEXT_COOKIE', 'Save login information in a cookie?');
define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten? Click here to get it sent to you.');
define('TEXT_CREATE_ACCOUNT', 'No account with us? Click here to create one.');
define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> No match for \'E-Mail Address\' and/or \'Password\'.');
define('TEXT_LOGIN_ERROR_EMAIL', '<font color="#ff0000"><b>ERROR:</b></font> This \'E-Mail\' it was already registered, use yours \'password\' to enter.');

?>
