<?php
/*
  $Id: navigation.php,v 1.1 2002/01/02 13:02:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  echo osc_draw_box_heading('Navigation', true);

  $box_contents = array(array('title' => 'Instru��es',
                              'link' => 'index.php'),
                        array('title' => 'Instala��o',
                              'link' => 'install.php')
                        );

  echo osc_draw_box_contents($box_contents);
?>
