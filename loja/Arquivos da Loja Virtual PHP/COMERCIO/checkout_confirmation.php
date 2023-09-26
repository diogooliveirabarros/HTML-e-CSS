<?php
/*
  $Id: checkout_confirmation.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_LOGIN, 'origin=' . FILENAME_SHOPPING_CART, 'SSL'));
  }

// Check if there is something in the cart
  if ($cart->count_contents() == 0) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'));
  }

// Stock Check
  if (STOCK_CHECK == 'true') {
    $products = $cart->get_products();
    for ($i=0; $i<sizeof($products); $i++) {
      $products_name = $products[$i]['name'];
      $products_id = $products[$i]['id'];
      check_stock($products[$i]['id'], $products[$i]['quantity']);
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock)) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

// Register checkout variables
  if ($HTTP_POST_VARS['comments']) {
    $comments = stripslashes($HTTP_POST_VARS['comments']);
    if (!tep_session_is_registered('comments')) {
      tep_session_register('comments');
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);
  $location = ' : <a href="' . tep_href_link(FILENAME_CHECKOUT_ADDRESS, '', 'SSL') . '" class="headerNavigation">' . NAVBAR_TITLE_1 . '</a> : ' . NAVBAR_TITLE_2;

// load shipping modules as objects
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

// load payment modules as objects
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  if (MODULE_PAYMENT_INSTALLED) {
    $payment_modules->pre_confirmation_check();
  }
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
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_confirmation.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
    </table><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td align="center" class="tableHeading"><?php echo TABLE_HEADING_QUANTITY; ?></td>
            <td class="tableHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td align="center" class="tableHeading"><?php echo TABLE_HEADING_TAX; ?></td>
            <td align="right" class="tableHeading"><?php echo TABLE_HEADING_TOTAL; ?></td>
          </tr>
          <tr>
            <td colspan="4"><?php echo tep_black_line(); ?></td>
          </tr>
<?php
  $address = tep_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_street_address as street_address, entry_suburb as suburb, entry_postcode as postcode, entry_city as city, entry_zone_id as zone_id, entry_country_id as country_id, entry_state as state from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $customer_id . "' and address_book_id = '" . $sendto . "'");
  $address_values = tep_db_fetch_array($address);
  $total_cost = 0;
  $total_tax = 0;
  $total_taxes = array();
  $total_weight = 0;
  $products = $cart->get_products();
  for ($i=0; $i<sizeof($products); $i++) {
    $products_name = $products[$i]['name'];
    $products_price = $products[$i]['price'];
    $total_products_price = ($products_price + $cart->attributes_price($products[$i]['id']));
    $products_tax = tep_get_tax_rate($address_values['country_id'], $address_values['zone_id'], $products[$i]['tax_class_id']);
    $products_weight = $products[$i]['weight'];

    echo '          <tr>' . "\n";
    echo '            <td align="center" valign="top" class="main">' . $products[$i]['quantity'] . '</td>' . "\n";
    echo '            <td valign="top" class="main"><b>' . $products_name . '</b>';

      if (STOCK_CHECK == 'true') {
        echo check_stock ($products[$i]['id'], $products[$i]['quantity']);
      }

    //------display customer choosen option --------
    $attributes_exist = '0';
    if ($products[$i]['attributes']) {
      $attributes_exist = '1';
      reset($products[$i]['attributes']);
      while (list($option, $value) = each($products[$i]['attributes'])) {
        $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $products[$i]['id'] . "' and pa.options_id = '" . $option . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $value . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
        $attributes_values = tep_db_fetch_array($attributes);
        echo '<br><small><i> - ' . $attributes_values['products_options_name'] . ' : ' . $attributes_values['products_options_values_name'] . '</i></small>';
      }
    }
//------display customer choosen option eof-----
    echo '</td>' . "\n";
    echo '            <td align="center" valign="top" class="main">' . number_format($products_tax, TAX_DECIMAL_PLACES) . '%</td>' . "\n";
    echo '            <td align="right" valign="top" class="main"><b>' . $currencies->format($products[$i]['quantity'] * $products_price) . '</b>';
//------display customer choosen option --------
    if ($attributes_exist == '1') {
      reset($products[$i]['attributes']);
      while (list($option, $value) = each($products[$i]['attributes'])) {
        $attributes = tep_db_query("select pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $products[$i]['id'] . "' and pa.options_id = '" . $option . "' and pa.options_values_id = '" . $value . "'");
        $attributes_values = tep_db_fetch_array($attributes);
        if ($attributes_values['options_values_price'] != '0') {
          echo '<br><small><i>' . $attributes_values['price_prefix'] . $currencies->format($products[$i]['quantity'] * $attributes_values['options_values_price']) . '</i></small>';
        }
      }
    }
//------display customer choosen option eof-----
    echo '</td>' . "\n";
    echo '</tr>' . "\n";

    $total_weight += ($products[$i]['quantity'] * $products_weight);
    if (TAX_INCLUDE == true) {
      $total_taxes[number_format($products_tax, TAX_DECIMAL_PLACES)] += (($total_products_price * $products[$i]['quantity']) - (($total_products_price * $products[$i]['quantity']) / (($products_tax/100)+1)));
    } else {
      $total_taxes[number_format($products_tax, TAX_DECIMAL_PLACES)] += (($total_products_price * $products[$i]['quantity']) * $products_tax/100);
    }
    $total_cost += ($total_products_price * $products[$i]['quantity']);
  }

  $country = tep_get_countries($address_values['country_id']);
  $shipping_cost = 0;
?>
          <tr>
            <td colspan="4"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td align="right" class="tableHeading" colspan="3"><?php echo SUB_TITLE_SUB_TOTAL; ?></td>
            <td align="right" class="tableHeading"><?php echo $currencies->format($total_cost); ?></td>
          </tr>
<?php
  reset($total_taxes);
  while (list($percentage, $tax) = each($total_taxes)) {
    $total_tax += $tax;
?>
          <tr>
            <td align="right" class="tableHeading" colspan="3"><?php echo sprintf(SUB_TITLE_TAX, number_format($percentage, TAX_DECIMAL_PLACES)); ?></td>
            <td align="right" class="tableHeading"><?php echo $currencies->format($tax); ?></td>
          </tr>
<?php
  }
  if (MODULE_SHIPPING_INSTALLED) {
    $shipping_modules->confirm();
?>
          <tr>
            <td align="right" class="tableHeading" colspan="3"><?php echo $shipping_method . " " . SUB_TITLE_SHIPPING; ?></td>
            <td align="right" class="tableHeading"><?php echo $currencies->format($shipping_cost); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td align="right" class="tableHeading" colspan="3"><?php echo SUB_TITLE_TOTAL; ?></td>
            <td align="right" class="tableHeading">
<?php
  if (TAX_INCLUDE == true) {
    echo $currencies->format($total_cost + $shipping_cost);
  } else {
    echo $currencies->format($total_cost + $total_tax + $shipping_cost);
  } 
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="tableHeading"><?php echo TABLE_HEADING_DELIVERY_ADDRESS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_address_label($customer_id, $sendto, 1, ' ', '<br>'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
   if (MODULE_PAYMENT_INSTALLED) {
?>
          <tr>
            <td class="tableHeading"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td><?php echo $payment_modules->confirmation(); ?></td>
          </tr>
<?php
  }

  if (!$checkout_form_action) {
    $checkout_form_action = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
  }

  echo '<form name="checkout_confirmation" method="post" action="' . $checkout_form_action . '">';

  if ($comments) {
?>
          <tr>
            <td class="main"><br><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
          </tr>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo nl2br($comments); ?></td>
          </tr>
<?php
  }
// Stock Options prompts user for sending when STOCK is available or send now !
  if (($any_out_of_stock) && (STOCK_ALLOW_CHECKOUT == 'true') && (MODULE_SHIPPING_INSTALLED)) {
?>
          <tr>
            <td class="tableHeading"><br><?php echo TEXT_STOCK_WARNING; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="payment-odd">
            <td class="main"><?php echo TEXT_MULTIPLE_SHIPMENT; ?> <input type="radio" name="shiptype" value="Multiple Ship" checked><?php echo TEXT_UNIQUE_SHIPMENT; ?><input type="radio" name="shiptype" value="Single Ship"></td>
          </tr>
          <tr>
            <td class="infoBox"><br><?php echo TEXT_STOCK_WARNING_DESC; ?></td>
          </tr>
          <tr>
            <td class="infoBox"><b><?php echo TEXT_IMEDIATE_DELIVER; ?></b><br><br>
<?php
    for ($i=0; $i<sizeof($products); $i++) {
      $products_name = $products[$i]['name'];
      $products_price = $products[$i]['price'];
      $products_id = $products[$i]['id'];
      $products_quantity = $products[$i]['quantity'];
      $out_of_stock = check_stock($products[$i]['id'], $products[$i]['quantity']);

      if ($out_of_stock) {
//  $qtd_to_ship = ($products_quantity  -= $qtd_stock);
        if ($qtd_stock < 0) $qtd_stock = 0;
        echo '<b>' . $qtd_stock . '</b> ' . TEXT_UNITS . ' <b>' . $products_name . '</b><br>';
      }
    }
?>
            </td>
          </tr>
<?php
  }
?>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td align="center" class="main"><br><input type=button  name="button"  value="Imprimir/Print" onClick="window.print()" style="color: #000000; font-family: Verdana; font-size: 8 pt; border: 1 solid #000000"> &nbsp; &nbsp;
<?php
  echo tep_draw_hidden_field('prod', $HTTP_POST_VARS['prod']) .
       tep_draw_hidden_field('payment', $HTTP_POST_VARS['payment']) .
       tep_draw_hidden_field('shipping_cost', $shipping_cost) .
       tep_draw_hidden_field('shipping_method', $shipping_method) .
       $payment_modules->process_button();

  if (!$checkout_form_submit) {
    echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER);
  } else {
    echo $checkout_form_submit;
  }
?></td>
          </tr></form>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="checkoutBar"><br>[ <?php echo CHECKOUT_BAR_DELIVERY_ADDRESS; ?> | <?php echo CHECKOUT_BAR_PAYMENT_METHOD; ?> | <span class="checkoutBarHighlighted"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></span> | <?php echo CHECKOUT_BAR_FINISHED; ?> ]</td>
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
