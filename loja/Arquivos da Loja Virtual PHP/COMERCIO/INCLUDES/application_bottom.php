<?php
/*
  $Id: application_botton.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

// close session (store variables)
  tep_session_close();

  if (STORE_PAGE_PARSE_TIME == 'true') {
    $parse_end_time = microtime();
    $time_start = explode(' ', PAGE_PARSE_START_TIME);
    $time_end = explode(' ', $parse_end_time);
    $parse_time = number_format(($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0])), 3);
    error_log(strftime(STORE_PARSE_DATE_TIME_FORMAT) . ' - ' . getenv('REQUEST_URI') . ' (' . $parse_time . 'ms)' . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);

    if (DISPLAY_PAGE_PARSE_TIME == 'true') {
      echo '<span class="smallText">Parse Time: ' . $parse_time . 'ms</span>';
    }
  }
?>