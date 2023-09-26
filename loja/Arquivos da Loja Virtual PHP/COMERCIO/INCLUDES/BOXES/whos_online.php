<?php
/*
  $Id: whos_online.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- whos_online //-->
          <tr>
            <td>
<?php

// Set expiration time, default is 900 secs (15 mins)
  $xx_mins_ago = (time() - 900);

  tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

  $whos_online_query = tep_db_query("select customer_id from " . TABLE_WHOS_ONLINE);
  while ($whos_online = tep_db_fetch_array($whos_online_query)) {
                        if (!$whos_online['customer_id'] == 0) $n_members++;
                        if ($whos_online['customer_id'] == 0) $n_guests++;

  $user_total = sprintf(tep_db_num_rows($whos_online_query));                                                                }

  if ($user_total == 1) {
    $there_is_are = BOX_WHOS_ONLINE_THEREIS . '&nbsp;';
  } else {
    $there_is_are = BOX_WHOS_ONLINE_THEREARE . '&nbsp;';
  }

  if ($n_guests == 1) {
    $word_guest = '&nbsp;' . BOX_WHOS_ONLINE_GUEST;
  }else{
    $word_guest = '&nbsp;' . BOX_WHOS_ONLINE_GUESTS;
  }	

  if ($n_members == 1) {
    $word_member = '&nbsp;' . BOX_WHOS_ONLINE_MEMBER;
  }else{  
    $word_member = '&nbsp;' . BOX_WHOS_ONLINE_MEMBERS;
  }


  if (($n_guests >= 1) && ($n_members >= 1)) $word_and = '&nbsp;' . BOX_WHOS_ONLINE_AND . '&nbsp;<br>';

      $textstring = $there_is_are;
        if ($n_guests >= 1) $textstring .= $n_guests . $word_guest; 

      $textstring .= $word_and; 
        if ($n_members >= 1) $textstring .= $n_members . $word_member;

      $textstring .= '&nbsp;online.'; 

 
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_WHOS_ONLINE 
                              );
  new infoBoxHeading($info_box_contents);

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  =>  $textstring
                              );
  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- whos_online_eof //-->
