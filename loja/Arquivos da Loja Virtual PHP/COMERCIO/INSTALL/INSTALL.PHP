<?php
/*
  $Id: install.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application.php');

  $page_file = 'install.php';
  $page_title = 'Installation';

  switch ($HTTP_GET_VARS['step']) {
    case '2':
      if (osc_in_array(array('database'), $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_2.php';
      } elseif (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '3':
      if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_3.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '4':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '5':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_5.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    default:
      $page_contents = 'install.php';
  }

  require('templates/main_page.php');
?>
