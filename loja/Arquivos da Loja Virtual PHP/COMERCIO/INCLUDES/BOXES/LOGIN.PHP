<?php
/*
  $Id: login.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- login //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => Login
                              );
  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $filename = "./includes/languages/portugues/login1.php";
  $fd = fopen ($filename, "r");
  $contents = fread ($fd, filesize ($filename));
  fclose ($fd);
  $info_box_contents[] = array('align' => 'left',
                               'text'  => '<center>'.$contents.'</center>'

					);
  new infoBox($info_box_contents);
?>
  	     </td>
          </tr>
<!-- links_eof //-->
