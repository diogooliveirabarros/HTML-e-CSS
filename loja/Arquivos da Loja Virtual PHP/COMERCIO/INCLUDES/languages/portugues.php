<?php
/*
  $Id: portugues.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

//TEXTO DA P�GINA INICIAL DO SEU SITE:
//Para alterar o texto da p�gina inicial, voc� pode utilizar o campo
//Texto Inicial do Painel de Administra��o (Configura��es->Sua Loja), ou
//o campo abaixo, ou ambos (ser� exibido o Texto Inicial e logo ap�s o texto
//definido aqui).

//O campo Texto Inicial possui um limite de 255 caracteres. Caso o texto 
//pretendido para a p�gina inicial ultrapasse este valor, a utiliza��o do
//campo abaixo ser� obrigat�ria.

//Este campo � inabilitado na instala��o. Para habilit�-lo, substitua o
//texto no local indicado e apague completamente as linhas indicadas abaixo.

/* <-- APAGUE COMPLETAMENTE ESTA LINHA

$DW_TEXTO_INICIAL = "Insira aqui o texto que aparecer� em sua tela inicial.<br><br>Se desejar, utilize c�digo HTML para a formata��o.";

APAGUE COMPLETAMENTE ESTA LINHA --> */

//FIM DO TRECHO DE ALTERA��O DA P�GINA INICIAL. N�O ALTERE O C�DIGO ABAIXO.

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'pt_BR'
// on FreeBSD try 'pt_BR.ISO_8859-1'
// on Windows try 'pt', or 'Portugu�s'
setlocale(LC_TIME, 'pt_BR');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'BR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="pt"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Criar Conta');
define('HEADER_TITLE_MY_ACCOUNT', 'Minha Conta');
define('HEADER_TITLE_CART_CONTENTS', 'Ver Cesta');
define('HEADER_TITLE_CHECKOUT', 'Realizar Pedido');
define('HEADER_TITLE_CONTACT_US', 'Contate-nos');
define('HEADER_TITLE_TOP', 'P�gina inicial');
define('HEADER_TITLE_CATALOG', 'Com&eacute;rcio');
define('HEADER_TITLE_LOGOFF', 'Sair');
define('HEADER_TITLE_LOGIN', 'Entrar');

define('TITLE', DW_TITULO);

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Show Room');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');
define('BOX_MANUFACTURERS_SELECT_ONE', 'Selecione um:');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novidades');

// categories box text in includes/boxes/login.php
define('BOX_HEADING_LONGIN1', 'Login');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Busca R�pida');
define('BOX_SEARCH_TEXT', 'Use palavras-chave para encontrar o produto que procura.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Busca Avan�ada');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Ofertas');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Coment�rios');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escreva um coment�rio para este produto');
define('BOX_REVIEWS_NO_REVIEWS', 'At� este momento n�o h� nenhum coment�rio');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrelas!');

// shopping_cart box text in includes/boxes/compre.php
define('BOX_HEADING_COMPRE', 'Compre aqui');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Compras');
define('BOX_SHOPPING_CART_EMPTY', '0 produtos');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Mais Vendidos');
define('BOX_HEADING_BESTSELLERS_IN', 'Os mais vendidos em <br>��');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Outros produtos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');
define('BOX_LANGUAGES_ENGLISH', 'English');
define('BOX_LANGUAGES_PORTUGUES', 'Portugu�s');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Moedas');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informa��es');
define('BOX_INFORMATION_PRIVACY', 'Seguran�a');
define('BOX_INFORMATION_CONDITIONS', 'Condi��es de Uso');
define('BOX_INFORMATION_SHIPPING', 'Como Comprar');
define('BOX_INFORMATION_CONTACT', 'Contate-nos');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Envie a um Amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Envia esta p�gina a um amigo.');

// checkout procedure text
define('CHECKOUT_BAR_CART_CONTENTS', 'cesta');
define('CHECKOUT_BAR_DELIVERY_ADDRESS', 'entrega');
define('CHECKOUT_BAR_PAYMENT_METHOD', 'pagamento');
define('CHECKOUT_BAR_CONFIRMATION', 'confirma��o');
define('CHECKOUT_BAR_FINISHED', 'finalizado!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selecione');
define('PLEASE_SELECT', 'Selecione');
define('TYPE_BELOW', 'Escreva Abaixo');

// javascript messages
define('JS_ERROR', 'H� alguns erros em seu formul�rio!\nPor favor, fa�a as seguintes corre��es:\n\n');

define('JS_REVIEW_TEXT', '* Seu \'Coment�rio\' deve ter no m�nimo ' . REVIEW_TEXT_MIN_LENGTH . ' letras.\n');
define('JS_REVIEW_RATING', '* Precisa avaliar o produto sobre o qual faz um coment�rio.\n');

