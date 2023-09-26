<?php
/*
  $Id: account_history_info.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  if (tep_session_is_registered('customer_id')) {
    $customer_number = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '". $HTTP_GET_VARS['order_id'] . "'");
    $customer_number_values = tep_db_fetch_array($customer_number);
    if ($customer_number_values['customers_id'] != $customer_id) {
      tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
    }
  } else {
    if (@$HTTP_GET_VARS['order_id']) {
      tep_redirect(tep_href_link(FILENAME_LOGIN, 'origin=' . FILENAME_ACCOUNT_HISTORY_INFO . '&order_id=' . $HTTP_GET_VARS['order_id'], 'SSL'));
    } else {
      tep_redirect(tep_href_link(FILENAME_LOGIN, 'origin=' . FILENAME_ACCOUNT_HISTORY, 'SSL'));
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);

  $location = ' : <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '" class="headerNavigation">' . NAVBAR_TITLE_1 . '</a> : <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '" class="headerNavigation">' . NAVBAR_TITLE_2 . '</a> : <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $HTTP_GET_VARS['order_id'], 'SSL') . '" class="headerNavigation">' . NAVBAR_TITLE_3 . '</a>';

// load payment modules as objects
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_history.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td align="center" class="tableHeading"><?php echo TABLE_HEADING_QUANTITY; ?></td>
            <td class="tableHeading"><?php echo TABLE_HEADING_PRODUCT; ?></td>
            <td align="center" class="tableHeading"><?php echo TABLE_HEADING_TAX; ?></td>
            <td align="right" class="tableHeading"><?php echo TABLE_HEADING_TOTAL; ?></td>
          </tr>
          <tr>
            <td colspan="4"><?php echo tep_draw_separator(); ?></td>
          </tr>
<?php
  $order_currency_query = tep_db_query("select currency, currency_value from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['order_id'] . "'");
  $order_currency = tep_db_fetch_array($order_currency_query);

  $orders_products_query = tep_db_query("select products_id, products_name, products_price, final_price, products_tax, products_quantity, orders_products_id from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $HTTP_GET_VARS['order_id'] . "'");
  $total_cost = 0;
  $total_tax = 0;
  while ($orders_products = tep_db_fetch_array($orders_products_query)) {
    $final_price = $orders_products['final_price'];
    echo '          <tr>' . "\n";
    echo '            <td align="center" valign="top" class="main">' . $orders_products['products_quantity'] . '</td>' . "\n";
    echo '            <td valign="top" class="main"><b>' . $orders_products['products_name'] . '</b>' . "\n";
//------display customer choosen option --------
    $attributes_exist = '0';
    $attributes_query = tep_db_query("select products_options, products_options_values from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $HTTP_GET_VARS['order_id'] . "' and orders_products_id = '" . $orders_products['orders_products_id'] . "'");
    if (@tep_db_num_rows($attributes_query)) {
      $attributes_exist = '1';
      while ($attributes = tep_db_fetch_array($attributes_query)) {
		echo '<br><small><i> - ' . $attributes['products_options'] . ' : ' . $attributes['products_options_values'] . '</i></small>';
      }
    }
//------display customer choosen option eof-----
	echo '</td>' . "\n";
    echo '            <td align="center" valign="top" class="main">' . number_format($orders_products['products_tax'], TAX_DECIMAL_PLACES) . '%</td>' . "\n";
    echo '            <td align="right" valign="top" class="main"><b>' . $currencies->format($orders_products['products_quantity'] * $orders_products['products_price'], true, $order_currency['currency'], $order_currency['currency_value']) . '</b>';
//------display customer choosen option --------
    if ($attributes_exist == '1') {
      $attributes_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $HTTP_GET_VARS['order_id'] . "' and orders_products_id = '" . $orders_products['orders_products_id'] . "'");
      while ($attributes = tep_db_fetch_array($attributes_query)) {
        if ($attributes['options_values_price'] != '0') {
          echo '<br><small><i>' . $attributes['price_prefix'] . $currencies->format($orders_products['products_quantity'] * $attributes['options_values_price'], true, $order_currency['currency'], $order_currency['currency_value']) . '</i></small>';
        }
      }
    }
//------display customer choosen option eof-----
    echo '</td>' . "\n";
    echo '          </tr>' . "\n";

    $cost = ($orders_products['products_quantity'] * $final_price);
    if (TAX_INCLUDE == true) {
      $total_tax += (($orders_products['products_quantity'] * $final_price) - (($orders_products['products_quantity'] * $final_price) / (($orders_products['products_tax']/100)+1)));
    } else {
      $total_tax += ($cost * $orders_products['products_tax']/100);
    }
    $total_cost += $cost;
  }
?>
          <tr>
            <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td colspan="4" align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0" align="right">
              <tr>
                <td align="right" width="100%" class="main"><?php echo TABLE_SUBHEADING_SUBTOTAL; ?></td>
                <td align="right" width="100%" class="main"><?php echo $currencies->format($total_cost, true, $order_currency['currency'], $order_currency['currency_value']); ?></td>
              </tr>
<?
  $order_query = tep_db_query("select delivery_name as name, delivery_street_address as street_address, delivery_suburb as suburb, delivery_city as city, delivery_postcode as postcode, delivery_state as state, delivery_country as country, delivery_address_format_id as format_id, payment_method, shipping_cost, shipping_method, comments from " . TABLE_ORDERS . " where orders_id = '" . $HTTP_GET_VARS['order_id'] . "'");
  $order = tep_db_fetch_array($order_query);

  if ($total_tax > 0) {
?>
              <tr>
                <td align="right" width="100%" class="main"><?php echo TABLE_SUBHEADING_TAX; ?>:</td>
                <td align="right" width="100%" class="main"><?php echo $currencies->format($total_tax, true, $order_currency['currency'], $order_currency['currency_value']); ?></td>
              </tr>
<?
  }

  $shipping = $order['shipping_cost'];
  if ( (MODULE_SHIPPING_INSTALLED) || ($shipping > 0) ) {
?>
              <tr>
                <td align="right" width="100%" class="main"><?php echo $order['shipping_method'] . " " . TABLE_SUBHEADING_SHIPPING; ?></td>
                <td align="right" width="100%" class="main"><?php echo $currencies->format($shipping, true, $order_currency['currency'], $order_currency['currency_value']); ?></td>
              </tr>
<?
  }
?>
              <tr>
                <td align="right" width="100%" class="main"><b><?php echo TABLE_SUBHEADING_TOTAL; ?></b></td>
<?
  if (TAX_INCLUDE) {
?>
              <td align="right" width="100%" class="main"><b><?php echo $currencies->format($total_cost + $shipping, true, $order_currency['currency'], $order_currency['currency_value']); ?></b></td>
<?
  } else {
?>
              <td align="right" width="100%" class="main"><b><?php echo $currencies->format($total_cost + $total_tax + $shipping, true, $order_currency['currency'], $order_currency['currency_value']); ?></b></td>
<?
  }
?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="tableHeading"><?php echo TABLE_HEADING_DELIVERY_ADDRESS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator(); ?></td>
          </tr>
<?php
     $boln = '<tr>' . "\n" . '            <td class="main">';
     $eoln = "</td>\n              </tr>\n";
     echo tep_address_format($order['format_id'], $order, true, $boln, $eoln);
?>
        </table></td>
      </tr>
<?php
   if (MODULE_PAYMENT_INSTALLED) {
?>
      <tr>
        <td class="main"><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="tableHeading"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator(); ?></td>
          </tr>
<?php
// load the show_info function from the payment modules
    echo $payment_modules->show_info();
?>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($order['comments']) {
?>
          <tr>
            <td class="main"><br><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator(); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo nl2br($order['comments']); ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, tep_get_all_get_params(array('order_id')), 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
