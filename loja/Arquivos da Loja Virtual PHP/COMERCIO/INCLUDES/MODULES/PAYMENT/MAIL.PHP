<?php

/*
  $Id: mail.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

class mail {
    var $code, $title, $description, $enabled;

// !Class constructor -> initialize class variables.
// Sets the class code, description, and status.
    function mail () {
      $this->code = 'mail';
      $this->title = MODULE_PAYMENT_MAIL_TEXT_TITLE;
      $this->email_footer = MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION . 
							"\n\nMail Order:\n" . 	
							MODULE_PAYMENT_MAIL_TITULAR . "\n" .
							"C Postal: " . MODULE_PAYMENT_MAIL_CPOSTAL . "\n" .
							"CEP: " . MODULE_PAYMENT_MAIL_CEP . "\n" .	
							"" . MODULE_PAYMENT_MAIL_ESTADO . "\n\n";
							
      $this->description = MODULE_PAYMENT_MAIL_TEXT_DESCRIPTION;
      $this->enabled = MODULE_PAYMENT_MAIL_STATUS;
  }

function javascript_validation() {
	return false;
}

function selection() {
	$selection_string = MODULE_PAYMENT_MAIL_TEXT_SELECTION;
	return $selection_string;
}

function pre_confirmation_check() {
	return false;    
}

function confirmation() { 
	$confirmation_string = MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION . "\n<pre>\nMail Order:\n" . MODULE_PAYMENT_MAIL_TITULAR . "\n" . "C. Postal: " . MODULE_PAYMENT_MAIL_CPOSTAL . "\n" . "CEP: " . MODULE_PAYMENT_MAIL_CEP . "\n" . MODULE_PAYMENT_MAIL_ESTADO . "\n</PRE>";
							
	return $confirmation_string;
}

function process_button() {
  	return false;
}  

function before_process() { 
	return false;
}

function after_process() {
	return false;
}

function output_error() {
    return false;  
}

function check() {
    $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_STATUS'");
    $check = tep_db_num_rows($check);

    return $check;
}

function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mail Order/Pagamento Pelo Correio? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_MAIL_STATUS', '0', '', '6', '3', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem Opções de Pagamento', 'MODULE_PAYMENT_MAIL_TEXT_SELECTION', '',  'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem para o Cliente', 'MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION', 'Pagamento via correio. email to: mail@mail.com.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '5', now())");	  
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Titular da Conta', 'MODULE_PAYMENT_MAIL_TITULAR', 'Send To: Loja Virtual.', 'Titular da Conta', '6', '3', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Caixa Postal', 'MODULE_PAYMENT_MAIL_CPOSTAL', '111000', 'C. Postal', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CEP', 'MODULE_PAYMENT_MAIL_CEP', '01009-000', 'CEP', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Estado', 'MODULE_PAYMENT_MAIL_ESTADO', 'São Paulo SP - Brazil', 'Estado', '6', '2', now())");

}

function remove() {
    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_STATUS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_TEXT_SELECTION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_TITULAR'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_CPOSTAL'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_CEP'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MAIL_ESTADO'");
		
}

function keys() {
    $keys = array('MODULE_PAYMENT_MAIL_STATUS', 'MODULE_PAYMENT_MAIL_TEXT_SELECTION', 'MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION', 'MODULE_PAYMENT_MAIL_TITULAR','MODULE_PAYMENT_MAIL_CPOSTAL','MODULE_PAYMENT_MAIL_CEP','MODULE_PAYMENT_MAIL_ESTADO');
    return $keys;
    }
  }
?>
