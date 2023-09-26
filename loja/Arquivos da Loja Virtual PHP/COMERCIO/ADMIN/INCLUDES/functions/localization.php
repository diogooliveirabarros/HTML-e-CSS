<?php
/*
  $Id: localization.php,v 1.10 2001/12/31 14:17:31 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  function quote_oanda_currency($code, $base = DEFAULT_CURRENCY) {
    $err_num = '';
    $err_msg = '';
    $s = fsockopen('www.oanda.com', 5011, $err_num, $err_msg, 5);
    if (!$s) {
      $resp = 'na';  // prevent breaking script
    } else {
      fputs($s, "fxp/1.1\r\nbasecurrency: $code\r\nquotecurrency: $base\r\n\r\n");
      $resp = fgets($s, 128);
      if (trim($resp) == "fxp/1.1 200 ok") {
        while ($resp != "\r\n") {
          $resp = fgets($s, 128);
        }
        if (!$resp = fgets($s, 128)) { // timeout? then skip
          $resp = 'na';
        }
      } else {
        $resp = 'na';
      }
      fclose($s);
    }
    if ($resp == 'na') {
      return false;
    }
    return trim($resp);
  }
  
  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
    $regex = "/[0-9.]+\s*$from\s*=\s*([0-9.]+)\s*$to/";
    $return = file('http://www.xe.net/ucc/convert.cgi?Amount=1&From=' . $from . '&To=' . $to);
    while (list(, $line) = each($return)) {
      if (preg_match($regex, $line, $match)) {
        break;
      }
    }
    if (!isset($match)) {
      return false;
    }
    return $match[1];
  }
?>