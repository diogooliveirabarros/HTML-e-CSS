<?php

/*
  boleto_ec.php 06/08/2002

  Módulo de Pagamento para osCommerce

  Copyright (c) 2002 Rodrigo S. Ferreira <rsferreira@terra.com.br>
  Released under the GNU General Public License
*/

class boleto_ec {
    var $code, $title, $description, $enabled;

// !Class constructor -> initialize class variables.
// Sets the class code, description, and status.
    function boleto_ec() {
      $this->code = 'boleto_ec';
      $this->title = MODULE_PAYMENT_BOLETO_EC_TEXT_TITLE;
      $this->email_footer = MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION;							
      $this->description = MODULE_PAYMENT_BOLETO_EC_TEXT_DESCRIPTION;
      $this->enabled = MODULE_PAYMENT_BOLETO_EC_STATUS;
  }

function javascript_validation() {
	return false;
}

function selection() {
	global $customer_id;
	$selection_string = MODULE_PAYMENT_BOLETO_EC_TEXT_SELECTION . tep_draw_hidden_field('numero_boleto', $customer_id . rand(100,999)) ;
	return $selection_string;
}

function pre_confirmation_check() {
	return false;    
}

function confirmation() { 

$confirmation_string = MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION;

global $HTTP_POST_VARS, $total_cost, $total_tax, $shipping_cost, $customer_id, $customer_default_address_id;

$cliente_query = tep_db_query("select c.customers_firstname, c.customers_lastname, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, entry_country_id, c.documento_cliente from " . TABLE_CUSTOMERS . " c, " . TABLE_ADDRESS_BOOK . " a where c.customers_id = '" .  $customer_id . "' and a.customers_id = c.customers_id and a.address_book_id = '" . $customer_default_address_id . "'");
$cliente = tep_db_fetch_array($cliente_query);

$confirmation_string .= "<p align=\"justify\"><font face=\"arial\" color=\"#000000\">ATENÇÃO: Clique em \"Gerar Boleto\" para abrir o boleto_ec bancário em uma nova janela. ";
$confirmation_string .= "Imprima o boleto seguindo as instruções. Após imprimir o boleto volte a esta página e clique em \"Confirmar\" para que seu pedido seja processado. ";
$confirmation_string .= "Este boleto poderá ser pago em qualquer banco ou através do <u>homebanking</u>. Caso não tenha como imprimir, utilize os dados do boleto para efetuar o depósito em nossa conta bancária.</font></p> ";

$confirmation_string .= "\n<form method=\"get\" action=\"" . MODULE_PAYMENT_BOLETO_EC_CGIPATH . "\" target=\"_blank\">";

$confirmation_string .= "\n<input type=hidden name=\"IdentificacaoPagina\" value=\"PB\">";
$confirmation_string .= "\n<input type=hidden name=\"UsuarioBoleto\" value=\"" . MODULE_PAYMENT_BOLETO_EC_USUARIOBOLETO . "\">";
$confirmation_string .= "\n<input type=hidden name=\"CSID\" value=\"" . MODULE_PAYMENT_BOLETO_EC_CSID . "\">";
$confirmation_string .= "\n<input type=hidden name=\"PrazoVencimento\" value=\"" . MODULE_PAYMENT_BOLETO_EC_PRAZOVENCIMENTO . "\">";
$confirmation_string .= "\n<input type=hidden name=\"VencimentoDiaUtil\" value=\"S\">";
$confirmation_string .=	"\n<input type=hidden name=\"NumeroDocumento\" value=\"" . $HTTP_POST_VARS['numero_boleto'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"ValorDocumento\" value=\"" . ($total_cost + $total_tax + $shipping_cost) . "\">";
$confirmation_string .= "\n<input type=hidden name=\"CaracterDecimal\" value=\".\">";
$confirmation_string .= "\n<input type=hidden name=\"NossoNumero\" value=\"" .  $HTTP_POST_VARS['numero_boleto'] . "\">";
$confirmation_string .= "\n<input type=hidden name=\"CalculaDac\" value=\"S\">";
$confirmation_string .=	"\n<input type=hidden name=\"NomeSacado\" value=\"" . $cliente['customers_firstname'] . ' ' . $cliente['customers_lastname'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"EnderecoSacado\" value=\"" . $cliente['entry_street_address'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CepSacado\" value=\"" . $cliente['entry_postcode'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"BairroSacado\" value=\"" . $cliente['entry_suburb'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CidadeSacado\" value=\"" . $cliente['entry_city'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"EstadoSacado\" value=\"" . tep_get_zone_code($cliente['entry_country_id'], $cliente['entry_zone_id'], $cliente['entry_state']) . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"CNPJCPFSacado\" value=\"" . $cliente['documento_cliente'] . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"Demonstrativo\" value=\"" . MODULE_PAYMENT_BOLETO_EC_DEMONSTRATIVO . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"InstrucoesCaixaCedente\" value=\"" . MODULE_PAYMENT_BOLETO_EC_INSTRUCOESCAIXACEDENTE . "\">";

$confirmation_string .=	"\n<input type=hidden name=\"ValorOutrosAcrescimos\" value=\"" . MODULE_PAYMENT_BOLETO_EC_VALOROUTROSACRESCIMOS . "\">";
$confirmation_string .=	"\n<input type=hidden name=\"PrefixoNossoNumero\" value=\"" . MODULE_PAYMENT_BOLETO_EC_PREFIXONOSSONUMERO . "\">";

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
    $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_STATUS'");
    $check = tep_db_num_rows($check);

    return $check;
}

function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Emitir Boleto Bancário? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_BOLETO_EC_STATUS', '0', '', '6', '1', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Opções de Pagamento)', 'MODULE_PAYMENT_BOLETO_EC_TEXT_SELECTION', 'Boleto Bancário', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instruções para o Cliente)', 'MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION', 'Seu pedido será enviado após o processamento do boleto_ec no sistema bancário.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '3', now())");	  
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CGI Path', 'MODULE_PAYMENT_BOLETO_EC_CGIPATH' , 'http://www.seudominio.com.br/cgi-bin/cobrebemecommerce', 'Caminho completo para o CGI do Cobre Bem E-Commerce', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CSID', 'MODULE_PAYMENT_BOLETO_EC_CSID', 'seucsid', 'Este parâmetro identifica a conta corrente de cobrança a ser utilizada para a geração do boleto. O valor a ser informado corresponde ao apelido que você atribuiu a sua conta corrente.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Usuário Boleto', 'MODULE_PAYMENT_BOLETO_EC_USUARIOBOLETO', '73101560440390', 'Este parâmetro identifica o usuário que administra a conta corrente de cobrança a ser utilizada para a geração do boleto.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Prazo de Vencimento', 'MODULE_PAYMENT_BOLETO_EC_PRAZOVENCIMENTO', '5', 'Este campo deve ser preenchido com a quantidade de dias a serem somados à data da compra para determinar a data de vencimento do boleto (o vencimento será calculado para cair em dia útil). Caso este parâmetro esteja em branco será utilizada a data de vencimento À Vista.', '6', '5', now())");	
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Demonstrativo', 'MODULE_PAYMENT_BOLETO_EC_DEMONSTRATIVO', 'Referente a compra de produtos realizada através do site <b>www.seusite.com.br</b>' , 'Informe neste parâmetro o código HTML que será exibido no demonstrativo do recibo do seu cliente.', '6', '7', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Instruções Caixa', 'MODULE_PAYMENT_BOLETO_EC_INSTRUCOESCAIXACEDENTE', '<b>Sr. Caixa, não receber após o vencimento</b>', 'Informe neste parâmetro o código HTML que será exibido nas instruções para o caixa na ficha de compensação do boleto.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Outros Acréscimos', 'MODULE_PAYMENT_BOLETO_EC_VALOROUTROSACRESCIMOS', '0.00', 'Informe neste parâmetro o valor dos acréscimos a serem somados sobre o valor do documento. Utilize ponto (.) para separar as casas decimais', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Prefixo Nosso Número', 'MODULE_PAYMENT_BOLETO_EC_PREFIXONOSSONUMERO', '', 'Caso este parâmetro seja informado o Nosso Número será precedido dos números informados aqui.', '6', '5', now())");	
	
}

function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_STATUS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_TEXT_SELECTION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_CGIPATH'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_CSID'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_USUARIOBOLETO'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_PRAZOVENCIMENTO'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_DEMONSTRATIVO'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_INSTRUCOESCAIXACEDENTE'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_VALOROUTROSACRESCIMOS'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETO_EC_PREFIXONOSSONUMERO'");
}

function keys() {
    $keys = array('MODULE_PAYMENT_BOLETO_EC_STATUS', 'MODULE_PAYMENT_BOLETO_EC_TEXT_SELECTION', 'MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION', 'MODULE_PAYMENT_BOLETO_EC_CGIPATH', 'MODULE_PAYMENT_BOLETO_EC_CSID', 'MODULE_PAYMENT_BOLETO_EC_USUARIOBOLETO', 'MODULE_PAYMENT_BOLETO_EC_PRAZOVENCIMENTO', 'MODULE_PAYMENT_BOLETO_EC_DEMONSTRATIVO', 'MODULE_PAYMENT_BOLETO_EC_INSTRUCOESCAIXACEDENTE', 'MODULE_PAYMENT_BOLETO_EC_VALOROUTROSACRESCIMOS', 'MODULE_PAYMENT_BOLETO_EC_PREFIXONOSSONUMERO');
    return $keys;
    }
  }
?>