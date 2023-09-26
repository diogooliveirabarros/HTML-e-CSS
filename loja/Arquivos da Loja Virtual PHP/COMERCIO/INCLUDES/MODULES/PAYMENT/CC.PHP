<?php
/*
  $Id: cc.php,v 1.38 2001/12/28 15:17:18 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Tradução, incorporação do módulo de validação dos 
  cartões e opção de cartões aceitos pela loja acrescidos por 
  Rodrigo S. Ferreira <rsferreira@terra.com.br>

  Released under the GNU General Public License
*/

  class cc {
    var $code, $title, $description, $enabled;

// class constructor
    function cc() {
      $this->code = 'cc';
      $this->title = MODULE_PAYMENT_CC_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;
      $this->enabled = MODULE_PAYMENT_CC_STATUS;
    }

// class methods
    function javascript_validation() {
      $validation_string = 'if (payment_value == "' . $this->code . '") {' . "\n" .
                           '  var cc_owner = document.payment.cc_owner.value;' . "\n" .
                           '  var cc_number = document.payment.cc_number.value;' . "\n" .
                           '  if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
                           '    error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .
                           '    error = 1;' . "\n" .
                           '  }' . "\n" .
                           '  if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
                           '    error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .
                           '    error = 1;' . "\n" .
                           '  }' . "\n" .
                           '}' . "\n";
      return $validation_string;
    }

    function selection() {
      for ($i=1; $i < 13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

if (MODULE_PAYMENT_CC_VISA) {
   $CardImagens = tep_image(DIR_WS_IMAGES . "visa.gif");
}	
if (MODULE_PAYMENT_CC_MASTERCARD) {
   $CardImagens .= tep_image(DIR_WS_IMAGES . "mastercard.gif");
}	
if (MODULE_PAYMENT_CC_DINERS) {
   $CardImagens .= tep_image(DIR_WS_IMAGES . "diners.gif");
}	
if (MODULE_PAYMENT_CC_AMEX) {
   $CardImagens .= tep_image(DIR_WS_IMAGES . "amex.gif");
}	

      $selection_string = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n" .
				  '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . "Aceitamos:" . '&nbsp;</td>' . "\n" .
                          '    <td class="main"> ' . $CardImagens .  '  </td>' . "\n" .
                          '  </tr>' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER . '&nbsp;</td>' . "\n" .
                          '    <td class="main">&nbsp;' . tep_draw_input_field('cc_owner') . '&nbsp;</td>' . "\n" .
                          '  </tr>' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER . '&nbsp;</td>' . "\n" .
                          '    <td class="main">&nbsp;' . tep_draw_input_field('cc_number') . '&nbsp;</td>' . "\n" .
                          '  </tr>' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '&nbsp;</td>' . "\n" .
                          '    <td class="main">&nbsp;' . tep_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;/&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year) . '</td>' . "\n" .
                          '  </tr>' . "\n" .
                          '</table>' . "\n";

      return $selection_string;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

//DW --->

/*
  $Id: ccval.php,v 1.3 2001/09/01 15:24:46 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License

  Credit Card Validation Solution version 3.5 PHP Edition
  COPYRIGHT NOTICE:
  a) This code is property of The Analysis and Solutions Company.
  b) It is being distributed free of charge and on an "as is" basis.
  c) Use of this code, or any part thereof, is contingent upon leaving
      this copyright notice, name and address information in tact.
  d) Written permission must be obtained from us before this code, or any
      part thereof, is sold or used in a product which is sold.
  e) By using this code, you accept full responsibility for its use
      and will not hold the Analysis and Solutions Company, its employees
      or officers liable for damages of any sort.
  f) This code is not to be used for illegal purposes.
  g) Please email us any revisions made to this code.

  Copyright 2000                 http://www.AnalysisAndSolutions.com/code/
  The Analysis and Solutions Company         info@AnalysisAndSolutions.com
*/

  function CCValidationSolution($Number) {
    global $CardName, $CardNumber;

// Get rid of spaces and non-numeric characters.
    $Number = OnlyNumericSolution($Number);

// Do the first four digits fit within proper ranges? If so, who's the card issuer and how long should the number be?
    $NumberLeft = substr($Number, 0, 4);
    $NumberLength = strlen($Number);

    if ( ($NumberLeft >= 3000) && ($NumberLeft <= 3059) ) {
      $CardName = 'Diners Club';
      $ShouldLength = 14;
    } elseif ( ($NumberLeft >= 3600) && ($NumberLeft <= 3699) ) {
      $CardName = 'Diners Club';
      $ShouldLength = 14;
    } elseif ( ($NumberLeft >= 3800) && ($NumberLeft <= 3889) ) {
      $CardName = 'Diners Club';
      $ShouldLength = 14;
    } elseif ( ($NumberLeft >= 3400) && ($NumberLeft <= 3499) ) {
      $CardName = 'American Express';
      $ShouldLength = 15;
    } elseif ( ($NumberLeft >= 3700) && ($NumberLeft <= 3799) ) {
      $CardName = 'American Express';
      $ShouldLength = 15;
    } elseif ( ($NumberLeft >= 3528) && ($NumberLeft <= 3589) ) {
      $CardName = 'JCB';
      $ShouldLength = 16;
    } elseif ( ($NumberLeft >= 3890) && ($NumberLeft <= 3899) ) {
      $CardName = 'Carte Blache';
      $ShouldLength = 14;
    } elseif ( ($NumberLeft >= 4000) && ($NumberLeft <= 4999) ) {
      $CardName = 'Visa';
      if ($NumberLength > 14) {
        $ShouldLength = 16;
      } elseif ($NumberLength < 14) {
        $ShouldLength = 13;
      } else {
        $cc_val = 'O número <b>Visa</b> digitado, ' . $Number . ', tem 14 dígitos. Cartões <b>Visa</b> normalmente têm 16 dígitos, apesar de alguns terem 13.<br>Favor verificar o número e tentar novamente.';
        return $cc_val;
      }
    } elseif ( ($NumberLeft >= 5100) && ($NumberLeft <= 5599) ) {
      $CardName = 'MasterCard';
      $ShouldLength = 16;
    } elseif ($NumberLeft == 5610) {
      $CardName = 'Australian BankCard';
      $ShouldLength = 16;
    } elseif ($NumberLeft == 6011) {
      $CardName = 'Discover/Novus';
      $ShouldLength = 16;
    } else {
      $cc_val = 'Os quatro primeiros dígitos do número digitado são ' . $NumberLeft . '.<br>&nbsp;Se o número informado está correto, nós não aceitamos este tipo de cartão de crédito.<br>&nbsp;Se está errado, por favor tente novamente.';
      return $cc_val;
    }

// Is the number the right length?
    if ($NumberLength <> $ShouldLength) {
      $Missing = $NumberLength - $ShouldLength;
      if ($Missing < 0) {
        $cc_val = 'No número <b>' . $CardName . '</b> digitado, ' . $Number . ', estão <font color="#FF0000"><b>faltando</b></font> ' . abs($Missing) . ' dígitos.<br>&nbsp;Por favor verifique o número e tente novamente.';
      } else {
        $cc_val = 'No número <b>' . $CardName . '</b> digitado, ' . $Number . ', existem ' . $Missing . ' dígitos em excesso.<br>&nbsp;Por favor verifique o número e tente novamente.';
      }

      return $cc_val;
    }

//DW---> 
// Verificar se o tipo de cartão é aceito
    if (!(($CardName == 'Visa' && MODULE_PAYMENT_CC_VISA) || ($CardName == 'MasterCard' && MODULE_PAYMENT_CC_MASTERCARD) || ($CardName == 'Diners Club' && MODULE_PAYMENT_CC_DINERS) || ($CardName == 'American Express' && MODULE_PAYMENT_CC_AMEX))) {
	  $cc_val = "Não aceitamos cartões " . $CardName . "."; 
 	  return $cc_val;
    }
//<---DW

// Does the number pass the Mod 10 Algorithm Checksum?
    if (Mod10Solution($Number)) {
     $CardNumber = $Number;
     return true;
    } else {
      $cc_val = 'O número <b>' . $CardName . '</b> digitado, ' . $Number . ', é <font color="#FF0000"><b>inválido</b></font>. Por favor verifique o número e tente novamente.';
      return $cc_val;
    }
  
 }

  function OnlyNumericSolution($Number) {
// Remove any non numeric characters.
// Ensure number is no more than 19 characters long.
    return substr(ereg_replace('[^0-9]', '', $Number) , 0, 19);
  }

  function Mod10Solution($Number) {
    $NumberLength = strlen($Number);
    $Checksum = 0;

// Add even digits in even length strings or odd digits in odd length strings.
    for ($Location = 1-($NumberLength%2); $Location<$NumberLength; $Location+=2) {
      $Checksum += substr($Number, $Location, 1);
    }

// Analyze odd digits in even length strings or even digits in odd length strings.
    for ($Location = ($NumberLength%2); $Location<$NumberLength; $Location+=2) {
      $Digit = substr($Number, $Location, 1) * 2;
      if ($Digit < 10) {
        $Checksum += $Digit;
      } else {
        $Checksum += $Digit - 9;
      }
    }

// Is the checksum divisible by ten?
    return ($Checksum % 10 == 0);
  }

  function ValidateExpiry ($month, $year) {
    $cc_val = '';
    $year = '20' . $year;

    if (date('Y') == $year) {
      if (date('m') <= $month) {
        $cc_val = '1';
      } else {
        $cc_val = 'A data de validade informada, ' . $month . '/' . $year . ', é <font color="#FF0000"><b>inválida</b></font>. Por favor verifique a data e tente novamente.';
      }
    } elseif (date('Y') > $year) {
        $cc_val = 'A data de validade informada, ' . $month . '/' . $year . ', é <font color="#FF0000"><b>inválida</b></font>. Por favor verifique a data e tente novamente.';
    } else {
      $cc_val = '1';
    }

    return $cc_val;
}

//<--- DW

      $cc_val = OnlyNumericSolution($HTTP_POST_VARS['cc_number']);
      $cc_val = CCValidationSolution($cc_val);
      if ($cc_val == '1') $cc_val = ValidateExpiry($HTTP_POST_VARS['cc_expires_month'], $HTTP_POST_VARS['cc_expires_year']);

      if ($cc_val != '1') {
        $payment_error_return = 'payment_error=' . $HTTP_POST_VARS['payment'] . '&payment=' . $HTTP_POST_VARS['payment'] . '&cc_owner=' . urlencode($HTTP_POST_VARS['cc_owner']) . '&cc_expires_month=' . $HTTP_POST_VARS['cc_expires_month'] . '&cc_expires_year=' . $HTTP_POST_VARS['cc_expires_year'] . '&shipping_selected=' . $HTTP_POST_VARS['shipping_selected'] . '&cc_val=' . urlencode($cc_val);
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }
    }

    function confirmation() {
      global $HTTP_POST_VARS, $CardName, $CardNumber;

      $confirmation_string = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n" .
                             '  <tr>' . "\n" .
                             '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER . '&nbsp;' . $HTTP_POST_VARS['cc_owner'] . '&nbsp;</td>' . "\n" .
                             '  </tr>' . "\n" .
                             '  <tr>' . "\n" .
                             '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE . '&nbsp;' . $CardName . '&nbsp;</td>' . "\n" .
                             '  </tr>' . "\n" .
                             '  <tr>' . "\n" .
                             '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER . '&nbsp;' . $CardNumber . '&nbsp;</td>' . "\n" .
                             '  </tr>' . "\n" .
                             '  <tr>' . "\n" .
                             '    <td class="main">&nbsp;' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '&nbsp;' . strftime('%B/%Y', mktime(0,0,0,$HTTP_POST_VARS['cc_expires_month'], 1, '20' . $HTTP_POST_VARS['cc_expires_year'])) . '&nbsp;</td>' . "\n" .
                             '  </tr>' . "\n" .
                             '</table>' . "\n";

      return $confirmation_string;
    }

    function process_button() {
      global $HTTP_POST_VARS, $CardName, $CardNumber;

      $process_button_string = tep_draw_hidden_field('cc_owner', $HTTP_POST_VARS['cc_owner']) .
                               tep_draw_hidden_field('cc_expires', $HTTP_POST_VARS['cc_expires_month'] . $HTTP_POST_VARS['cc_expires_year']) .
                               tep_draw_hidden_field('cc_type', $CardName) .
                               tep_draw_hidden_field('cc_number', $CardNumber);

      return $process_button_string;
    }

    function before_process() {
      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (MODULE_PAYMENT_CC_EMAIL != '0') ) {
        $len = strlen($GLOBALS['cc_number']);
        $new_cc = substr($GLOBALS['cc_number'], 0, 4) . substr('XXXXXXXXXXXXXXXX', 0, $len-8) . substr($GLOBALS['cc_number'], -4);
        $GLOBALS['cc_middle'] = substr($GLOBALS['cc_number'], 4, $len-8);
        $GLOBALS['cc_number'] = $new_cc;
      }
    }

    function after_process() {
      global $insert_id;

      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (MODULE_PAYMENT_CC_EMAIL != '0') ) { 
        $message = 'Pedido #' . $insert_id . "\n\n" . 'Números do meio do Cartão de Crédito: ' . $GLOBALS['cc_middle'] . "\n\n";
        tep_mail('', STORE_OWNER_EMAIL_ADDRESS, 'Informação Adicional de Pedido', $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
      }
    }

    function output_error() {
      global $HTTP_GET_VARS;

      $output_error_string = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n" .
                             '  <tr>' . "\n" .
                             '    <td class="main">&nbsp;<font color="#FF0000"><b>' . MODULE_PAYMENT_CC_TEXT_ERROR . '</b></font><br>&nbsp;' . stripslashes(urldecode($HTTP_GET_VARS['cc_val'])) . '&nbsp;</td>' . "\n" .
                             '  </tr>' . "\n" .
                             '</table>' . "\n";

      return $output_error_string;
    }

    function check() {
      $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
      $check = tep_db_num_rows($check_query);

      return $check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar Cartões de Crédito (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_STATUS', '0', '', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aplicar máscara nos números de Cartões de Crédito (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_EMAIL', '0', 'Se este campo for diferente de 0, os dígitos do meio de qualquer cartão de crédito armazenado serão mascarados (XXXXX) no banco de dados, e enviados por e-mail com o número do pedido ao proprietário da loja.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar VISA (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_VISA', '1', '', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar Mastercard (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_MASTERCARD', '1', '', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar Diners (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_DINERS', '1', '', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar Amex (0=NÃO 1=SIM)?', 'MODULE_PAYMENT_CC_AMEX', '1', '', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_EMAIL'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_VISA'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_MASTERCARD'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_DINERS'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_AMEX'");
    }

    function keys() {
      $keys = array('MODULE_PAYMENT_CC_STATUS', 'MODULE_PAYMENT_CC_EMAIL', 'MODULE_PAYMENT_CC_VISA', 'MODULE_PAYMENT_CC_MASTERCARD', 'MODULE_PAYMENT_CC_DINERS', 'MODULE_PAYMENT_CC_AMEX');

      return $keys;
    }
  }
?>
