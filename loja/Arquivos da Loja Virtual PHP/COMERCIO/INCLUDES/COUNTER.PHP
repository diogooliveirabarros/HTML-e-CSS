<?php
/*
  $Id: counter.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  $counter = tep_db_query("select startdate, counter from " . TABLE_COUNTER . "");

  if (!@tep_db_num_rows($counter)) {
    $date_now = date('Ymd');
    tep_db_query("insert into " . TABLE_COUNTER . " (startdate, counter) values ('" . $date_now . "', '1')");
    $counter_startdate = $date_now;
    $counter_now = 1;
  } else {
    $counter_values = tep_db_fetch_array($counter);
    $counter_startdate = $counter_values['startdate'];
    $counter_now = ($counter_values['counter'] + 1);
    tep_db_query("update " . TABLE_COUNTER . " set counter = '" . $counter_now . "'");
  }

  $counter_startdate_formatted = strftime(DATE_FORMAT_LONG, mktime(0,0,0,substr($counter_startdate, 4, 2),substr($counter_startdate, -2),substr($counter_startdate, 0, 4)));
?>
