<?php

/*
  boleto_ec.php 06/08/2002

  M�dulo de Pagamento para osCommerce

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

$confirmation_string .= "<p align=\"justify\"><font face=\"arial\" color=\"#000000\">ATEN��O: Clique em \"Gerar Boleto\" para abrir o boleto_ec banc�rio em uma nova janela. ";
$confirmation_string .= "Imprima o boleto seguindo as instru��es. Ap�s imprimir o boleto volte a esta p�gina e clique em \"Confirmar\" para que seu pedido seja processado. ";
$confirmation_string .= "Este boleto poder� ser pago em qualquer banco ou atrav�s do <u>homebanking</u>. Caso n�o tenha como imprimir, utilize os dados do boleto para efetuar o dep�sito em nossa conta banc�ria.</font></p> ";

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
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Emitir Boleto Banc�rio? (0=N�O 1=SIM)', 'MODULE_PAYMENT_BOLETO_EC_STATUS', '0', '', '6', '1', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Op��es de Pagamento)', 'MODULE_PAYMENT_BOLETO_EC_TEXT_SELECTION', 'Boleto Banc�rio', 'Texto a ser exibido para o cliente na tela do op��es de pagamento:', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instru��es para o Cliente)', 'MODULE_PAYMENT_BOLETO_EC_TEXT_CONFIRMATION', 'Seu pedido ser� enviado ap�s o processamento do boleto_ec no sistema banc�rio.', 'Texto a ser exibido para o cliente na confirma��o da compra', '6', '3', now())");	  
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CGI Path', 'MODULE_PAYMENT_BOLETO_EC_CGIPATH' , 'http://www.seudominio.com.br/cgi-bin/cobrebemecommerce', 'Caminho completo para o CGI do Cobre Bem E-Commerce', '6', '4', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CSID', 'MODULE_PAYMENT_BOLETO_EC_CSID', 'seucsid', 'Este par�metro identifica a conta corrente de cobran�a a ser utilizada para a gera��o do boleto. O valor a ser informado corresponde ao apelido que voc� atribuiu a sua conta corrente.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Usu�rio Boleto', 'MODULE_PAYMENT_BOLETO_EC_USUARIOBOLETO', '73101560440390', 'Este par�metro identifica o usu�rio que administra a conta corrente de cobran�a a ser utilizada para a gera��o do boleto.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Prazo de Vencimento', 'MODULE_PAYMENT_BOLETO_EC_PRAZOVENCIMENTO', '5', 'Este campo deve ser preenchido com a quantidade de dias a serem somados � data da compra para determinar a data de vencimento do boleto (o vencimento ser� calculado para cair em dia �til). Caso este par�metro esteja em branco ser� utilizada a data de vencimento � Vista.', '6', '5', now())");	
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Demonstrativo', 'MODULE_PAYMENT_BOLETO_EC_DEMONSTRATIVO', 'Referente a compra de produtos realizada atrav�s do site <b>www.seusite.com.br</b>' , 'Informe neste par�metro o c�digo HTML que ser� exibido no demonstrativo do recibo do seu cliente.', '6', '7', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Instru��es Caixa', 'MODULE_PAYMENT_BOLETO_EC_INSTRUCOESCAIXACEDENTE', '<b>Sr. Caixa, n�o receber ap�s o vencimento</b>', 'Informe neste par�metro o c�digo HTML que ser� exibido nas instru��es para o caixa na ficha de compensa��o do boleto.', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Outros Acr�scimos', 'MODULE_PAYMENT_BOLETO_EC_VALOROUTROSACRESCIMOS', '0.00', 'Informe neste par�metro o valor dos acr�scimos a serem somados sobre o valor do documento. Utilize ponto (.) para separar as casas decimais', '6', '5', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Prefixo Nosso N�mero', 'MODULE_PAYMENT_BOLETO_EC_PREFIXONOSSONUMERO', '', 'Caso este par�metro seja informado o Nosso N�mero ser� precedido dos n�meros informados aqui.', '6', '5', now())");	
	
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