<?php
/*
  $Id: default.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nossas Novas Novidades');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Novidades');
define('TABLE_HEADING_DATE_EXPECTED', 'Lançamentos');

if ($category_depth == 'products' || $HTTP_GET_VARS['manufacturers_id']) {
  define('HEADING_TITLE', '');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Produtos');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
  define('TABLE_HEADING_QUANTITY', 'Quantidade');
  define('TABLE_HEADING_PRICE', 'Preço');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compre Agora');
  define('TEXT_NO_PRODUCTS', 'Não há produtos nesta categoria.');
  define('TEXT_NO_PRODUCTS2', 'Não há produtos deste fabricante.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Número de Produtos: ');
  define('TEXT_SHOW', '<b>Exibir:</b>');
  define('TEXT_BUY', 'Compre 1 \'');
  define('TEXT_NOW', '\' agora');
  define('TEXT_ALL', 'All');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', '');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorias');
}
?>