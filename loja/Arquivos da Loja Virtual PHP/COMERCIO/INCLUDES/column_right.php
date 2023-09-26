<?php
/*
  $Id: column_right.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

 /* if (DW_PERMITIR_IDIOMAS != 'false') require(DIR_WS_BOXES . 'shopping_cart.php'); */

  if ($HTTP_GET_VARS['products_id']) {
    include(DIR_WS_BOXES . 'manufacturer_info.php');
  } 

  if ($HTTP_GET_VARS['products_id']) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) {
     include(DIR_WS_BOXES . 'tell_a_friend.php');
    }
  } else {
    include(DIR_WS_BOXES . 'specials.php');
  }
   include(DIR_WS_BOXES . 'languages.php');
   include(DIR_WS_BOXES . 'currencies.php');
   require(DIR_WS_BOXES . 'best_sellers.php');
  require(DIR_WS_BOXES . 'whats_new.php');
require(DIR_WS_BOXES . 'search.php');
require(DIR_WS_BOXES . 'information.php');
  

?>
