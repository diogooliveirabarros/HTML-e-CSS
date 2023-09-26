<?php
/*
  $Id: espanol.php,v 1.67 2002/01/11 05:03:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'pt_BR'
// on FreeBSD 4.0 I use 'pt_BR.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'pt_BR');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
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

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="pt"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'Pain&eacute;l de Administra&ccedil;&atilde;o');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administra&ccedil;&atilde;o');
define('HEADER_TITLE_NUKE_ADMIN', 'PHPNuke Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'Atualiza&ccedil;&otilde;es');
define('HEADER_TITLE_ONLINE_CATALOG', 'Loja Virtual');
define('HEADER_TITLE_FAQ', 'Suporte');
define('HEADER_TITLE_ADMINISTRATION', 'Estat&iacute;sticas');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configura��es');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M�dulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Frete');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Coment�rios');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Lan�amentos');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Localiza��o/Impostos');
define('BOX_TAXES_COUNTRIES', 'Pa�ses');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Zonas de Impostos');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Imposto');
define('BOX_TAXES_TAX_RATES', 'Porcentagens');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Estat�sticas');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Mais Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Mais Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de Pedidos por Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'Copia de Seguran�a');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Editar Textos');
define('BOX_TOOLS_MAIL', 'Enviar informativos');
define('BOX_TOOS', 'Indexar a database');
define('BOX_TOOS', 'Status da Database');
define('BOX_TOOLS_WHOS_ONLINE', 'Usu�rios conectados');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localiza��o');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status dos Pedidos');

// javascript messages
define('JS_ERROR', 'Houve alguns erros no processamento do formul�rio!\nPor favor, fa�a as seguintes modifica��es:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O atributo precisa de um pre�o\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O atributo precisa de um prefixo para o pre�o\n');

define('JS_PRODUCTS_NAME', '* O produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* Voc� deve inserir a descri��o do produto\n');
define('JS_PRODUCTS_PRICE', '* O produto precisa de um pre�o\n');
define('JS_PRODUCTS_WEIGHT', '* Voc� deve especificar o peso do produto\n');
define('JS_PRODUCTS_QUANTITY', '* Deve especificar a quantidade\n');
define('JS_PRODUCTS_MODEL', '* Deve especificar o modelo\n');
define('JS_PRODUCTS_IMAGE', '* Deve inserir uma imagem\n');

define('JS_PRODUCTS_EXPECTED_NAME', '* O campo \'Produto\' deve ter um valor\n');
define('JS_PRODUCTS_EXPECTED_DATE', '* A data deve estar em formato: xx/xx/xxxx (dia/mes/a�o).\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Voc� deve alterar o pre�o\n');

define('JS_GENDER', '* Deve escolher \'Sexo\'.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter no m�nimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter no m�nimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_DOB', '* A \'Data de Nascimento\' deve ter este formato: xx/xx/xxxx (dia/m�s/amo).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter no m�nimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_ADDRESS', '* O \'Endere�o\' deve ter no m�nimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_POST_CODE', '* O \'CEP\' deve ter no m�nimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no m�nimo ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n');
define('JS_STATE', '* Deve indicar o  \'Pa�s\'.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado da lista para este Pa�s.');
define('JS_COUNTRY', '* Deve selecionar um \'Pa�s\'.\n');
define('JS_TELEPHONE', '* O \'Telefone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n');
define('JS_PASSWORD', '* A \'Senha\' e a \'Confirma��o\' devem ser iguais e ter no m�nimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O pedido n�mero %s n�o existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endere�o');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_PASSWORD', 'Senha');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Op��es');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Data de nascimento:');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(ej. 21/05/1970) <font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_STREET_ADDRESS', 'Endere�o:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Pa�s:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FAX_NUMBER', 'FAX:');
define('ENTRY_FAX_NUMBER_TEXT', 'necess�rio para emiss�o de Nota Fiscal');
define('ENTRY_NEWSLETTER', 'Receber ofertas e promo��es:');
define('ENTRY_NEWSLETTER_YES', 'sim');
define('ENTRY_NEWSLETTER_NO', 'n�o');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirma��o:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('PASSWORD_HIDDEN', '--OCULTA--');

// images
define('IMAGE_BACK', 'Voltar');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar para');
define('IMAGE_DEFINE', 'Definir');
define('IMAGE_DELETE', 'Apagar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'E-mail');
define('IMAGE_ICON_STATUS_GREEN', 'Ativo');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Ativar');
define('IMAGE_ICON_STATUS_RED', 'Desligado');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Ativar');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Inserir');
define('IMAGE_MODIFY', 'Modificar');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo Pa�s');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Arquivo');
define('IMAGE_NEW_FOLDER', 'Novo Diret�rio');
define('IMAGE_NEW_LANGUAGE', 'Novo Idioma');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Novo Tipo de Imposto');
define('IMAGE_NEW_TAX_RATE', 'Nova Taxa');
define('IMAGE_NEW_ZONE', 'Novo Estado');
define('IMAGE_NEW_GEO_ZONE', 'Nova Zona Geogr�fica');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_SAVE', 'Gravar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar Cambio da Moeda');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CURRENT_FOLDER', 'Diret�rio Corrente');
define('ICON_DELETE', 'Apagar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Diret�rio');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_WARNING', 'Warning');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P�ginas:');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pa�ses)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> moedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Exibindo de <b>%d</b> a<b>%d</b> (de <b>%d</b> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> status do pedido)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> coment�rios)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> zonas de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> porcentagens de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> tipos de imposto)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> estados)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Inicio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pr�xima');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'P�gina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d P�ginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Pr�ximas %d P�ginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;IN�CIO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Pr�xima&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;');

define('TEXT_DEFAULT', 'padr�o');
define('TEXT_SET_DEFAULT', 'Estabelecer como padr�o');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requerido</span>');

define('ERROR_BANNER_TITLE', 'Error: Banner title required');
define('ERROR_BANNER_GROUP', 'Error: Banner group required');
define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Tamb�m Compraram');

?>
