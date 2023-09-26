<?php

/*
  boleto.php 10/06/2002

  Módulo de Pagamento para osCommerce

  Copyright (c) 2002 Rodrigo S. Ferreira <rsferreira@terra.com.br>
  Released under the GNU General Public License
*/

class boleto {
    var $code, $title, $description, $enabled;

// !Class constructor -> initialize class variables.
// Sets the class code, description, and status.
    function boleto() {
      $this->code = 'boleto';
      $this->title = MODULE_PAYMENT_BOLETO_TEXT_TITLE;
      $this->email_footer = MODULE_PAYMENT_BOLETO_TEXT_CONFIRMATION;							
      $this->description = MODULE_PAYMENT_BOLETO_TEXT_DESCRIPTION;
      $this->enabled = MODULE_PAYMENT_BOLETO_STATUS;
  }

function javascript_validation() {
	return false;
}

function selection() {
	global $customer_id;
	$selection_string = MODULE_PAYMENT_BOLETO_TEXT_SELECTION . tep_draw_hidden_field('numero_boleto', $customer_id . rand(100,999)) ;
	return $selection_string;
}

function pre_confirmation_check() {
	return false;    
}

function confirmation() { 

$confirmation_string = MODULE_PAYMENT_BOLETO_TEXT_CONFIRMATION;

global $HTTP_POST_VARS, $total_cost, $total_tax, $shipping_cost, $customer_id, $customer_default_address_id;

$cliente_query = tep_db_query("select c.customers_firstname, c.customers_lastname, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, entry_country_id, c.documento_cliente from " . TABLE_CUSTOMERS . " c, " . TABLE_ADDRESS_BOOK . " a where c.customers_id = '" .  $customer_id . "' and a.customers_id = c.customers_id and a.address_book_id = '" . $customer_default_address_id . "'");
$cliente = tep_db_fetch_array($cliente_query);

$confirmation_string .= "<p align=\"justify\"><font face=\"arial\" color=\"#000000\">ATENÇÃO: Clique em \"Gerar Boleto\" para abrir o boleto bancário em uma nova janela. ";
$confirmation_string .= "Imprima o boleto seguindo as instruções. Após imprimir o boleto volte a esta página e clique em \"Confirmar\" para que seu pedido seja processado. ";
$confirmation_string .= "Este boleto poderá ser pago em qualquer banco ou através do <u>homebanking</u>. Caso não tenha como imprimir, utilize os dados do boleto para efetuar o depósito em nossa conta bancária.</font></p> ";

$confirmation_string .= "\n<form method=\"get\" action=\"" . MODULE_PAYMENT_BOLETO_CGIPATH . "\" target=\"_blank\">";

$confirmation_string .= "\n<input type=hidden name=\"CSID\" value=\"" . MODULE_PAYMENT_BOLETO_CSID . "\">";
if (MODULE_PAYMENT_BOLETO_IMAGEMLOGOTIPO) {
	 $confirmation_string .=	"\n<input type=hidden name=\"ImagemLogotipo\" value=\"" . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . MODULE_PAYMENT_BOLETO_IMAGEMLOGOTIPO ."\">";
}
$confirmation_string .=	"\n<input type=hidden name=\"PathImagens\" value=\"" . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"DataVencimento\" value=\"À Vista\">";
$confirmation_string .=	"\n<input type=hidden name=\"NumeroDocumento\" value=\"" . $HTTP_POST_VARS['numero_boleto'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"ValorDocumento\" value=\"" . ($total_cost + $total_tax + $shipping_cost) . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"NossoNumero\" value=\"" .  $HTTP_POST_VARS['numero_boleto'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CalculaDac\" value=\"S\">";
$confirmation_string .=	"\n<input type=hidden name=\"NomeSacado\" value=\"" . $cliente['customers_firstname'] . ' ' . $cliente['customers_lastname'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"EnderecoSacado\" value=\"" . $cliente['entry_street_address'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CepSacado\" value=\"" . $cliente['entry_postcode'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"BairroSacado\" value=\"" . $cliente['entry_suburb'] . ' - ' . $cliente['entry_city'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"EstadoSacado\" value=\"" . tep_get_zone_code($cliente['entry_country_id'], $cliente['entry_zone_id'], $cliente['entry_state']) . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CgcCpfSacado\" value=\"" . $cliente['documento_cliente'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Demonstrativo1\" value=\"" . MODULE_PAYMENT_BOLETO_DEMONSTRATIVO1 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Demonstrativo2\" value=\"" . MODULE_PAYMENT_BOLETO_DEMONSTRATIVO2 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Demonstrativo3\" value=\"" . MODULE_PAYMENT_BOLETO_DEMONSTRATIVO3 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Demonstrativo4\" value=\"" . MODULE_PAYMENT_BOLETO_DEMONSTRATIVO4 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Instrucao1\" value=\"" . MODULE_PAYMENT_BOLETO_INSTRUCAO1 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Instrucao2\" value=\"" . MODULE_PAYMENT_BOLETO_INSTRUCAO2 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Instrucao3\" value=\"" . MODULE_PAYMENT_BOLETO_INSTRUCAO3 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Instrucao4\" value=\"" . MODULE_PAYMENT_BOLETO_INSTRUCAO4 . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Instrucao5\" value=\"" . MODULE_PAYMENT_BOLETO_INSTRUCAO5 . "\">";

$confirmation_string .= "\n<center><input type=\"submit\" value=\"Gerar Boleto\" name=\"B1\"></center></form>";
      
return $confirmation_string;
}

function process_button() {
	 global $HTTP_POST_VARS;  	
	 $process_button_string = tep_draw_hidden_field('numero_boleto', $HTTP_POST_VARS['numero_boleto']);

return $process_button_string;
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
    $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_STATUS'");
    $check = tep_db_num_rows($check);

    return $check;
}

function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Emitir Boleto Bancário? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_BOLETO_STATUS', '0', '', '6', '1', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Opções de Pagamento)', 'MODULE_PAYMENT_BOLETO_TEXT_SELECTION', 'Boleto Bancário', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instruções para o Cliente)', 'MODULE_PAYMENT_BOLETO_TEXT_CONFIRMATION', 'Seu pedido será enviado após o processamento do boleto no sistema bancário.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '3', now())");	  
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CGI Path', 'MODULE_PAYMENT_BOLETO_CGIPATH' , 'http://www.seudominio.com.br/cgi-bin/cobrebeminternet', 'Caminho completo para o CGI do Cobre Bem Internet', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CSID', 'MODULE_PAYMENT_BOLETO_CSID', '73101560440390', 'Arquivo de configuração de sua conta corrente (gerado pelo cobre bem). Certifique-se de já ter colocado este arquivo no diretório /cgi-bin/Dados. Digite aqui apenas a parte numérica do nome do arquivo. Não digite a extensão (.conf)', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Logotipo do Boleto', 'MODULE_PAYMENT_BOLETO_IMAGEMLOGOTIPO', '', 'Opcional. Imagem que será exibida no cabeçalho do boleto. Antes de indicar o nome do arquivo de imagem neste campo, faça o upload da imagem para /loja/images/.', '6', '6', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Primeira linha do Demonstrativo', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO1' , 'Referente a aquisição de produtos na DeltaWorks.', 'Primeira linha do Demonstrativo', '6', '7', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Segunda linha do Demonstrativo', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO2' , '', 'Segunda linha do Demonstrativo', '6', '8', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Terceira linha do Demonstrativo', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO3' , '', 'Terceira linha do Demonstrativo', '6', '9', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Quarta linha do Demonstrativo', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO4' , '', 'Quarta linha do Demonstrativo', '6', '10', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Primeira linha de instruções', 'MODULE_PAYMENT_BOLETO_INSTRUCAO1' , '', 'Primeira linha de instruções', '6', '11', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Segunda linha de instruções', 'MODULE_PAYMENT_BOLETO_INSTRUCAO2' , 'Não receber após o vencimento.', 'Segunda linha de instruções', '6', '12', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Terceira linha de instruções', 'MODULE_PAYMENT_BOLETO_INSTRUCAO3' , '', 'Terceira linha de instruções', '6', '13', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Quarta linha de instruções', 'MODULE_PAYMENT_BOLETO_INSTRUCAO4' , '', 'Quarta linha de instruções', '6', '14', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Quinta linha de instruções', 'MODULE_PAYMENT_BOLETO_INSTRUCAO5' , '', 'Quinta linha de instruções', '6', '15', now())");
	
}

function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_STATUS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_TEXT_SELECTION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_TEXT_CONFIRMATION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_CGIPATH'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_CSID'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_IMAGEMLOGOTIPO'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO1'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO2'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO3'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO4'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_INSTRUCAO1'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_INSTRUCAO2'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_INSTRUCAO3'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_INSTRUCAO4'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_INSTRUCAO5'");
}

function keys() {
    $keys = array('MODULE_PAYMENT_BOLETO_STATUS', 'MODULE_PAYMENT_BOLETO_TEXT_SELECTION', 'MODULE_PAYMENT_BOLETO_TEXT_CONFIRMATION', 'MODULE_PAYMENT_BOLETO_CGIPATH', 'MODULE_PAYMENT_BOLETO_CSID', 'MODULE_PAYMENT_BOLETO_IMAGEMLOGOTIPO', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO1', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO2', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO3', 'MODULE_PAYMENT_BOLETO_DEMONSTRATIVO4', 'MODULE_PAYMENT_BOLETO_INSTRUCAO1', 'MODULE_PAYMENT_BOLETO_INSTRUCAO2', 'MODULE_PAYMENT_BOLETO_INSTRUCAO3', 'MODULE_PAYMENT_BOLETO_INSTRUCAO4', 'MODULE_PAYMENT_BOLETO_INSTRUCAO5');
    return $keys;
    }
  }
?>
