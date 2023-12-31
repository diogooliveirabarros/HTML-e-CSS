<?php
/*
  $Id: orders.php,v 1.60 2001/12/23 16:36:43 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if ($HTTP_GET_VARS['action']) {
    if ($HTTP_GET_VARS['action'] == 'update_order') {
      $order_finish = ($HTTP_GET_VARS['status'] == '3') ? ', orders_date_finished = now()' : '';
      tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . $HTTP_GET_VARS['status'] . "', last_modified = now()" . $order_finish . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
      tep_db_query("update " . TABLE_ORDERS . " set comments = '" . $HTTP_GET_VARS['comments'] . "' where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_ORDERS, 'orders_id=' . $HTTP_GET_VARS['orders_id'])); tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'delete_order') {
      tep_db_query("delete from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id_delete'] . "'");
      tep_db_query("delete from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $HTTP_GET_VARS['orders_id_delete'] . "'");
      header('Location: ' . tep_href_link(FILENAME_ORDERS, '')); tep_exit();
    }
  }

// * check if orders exist, if not redirect back to orders page with error
// * this check is done at the top to avoid headers being sent for the redirect
  if (@$HTTP_GET_VARS['orders_id']) {
    $orders = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    if (!tep_db_num_rows($orders)) {
      header('Location: ' . tep_href_link(FILENAME_ORDERS, 'error=' . $HTTP_GET_VARS['orders_id'], 'NONSSL')); tep_exit();
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<?php
  if (@$HTTP_GET_VARS['error']) {
?>
<script language="javascript"><!---
function alertBox() {
  alert('<?php echo sprintf(JS_ORDER_DOES_NOT_EXIST, $HTTP_GET_VARS['error']); ?>');
  return true;
}
//--></script>
<?php
  }
?>
<body <?php if ($HTTP_GET_VARS['error']) echo 'onLoad="alertBox();"'; ?>>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td class="topBarTitle">&nbsp;<?php echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right" class="smallText"><br><form name="orders" <?php echo 'action="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(), 'NONSSL') . '"'; ?> method="get">&nbsp;<?php echo HEADING_TITLE_SEARCH; ?>&nbsp;<input type="text" name="orders_id" value="<?php echo $HTTP_GET_VARS['orders_id']; ?>" size="5">&nbsp;<?php echo tep_image_submit(DIR_WS_IMAGES . 'button_search.gif', IMAGE_SEARCH); ?>&nbsp;</form></td>
          </tr>
        </table></td>
      </tr>
<?php
  if (@$HTTP_GET_VARS['orders_id']) {
    $orders = tep_db_query("select customers_telephone, customers_email_address, payment_method, documento_cliente, numero_boleto, cc_type, cc_owner, cc_number, cc_expires, date_purchased, orders_status from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    $orders_values = tep_db_fetch_array($orders);
    $sold_to = tep_db_query("select customers_name as name, customers_street_address as street_address, customers_suburb as suburb, customers_city as city, customers_postcode as postcode, customers_state as state, customers_country as country, customers_address_format_id as format_id from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    $sold_to_values = tep_db_fetch_array($sold_to);
    $ship_to = tep_db_query("select delivery_name as name, delivery_street_address as street_address, delivery_suburb as suburb, delivery_city as city, delivery_postcode as postcode, delivery_state as state, delivery_country as country, delivery_address_format_id as format_id from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    $ship_to_values = tep_db_fetch_array($ship_to);
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><b>&nbsp;<?php echo TABLE_HEADING_CUSTOMERS_INFO; ?>&nbsp;</b></td>
            <td class="main" valign="top"><b>&nbsp;<?php echo TABLE_HEADING_DELIVERY_INFO; ?>&nbsp;</b></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">&nbsp;<?php echo ENTRY_CUSTOMER; ?>&nbsp;</td>
                <td class="main"><?php echo tep_address_format($sold_to_values['format_id'], $sold_to_values, 1, '&nbsp;', '<br>'); ?></td>
              </tr>
<? // DW ---> ?>
              <tr>
                <td class="main">&nbsp;CPF/CNPJ:&nbsp;</td>
                <td class="main">&nbsp;<?php echo $orders_values['documento_cliente']; ?>&nbsp;</td>
              </tr>
<? // DW <--- ?>
		  <tr>
                <td class="main">&nbsp;<?php echo ENTRY_TELEPHONE; ?>&nbsp;</td>
                <td class="main">&nbsp;<?php echo $orders_values['customers_telephone']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td class="main">&nbsp;<?php echo ENTRY_EMAIL_ADDRESS; ?>&nbsp;</td>
                <td class="main">&nbsp;<a href="mailto:<?php echo $orders_values['customers_email_address']; ?>"><u><?php echo $orders_values['customers_email_address']; ?></u></a>&nbsp;</td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">&nbsp;<?php echo ENTRY_DELIVERY_TO; ?>&nbsp;</td>
                <td class="main"><?php echo tep_address_format($ship_to_values['format_id'], $ship_to_values, 1, '&nbsp;', '<br>'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="main" colspan="2"><br><b>&nbsp;<?php echo TABLE_HEADING_PAYMENT_INFORMATION; ?>&nbsp;</b></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td colspan="2"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main">&nbsp;<?php echo ENTRY_PAYMENT_METHOD; ?>&nbsp;</td>
                <td class="main">&nbsp;<?php echo $orders_values['payment_method']; ?>&nbsp;</td>
              </tr>
<?php
    if ($orders_values['cc_type'] || $orders_values['cc_owner'] || $orders_values['cc_number']) {
      print "<tr>\n";
      print "<td colspan=\"2\">&nbsp;</td>\n";
      print "</tr>\n";
      print "<tr>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities(ENTRY_CREDIT_CARD_TYPE) . "&nbsp;</td>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities($orders_values['cc_type']) . "&nbsp;</td>\n";
      print "</tr>\n";
      print "<tr>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities(ENTRY_CREDIT_CARD_OWNER) . "&nbsp;</td>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities($orders_values['cc_owner']) . "&nbsp;</td>\n";
      print "</tr>\n";
      print "<tr>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities(ENTRY_CREDIT_CARD_NUMBER) . "&nbsp;</td>\n";
      print "<td class=\"main\">&nbsp;" . $orders_values['cc_number'] . "&nbsp;</td>\n";
      print "</tr>\n";
      print "<tr>\n";
      print "<td class=\"main\">&nbsp;" . htmlentities(ENTRY_CREDIT_CARD_EXPIRES) . "&nbsp;</td>\n";
      print "<td class=\"main\">&nbsp;" . $orders_values['cc_expires'] . "&nbsp;</td>\n";
      print "</tr>\n";
    }
//DW --->
	if ($orders_values['numero_boleto']) {
		print "<tr>\n";
      	print "<td colspan=\"2\">&nbsp;</td>\n";
	      print "</tr>\n";
      	print "<tr>\n";
	      print "<td class=\"main\">&nbsp;Boleto Banc�rio&nbsp;</td>\n";
      	print "<td class=\"main\">&nbsp;" . htmlentities($orders_values['numero_boleto']) . "&nbsp;</td>\n";
	      print "</tr>\n";
	}
//DW <---

?>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="tableHeading" align="center">&nbsp;<?php echo TABLE_HEADING_QUANTITY; ?>&nbsp;</td>
                <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_PRODUCTS_MODEL; ?>&nbsp;</td>
                <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_PRODUCTS; ?>&nbsp;</td>
                <td class="tableHeading" align="center">&nbsp;<?php echo TABLE_HEADING_TAX; ?>&nbsp;</td>
                <td class="tableHeading" align="right">&nbsp;<?php echo TABLE_HEADING_TOTAL; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5"><?php echo tep_black_line(); ?></td>
              </tr>
<?
    $info = tep_db_query("select date_purchased, orders_status, last_modified, shipping_cost, shipping_method,comments from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    $info_values = tep_db_fetch_array($info);
    $shipping = $info_values['shipping_cost'];
    $shipping_method = $info_values['shipping_method'];
    $products = tep_db_query("select orders_products_id, products_id, products_model, products_name, products_price, products_quantity, final_price, products_tax from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "'");
    $total_cost = 0;
    $total_tax = 0;
    while ($products_values = tep_db_fetch_array($products)) {
      $final_price = $products_values['final_price'];

      echo '          <tr>' . "\n";
      echo '            <td align="center" class="main">&nbsp;' . $products_values['products_quantity'] . '&nbsp;</td>' . "\n";
      echo '            <td class="main"><b>&nbsp;' . $products_values['products_model'] . '&nbsp;</b>' . "\n";
      echo '            <td class="main"><b>&nbsp;' . $products_values['products_name'] . '&nbsp;</b>' . "\n";
//------display customer choosen option --------
      $attributes_exist = '0';
      $attributes_query = tep_db_query("select products_options, products_options_values from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "' and orders_products_id = '" . $products_values['orders_products_id'] . "'");
      if (@tep_db_num_rows($attributes_query)) {
        $attributes_exist = '1';
        while ($attributes = tep_db_fetch_array($attributes_query)) {
	  	    echo '<br><small><i>&nbsp;-&nbsp;' . $attributes['products_options'] . '&nbsp;:&nbsp;' . $attributes['products_options_values'] . '</i></small>';
        }
      }
//------display customer choosen option eof-----
	    echo '            </td>' . "\n";
      echo '            <td align="center" valign="top" class="main">&nbsp;' . number_format($products_values['products_tax'], TAX_DECIMAL_PLACES) . '%&nbsp;</td>' . "\n";
      echo '            <td align="right" valign="top" class="main">&nbsp;<b>' . tep_currency_format($products_values['products_quantity'] * $products_values['products_price']) . '</b>&nbsp;';
//------display customer choosen option --------
      if ($attributes_exist == '1') {
        $attributes = tep_db_query("select options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $HTTP_GET_VARS['orders_id'] . "' and orders_products_id = '" . $products_values['orders_products_id'] . "'");
        while ($attributes_values = tep_db_fetch_array($attributes)) {
          if ($attributes_values['options_values_price'] != '0') {
            echo '<br><small><i>' . $attributes_values['price_prefix'] . tep_currency_format($products_values['products_quantity'] * $attributes_values['options_values_price']) . '</i></small>&nbsp;';
          } else {
            echo '<br>&nbsp;';
          }
        }
      }
//------display customer choosen option eof-----
	    echo '            </td>' . "\n";
      echo '          </tr>' . "\n";

      $cost = ($products_values['products_quantity'] * $final_price);
      if (TAX_INCLUDE == true) {
        $total_tax += (($products_values['products_quantity'] * $final_price) - (($products_values['products_quantity'] * $final_price) / (($products_values['products_tax']/100)+1)));
      } else {
        $total_tax += ($cost * $products_values['products_tax']/100);
      }
      $total_cost += $cost;
    }
?>
              <tr>
                <td colspan="5"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr>
                <td align="right" colspan="5"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td align="right" class="main">&nbsp;<?php echo ENTRY_SUB_TOTAL; ?>&nbsp;</td>
                    <td align="right" class="main">&nbsp;<?php echo tep_currency_format($total_cost); ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="main">&nbsp;<?php echo ENTRY_TAX; ?>&nbsp;</td>
                    <td align="right" class="main">&nbsp;<?php echo tep_currency_format($total_tax); ?>&nbsp;</td>
                  </tr>
<?php
  if ($shipping != 0) {
?>
                  <tr>
                    <td align="right" class="main">&nbsp;<?php echo $shipping_method . " " . ENTRY_SHIPPING; ?>&nbsp;</td>
                    <td align="right" class="main">&nbsp;<?php echo tep_currency_format($shipping); ?>&nbsp;</td>
                  </tr>
<?php
  }
?>
                  <tr>
                    <td align="right" class="main"><b>&nbsp;<?php echo ENTRY_TOTAL; ?>&nbsp;</b></td>
                    <td align="right" class="main"><b>&nbsp;<?php
    if (TAX_INCLUDE == true) {
      echo tep_currency_format($total_cost + $shipping);
    } else {
      echo tep_currency_format($total_cost + $total_tax + $shipping);
    } ?>&nbsp;</b></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><b>&nbsp;<?php echo TABLE_HEADING_COMMENTS; ?>&nbsp;</b></td>
           </tr>
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <form name="status" <?php echo 'action="' . tep_href_link(FILENAME_ORDERS, '', 'NONSSL') . '"'; ?> method="get">
          <tr>
            <td colspan="2" class="main"><?php echo "<textarea name=comments rows=5 cols=60>" . $info_values['comments'] . "</textarea>" ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><b>&nbsp;<?php echo TABLE_HEADING_STATUS; ?>&nbsp;</b></td>
           </tr>
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><br><b>&nbsp;<?php echo ENTRY_DATE_PURCHASED; ?></b> <?php echo tep_date_long($info_values['date_purchased']); ?>&nbsp;</td>
          </tr>
          <tr><input type="hidden" name="action" value="update_order"><input type="hidden" name="orders_id" value="<?php echo $HTTP_GET_VARS['orders_id']; ?>">
            <td colspan="2" class="main"><br><b>&nbsp;<?php echo ENTRY_STATUS; ?></b> <?php echo tep_orders_status_pull_down('name="status"', $info_values['orders_status']); ?>&nbsp;<?php echo tep_image_submit(DIR_WS_IMAGES . 'button_update.gif', IMAGE_UPDATE); ?>&nbsp;</td>
          </tr></form>
<?php
    if (@$info_values['last_modified']) {
?>
          <tr>
            <td colspan="2" class="main"><br><b>&nbsp;<?php echo ENTRY_DATE_LAST_UPDATED; ?></b> <?php echo tep_date_long($info_values['last_modified']); ?>&nbsp;</td>
          </tr>
<?php
    }
?>
          <tr>
             <td colspan="2"><br><?php echo tep_black_line(); ?></td>
          </tr>
          <form action="<?php echo tep_href_link(FILENAME_ORDERS, '', 'NONSSL'); ?>" method="get" onsubmit="return confirm('<?php echo IMAGE_CONFIRM; ?>')">
          <tr>
            <td colspan="2" align="right"><input type="hidden" name="action" value="delete_order"><input type="hidden" name="orders_id_delete" value="<?php echo $HTTP_GET_VARS['orders_id'] ?>"><?php echo tep_image_submit(DIR_WS_IMAGES . 'button_delete.gif', IMAGE_DELETE); ?>&nbsp;&nbsp;<a href="<?php echo tep_href_link(FILENAME_ORDERS, '', 'NONSSL'); ?>"><?php echo tep_image(DIR_WS_IMAGES . 'button_back.gif', IMAGE_BACK); ?></a>&nbsp;&nbsp;</td>
          </tr>
          </form>
          <tr>
            <td colspan="2" class="main">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="5"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_CUSTOMERS; ?>&nbsp;</td>
            <td class="tableHeading" align="right">&nbsp;<?php echo TABLE_HEADING_ORDER_TOTAL; ?>&nbsp;</td>
            <td class="tableHeading" align="right">&nbsp;<?php echo TABLE_HEADING_PAYMENT_METHOD; ?>&nbsp;</td>
            <td class="tableHeading" align="right">&nbsp;<?php echo TABLE_HEADING_DATE_PURCHASED; ?>&nbsp;</td>
            <td class="tableHeading" align="right">&nbsp;<?php echo TABLE_HEADING_STATUS; ?>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5"><?php echo tep_black_line(); ?></td>
          </tr>
<?php
    if ($HTTP_GET_VARS['customers_id']) {
      $orders_query_raw = "select orders_id, customers_name, customers_id, payment_method, date_purchased, shipping_cost, orders_status from " . TABLE_ORDERS . " where customers_id = '" . $HTTP_GET_VARS['customers_id'] . "' order by orders_id DESC";
    } else {
      $orders_query_raw = "select orders_id, customers_name, payment_method, date_purchased, shipping_cost, orders_status from " . TABLE_ORDERS . " order by orders_id DESC";
    }
    $orders_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $orders_query_raw, $orders_query_numrows);
    $orders = tep_db_query($orders_query_raw);
    $rows = 0;
    while ($orders_values = tep_db_fetch_array($orders)) {
      $rows++;
      $total = 0;
      $orders_products = tep_db_query("select products_price, final_price, products_quantity, products_tax from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $orders_values['orders_id'] . "'");
      while ($orders_products_values = tep_db_fetch_array($orders_products)) {
        $subtotal = ($orders_products_values['final_price'] * $orders_products_values['products_quantity']);
        $tax = $subtotal * ($orders_products_values['products_tax']/100);
        if (TAX_INCLUDE == true) {
          $total = $total + $subtotal;
        } else {
          $total = $total + $subtotal + $tax;
        }
      }
      $total = $total + $orders_values['shipping_cost'];
?>
          <tr class="tableRow" onmouseover="this.className='tableRowOver';this.style.cursor='hand'" onmouseout="this.className='tableRow'" onclick="document.location.href='<?php echo tep_href_link(FILENAME_ORDERS, 'orders_id=' . $orders_values['orders_id'], 'NONSSL'); ?>'">
            <td class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, 'orders_id=' . $orders_values['orders_id'], 'NONSSL') . '" class="blacklink">'; ?><?php echo $orders_values['customers_name']; ?></a>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo tep_currency_format($total); ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo $orders_values['payment_method']; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo tep_datetime_short($orders_values['date_purchased']); ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo tep_get_orders_status_name($orders_values['orders_status'], $languages_id); ?>&nbsp;</td>
          </tr>
<?php
    }
?>
          <tr>
            <td colspan="5"><?php echo tep_black_line(); ?></td>
          </tr>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText">&nbsp;<?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?>&nbsp;</td>
                    <td align="right" class="smallText">&nbsp;<?php echo TEXT_RESULT_PAGE; ?> <?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
