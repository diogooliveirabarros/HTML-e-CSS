<?php

/*
  transferencia.php 14/05/2002

  M�dulo de Pagamento para osCommerce

  Copyright (c) 2002 Rodrigo S. Ferreira <rsferreira@terra.com.br>
  Released under the GNU General Public License
*/

class transferencia {
    var $code, $title, $description, $enabled;

// !Class constructor -> initialize class variables.
// Sets the class code, description, and status.
    function transferencia () {
      $this->code = 'transferencia';
      $this->title = MODULE_PAYMENT_TRANSFERENCIA_TEXT_TITLE;
      $this->email_footer = MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION . 
							"\n\nDados para dep�sito\\transfer�ncia:\n" . 	
							MODULE_PAYMENT_TRANSFERENCIA_TITULAR . "\n" .
							"Banco: " . MODULE_PAYMENT_TRANSFERENCIA_BANCO . "\n" .
							"Ag�ncia: " . MODULE_PAYMENT_TRANSFERENCIA_AGENCIA . "\n" .	
							"Conta Corrente: " . MODULE_PAYMENT_TRANSFERENCIA_CC . "\n\n";
							
      $this->description = MODULE_PAYMENT_TRANSFERENCIA_TEXT_DESCRIPTION;
      $this->enabled = MODULE_PAYMENT_TRANSFERENCIA_STATUS;
  }

function javascript_validation() {
	return false;
}

function selection() {
	$selection_string = MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION;
	return $selection_string;
}

function pre_confirmation_check() {
	return false;    
}

function confirmation() { 
	$confirmation_string = MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION . "\n<pre>\nDados para dep�sito\\transfer�ncia:\n" . MODULE_PAYMENT_TRANSFERENCIA_TITULAR . "\n" . "Banco: " . MODULE_PAYMENT_TRANSFERENCIA_BANCO . "\n" . "Ag�ncia: " . MODULE_PAYMENT_TRANSFERENCIA_AGENCIA . "\n" . "Conta Corrente: " . MODULE_PAYMENT_TRANSFERENCIA_CC . "\n</PRE>";
							
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
    $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_STATUS'");
    $check = tep_db_num_rows($check);

    return $check;
}

function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Aceitar Dep�sito/Transfer�ncia Banc�ria? (0=N�O 1=SIM)', 'MODULE_PAYMENT_TRANSFERENCIA_STATUS', '0', '', '6', '3', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Op��es de Pagamento)', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION', 'Dep�sito/Transfer�ncia Banc�ria (nome do banco aqui)', 'Texto a ser exibido para o cliente na tela do op��es de pagamento:', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instru��es para o Cliente)', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION', 'Seu pedido ser� enviado quando confirmado o pagamento. Para agilizar o processo, envie o comprovante por fax: (xx)xxxx-xxxx ou email: cobranca@seusite.com.br.', 'Texto a ser exibido para o cliente na confirma��o da compra', '6', '5', now())");	  
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Titular da Conta Banc�ria', 'MODULE_PAYMENT_TRANSFERENCIA_TITULAR', 'Sua Empresa Ltda.', 'Titular da Conta Banc�ria', '6', '3', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Nome do Banco', 'MODULE_PAYMENT_TRANSFERENCIA_BANCO', 'Seu Banco', 'Nome do Banco', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ag�ncia', 'MODULE_PAYMENT_TRANSFERENCIA_AGENCIA', 'xxxx-x', 'Ag�ncia', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Conta Corrente', 'MODULE_PAYMENT_TRANSFERENCIA_CC', 'xxxxx-x', 'Conta Corrente', '6', '2', now())");

}

function remove() {
    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_STATUS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_TITULAR'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_BANCO'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_AGENCIA'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_CC'");
		
}

function keys() {
    $keys = array('MODULE_PAYMENT_TRANSFERENCIA_STATUS', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION', 'MODULE_PAYMENT_TRANSFERENCIA_TITULAR','MODULE_PAYMENT_TRANSFERENCIA_BANCO','MODULE_PAYMENT_TRANSFERENCIA_AGENCIA','MODULE_PAYMENT_TRANSFERENCIA_CC');
    return $keys;
    }
  }
?>
