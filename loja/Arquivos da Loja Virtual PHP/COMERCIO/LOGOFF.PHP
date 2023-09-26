<?php
/*
  $Id: logoff.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  tep_session_unregister('customer_id');
  $cart->reset(FALSE);
  require('includes/counter.php');
  tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>