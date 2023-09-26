<?php
/*
  $Id: infrmation.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- information //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_INFORMATION
                              );
  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => '<a href="' . tep_href_link(FILENAME_SHIPPING, '', 'NONSSL') . '">' . BOX_INFORMATION_SHIPPING . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_PRIVACY, '', 'NONSSL') . '">' . BOX_INFORMATION_PRIVACY . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_CONDITIONS, '', 'NONSSL') . '">' . BOX_INFORMATION_CONDITIONS . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_CONTACT_US, '', 'NONSSL') . '">' . BOX_INFORMATION_CONTACT . '</a>'                    
                              );
  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- information_eof //-->