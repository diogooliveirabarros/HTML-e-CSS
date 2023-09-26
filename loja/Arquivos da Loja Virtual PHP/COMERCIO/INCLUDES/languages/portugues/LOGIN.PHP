<?php

if ($HTTP_GET_VARS['origin'] == 'checkout_payment.php') {
  define('NAVBAR_TITLE', 'Realizar Pedido');
  define('TOP_BAR_TITLE', 'Realizar Pedido');
  define('HEADING_TITLE', 'Comprar aqui é muito fácil.');
  define('TEXT_STEP_BY_STEP', 'Te ajudaremos a efetuar a sua compra passo a passo.');
} else {
  define('NAVBAR_TITLE', 'Entrar');
  define('TOP_BAR_TITLE', 'Entrar na \'' . STORE_NAME . '\'');
  define('HEADING_TITLE', 'Meu Login.<P><font color="#000000" size="2"><center>Se você já é cliente entre com seu e-mail e senha.<br> Se não é entre com seu e-mail para se cadastrar.</center>');
  define('TEXT_STEP_BY_STEP', ''); // should be empty
}
define('TEXT_VISITORS_CART', '');
define('ENTRY_EMAIL_ADDRESS2', 'Seu e-mail');
define('TEXT_NEW_CUSTOMER', 'Sou um novo cliente.');
define('TEXT_RETURNING_CUSTOMER', '');
define('TEXT_COOKIE', 'Marque esta seleção para que sua senha seja lembrada.');
define('TEXT_PASSWORD_FORGOTTEN', 'Sua senha e e-mail não são aceitos?. Esqueceu-as?. Clique aqui para enviarmos uma nova senha para o seu e-mail imediatamente.');
define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> O \'E-Mail\' e/ou \'Senha\' Você tem que digitar o seu e-mail e senha corretas pois estes não constam em nosso banco de dados.');
define('TEXT_LOGIN_ERROR_EMAIL', '<font color="#ff0000"><b>ERROR:</b></font> Este \'E-Mail\' já foi cadastrado, use sua \'senha\' para entrar.');
?>