define('JS_GENDER', '* Deve indicar seu \'Sexo\'.\n');
define('JS_FIRST_NAME', '* Seu \'Nome\' deve ter no m�nimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_LAST_NAME', '* Seu \'Sobrenome\' deve ter no m�nimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_DOB', '* A \'Data de Nascimento\' deve ter este formato: xx/xx/xxxx (dia/m�s/ano).\n');
define('JS_EMAIL_ADDRESS', '* Seu \'E-Mail\' deve ter no m�nimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_ADDRESS', '* Seu \'Endere�o\' deve ter no m�nimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_POST_CODE', '* Seu \'CEP\' deve ter no m�nimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no m�nimo ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n');
define('JS_STATE', '* Deve indicar o \'Pa�s\'.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado da lista para este pa�s.\n');
define('JS_COUNTRY', '* Deve indicar seu \'Pa�s\'.');
define('JS_TELEPHONE', '* O \'Telefone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n');
define('JS_PASSWORD', '* A \'Senha\' e a \'Confirma��o\' devem ser iguais e ter no m�nimo' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor selecione um m�todo de pagamento para seu pedido.');
define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor selecione um m�todo de pagamento para seu pedido.');

define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endere�o');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_OPTIONS', 'Op��es');
define('CATEGORY_PASSWORD', 'Senha');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_ERROR', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_COMPANY_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_GENDER_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_LAST_NAME_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Data de Nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '�<small><font color="#FF0000">(p.ej. 21/05/1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '�<small>(eg. 21/05/1970) <font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '�<small><font color="#FF0000">Seu E-mail n�o parece correto!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '�<small><font color="#FF0000">e-mail j� existe!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_STREET_ADDRESS', 'Endere�o, N�, Apto:');
define('ENTRY_STREET_ADDRESS_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_SUBURB_ERROR', ' <small><font color="#FF0000">min ' . ENTRY_SUBURB_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_SUBURB_TEXT', ' <small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_POST_CODE_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_CITY_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', '');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Pa�s:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Receber ofertas e promo��es?');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'sim');
define('ENTRY_NEWSLETTER_NO', 'n�o');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirme Senha:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_PASSWORD_ERROR', '�<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras</font></small>');
define('ENTRY_PASSWORD_TEXT', '�<small><font color="#AABBDD">obrigat�rio</font></small>');
define('PASSWORD_HIDDEN', '--OCULTA--');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P�ginas de Resultados:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> coment�rios)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> produtos novos)');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', '');
define('FOOTER_TEXT_BODY', DW_FOOTER . '<br>Powered By: <a href="http://www.artsampa.com/"> Artsampa.com</a> &nbsp; &nbsp; Software derivado de osCommerce 2.2');

define('PREVNEXT_TITLE_FIRST_PAGE', 'In�cio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pr�xima');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'P�gina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d Paginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Pr�ximas %d Paginas');
define('PREVNEXT_BUTTON_FIRST', '<<INICIO');
define('PREVNEXT_BUTTON_PREV', '[<<�Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Pr�xima�>>]');
define('PREVNEXT_BUTTON_LAST', 'FINAL>>');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Adicionar Endere�o');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Endere�os');
define('IMAGE_BUTTON_BACK', 'Voltar');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Alterar Endere�o');
define('IMAGE_BUTTON_CHECKOUT', 'Realizar Pedido');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar Pedido');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_DELETE', 'Apagar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Conta');
define('IMAGE_BUTTON_HISTORY', 'Historico dos Pedidos');
define('IMAGE_BUTTON_IN_CART', 'Colocar na Cesta');
define('IMAGE_BUTTON_QUICK_FIND', 'Busca R�pida');
define('IMAGE_BUTTON_REVIEWS', 'Coment�rios');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Op��es de Frete');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Envie a um Amigo');
define('IMAGE_BUTTON_UPDATE_CART', 'Atualizar Cesta');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escrever Coment�rio');

define('ICON_WARNING', 'Warning');

define('TEXT_GREETING_PERSONAL', 'Seja Bem Vindo Novamente <span class="greetUser">%s!</span> Voc� gostaria de ver os <a href="%s"><u>novos produtos</u></a> dispon�veis?' . DW_TEXTO_ADM . $DW_TEXTO_INICIAL);
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Se voc� n�o � %s, por favor <a href="%s"><u>clique aqui</u></a> para abrir gratuitamente sua conta em nossa loja.</small>');
define('TEXT_GREETING_GUEST', 'Bem Vindo <span class="greetUser">Visitante!</span> gostaria de <a href="%s"><u>entrar em sua conta</u></a> ou <a href="%s"><u>criar uma conta nova</u></a>?' . DW_TEXTO_ADM . $DW_TEXTO_INICIAL);

define('TEXT_SORT_PRODUCTS', 'Ordenar Produtos ');
define('TEXT_DESCENDINGLY', 'Descendentemente');
define('TEXT_ASCENDINGLY', 'Ascendentemente');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palavras');
define('TEXT_REVIEW_RATING', 'Avalia��o: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data da Entrada: %s');
define('TEXT_NO_REVIEWS', 'At� este momento n�o h� nenhum coment�rio.');

define('TEXT_NO_NEW_PRODUCTS', 'No momento n�o h� novidades.');

define('TEXT_UNKNOWN_TAX_RATE', 'Imposto desconhecido');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> No he podido enviar el email con el servidor SMTP especificado. Configura tu servidor SMTP en la seccion adecuada del fichero php.ini.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Aten��o: Conecte-se via FTP ou atrav�s do painel de controle e apague o diret�rio de instala��o: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Este diret�rio deve ser removido por quest�es de seguran�a.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Aten��o: Conecte-se via FTP ou atrav�s do painel de controle e altere as permiss�es do arquivo de configura��o para 644: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. A permiss�o atual era necess�ria para instala��o da loja e agora deve ser alterada por raz�es de seguran�a.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warning: The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
?>
