<?php
/*
  $Id: tell_a_friend.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- tell_a_friend //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_TELL_A_FRIEND
                              );
  new infoBoxHeading($info_box_contents, false, false);

  $hide = tep_draw_hidden_field('products_id', $HTTP_GET_VARS['products_id']);
  $hide .= tep_hide_session_id();

  $info_box_contents = array();
  $info_box_contents[] = array('form'  => '<form name="tell_a_friend" method="get" action="' . tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false) . '">',
                               'align' => 'left',
                               'text'  => '<div align="center">' . tep_draw_input_field('send_to', '', 'size="10"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . $hide . '</div>' . BOX_TELL_A_FRIEND_TEXT
                              );
  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- tell_a_friend_eof //-->