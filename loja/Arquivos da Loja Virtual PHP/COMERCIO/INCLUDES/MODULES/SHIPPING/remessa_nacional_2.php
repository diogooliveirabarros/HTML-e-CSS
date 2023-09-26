<?php
/*
  $Id: remessa_nacional_2.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/


  class remessa_nacional_2 {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function remessa_nacional_2() {
      $this->code = 'remessa_nacional_2';
      $this->title = MODULE_SHIPPING_REMESSA_NACIONAL_2_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_REMESSA_NACIONAL_2_TEXT_DESCRIPTION;
      $this->icon = '';
      $this->enabled = MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS;
    }

// class methods
    function selection() {
      $selection_string = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . MODULE_SHIPPING_REMESSA_NACIONAL_2_TEXT_TITLE . '&nbsp;</td>' . "\n" .
                          '    <td align="right" class="main">&nbsp;' . tep_draw_checkbox_field('shipping_quote_remessa_nacional_2', '1', true) . '&nbsp;</td>' . "\n" .
                          '  </tr>' . "\n" .
                          '</table>' . "\n";

      return $selection_string;
    }


      function quote() {
      global $cart, $shipping_quoted, $address_values, $shipping_weight, $shipping_remessa_nacional_2_cost, $shipping_remessa_nacional_2_method;

      if ( ($GLOBALS['shipping_quote_all'] == '1') || ($GLOBALS['shipping_quote_remessa_nacional_2'] == '1') ) {
        $shipping_quoted = 'remessa_nacional_2';
     
	$Estado = tep_get_zone_code('30', $address_values['zone_id'], 'NF');

	  if (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA1, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA1;
        }
      elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA2, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA2;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA3, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA3;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA4, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA4;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA5, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA5;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA6, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA6;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA7, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA7;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA8, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA8;
        }
	  elseif (stristr(MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA9, $Estado)) {
          $remessa_nacional_2_cost = MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA9;
        } else {
 	    $remessa_nacional_2_cost = 0;	
	  }
		
        $remessa_nacional_2_table = split("[:,]" , $remessa_nacional_2_cost);
        for ($i = 0; $i < count($remessa_nacional_2_table); $i+=2) {
          if ($shipping_weight <= $remessa_nacional_2_table[$i]) {
            $shipping = $remessa_nacional_2_table[$i+1];
            $shipping_remessa_nacional_2_method = $shipping_weight . ' kg' . ' - ' . MODULE_SHIPPING_REMESSA_NACIONAL_2_METODO;
            break;
          }
        }
        
	  if ($remessa_nacional_2_cost) {
	      $shipping_remessa_nacional_2_cost = ($shipping + MODULE_SHIPPING_REMESSA_NACIONAL_2_HANDLING);
	  } else {
		$shipping_remessa_nacional_2_cost = 0;
		$shipping_remessa_nacional_2_method = "Encomenda Normal";
	  }	
	}
    }


    function cheapest() {
      global $shipping_count, $shipping_cheapest, $shipping_cheapest_cost, $shipping_remessa_nacional_2_cost;

      if ( ($GLOBALS['shipping_quote_all'] == '1') || ($GLOBALS['shipping_quote_remessa_nacional_2'] == '1') ) {
        if ($shipping_count == 0) {
          $shipping_cheapest = 'remessa_nacional_2';
          $shipping_cheapest_cost = $shipping_remessa_nacional_2_cost;
        } else {
          if ($shipping_remessa_nacional_2_cost < $shipping_cheapest_cost) {
            $shipping_cheapest = 'remessa_nacional_2';
            $shipping_cheapest_cost = $shipping_remessa_nacional_2_cost;
          }
        }
        $shipping_count++;
      }
    }

    function display() {
      global $HTTP_GET_VARS, $address_values, $currencies, $shipping_cheapest, $shipping_remessa_nacional_2_method, $shipping_remessa_nacional_2_cost, $shipping_selected;

// set a global for the radio field (auto select cheapest shipping method)
      if (!$HTTP_GET_VARS['shipping_selected']) $shipping_selected = $shipping_cheapest;

      if ( ($GLOBALS['shipping_quote_all'] == '1') || ($GLOBALS['shipping_quote_remessa_nacional_2'] == '1') ) {
        $display_string = '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;&nbsp;' . MODULE_SHIPPING_REMESSA_NACIONAL_2_TEXT_TITLE . ' <small><i>(' . $shipping_remessa_nacional_2_method . ')</i></small>&nbsp;</td>' . "\n" .
                          '    <td align="right" class="main">&nbsp;' . $currencies->format($shipping_remessa_nacional_2_cost);
        if (tep_count_shipping_modules() > 1) {
          $display_string .= '&nbsp;&nbsp;' . tep_draw_radio_field('shipping_selected', 'remessa_nacional_2') .
                                              tep_draw_hidden_field('shipping_remessa_nacional_2_cost', $shipping_remessa_nacional_2_cost) .
                                              tep_draw_hidden_field('shipping_remessa_nacional_2_method', $shipping_remessa_nacional_2_method) . '&nbsp;</td>' . "\n";
        } else {
          $display_string .= '&nbsp;&nbsp;' . tep_draw_hidden_field('shipping_selected', 'remessa_nacional_2') .
                                              tep_draw_hidden_field('shipping_remessa_nacional_2_cost', $shipping_remessa_nacional_2_cost) .
                                              tep_draw_hidden_field('shipping_remessa_nacional_2_method', $shipping_remessa_nacional_2_method) . '&nbsp;</td>' . "\n";
        }
        $display_string .= '  </tr>' . "\n" .
                           '</table>' . "\n";
      }

      return $display_string;
    }

    function confirm() {
      global $HTTP_POST_VARS, $shipping_cost, $shipping_method;

      if ($HTTP_POST_VARS['shipping_selected'] == 'remessa_nacional_2') {
        $shipping_cost = $HTTP_POST_VARS['shipping_remessa_nacional_2_cost'];
        $shipping_method = $HTTP_POST_VARS['shipping_remessa_nacional_2_method'];
      }
    }

    function check() {
      $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS'");
      $check = tep_db_num_rows($check);

      return $check;
    }

    function install() {
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Habilitar Remessa Nacional', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS', '1', 'Habilitar Remessa Nacional? (0=NÃO 1=SIM)?', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA1', 'PR, RJ', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA1', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 02 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA2', 'MG, SC', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 02 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA2', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 03 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA3', 'DF, ES, MS, RS', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 03 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA3', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 04 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA4', 'BA, GO, MT, TO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 04 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA4', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 05 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA5', 'AL, SE', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 05 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA5', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 06 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA6', 'PB, PE, PI, RO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 06 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA6', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 07 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA7', 'AC, AM, AP, CE, MA, PA, RN', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 07 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA7', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 08 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA8', 'RR', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 08 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA8', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 09 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA9', 'SP', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 09 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA9', '1:6.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Forma de Envio', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_METODO', 'Encomenda Normal / Registrada', 'Serviço a ser utilizado na remessa', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA9'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA9'");
	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_METODO'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_REMESSA_NACIONAL_2_HANDLING'");
    }

    function keys() {
      $keys = array('MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_METODO', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_HANDLING', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA1', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA1', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA2',  'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA2', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA3', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA3', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA4', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA4', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA5', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA5', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA6', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA6', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA7', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA7', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA8', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA8', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA9', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA9');
      return $keys;
    }

   }


?>
