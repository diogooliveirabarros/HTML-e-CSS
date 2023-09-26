<?php
/*
  $Id: product_info.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $location = '';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function popupImageWindow(url) {
  window.open(url,'popupImageWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
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
    <td width="100%" valign="top"><form name="cart_quantity" method="post" action="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product', 'NONSSL'); ?>"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  $product_info = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.language_id = '" . $languages_id . "'");
  if (!tep_db_num_rows($product_info)) { // product not found in database
?>
      <tr>
        <td class="main"><br><?php echo TEXT_PRODUCT_NOT_FOUND; ?></td>
      </tr>
      <tr>
        <td align="right"><br><a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_main_menu.gif', IMAGE_BUTTON_MAIN_MENU); ?></a></td>
      </tr>
<?php
  } else {
    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and language_id = '" . $languages_id . "'");
    $product_info_values = tep_db_fetch_array($product_info);

    $check_special = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . $product_info_values['products_id'] . "' and status = '1'");
    if (tep_db_num_rows($check_special)) {
      $check_special_values = tep_db_fetch_array($check_special);
      $new_price = $check_special_values['specials_new_products_price'];
    }
    if ($new_price) {
      $products_price = '<s>' . $currencies->format($product_info_values['products_price']) . '</s> <span class="productSpecialPrice">' . $currencies->format($new_price) . '</span>';
    } else {
      $products_price = $currencies->format($product_info_values['products_price']);
    }
    $products_attributes = tep_db_query("select popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . $languages_id . "'");
    if (tep_db_num_rows($products_attributes)) {
      $products_attributes = '1';
    } else {
      $products_attributes = '0';
    }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr height="80">
            <td class="pageHeading"><?php echo $product_info_values['products_name']; ?></td>
            <td align="right" class="pageHeading"><?php echo $products_price; ?></td>
          </tr>
<?php
    if (PRODUCT_LIST_MODEL) {
      echo '          <tr>' . "\n" .
           '            <td colspan="2" class="pageHeading">' . $product_info_values['products_model'] . '</td>' . "\n" .
           '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2" align="right">
<?php
    if ($product_info_values['products_image'] != '') { // If there is no product image hide the link
?>
          <tr>
            <td align="center" class="smallText"><a href="javascript:popupImageWindow('<?php echo tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info_values['products_id']); ?>')"><?php echo tep_image(DIR_WS_IMAGES . $product_info_values['products_image'], $product_info_values['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"'); ?><br><?php echo TEXT_CLICK_TO_ENLARGE; ?></a></td>
          </tr>
<?php
    }
?>
        </table><p><?php echo stripslashes($product_info_values['products_description']); ?></p>
<?php
    if ($products_attributes == '1') {
      $products_options_name = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . $languages_id . "'");
      echo '<b>' . TEXT_PRODUCT_OPTIONS . '</b><br>';
      echo '<table border="0" cellpading="0" cellspacing"0">';
      while ($products_options_name_values = tep_db_fetch_array($products_options_name)) { 
        $selected = 0;
        $products_options = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . $products_options_name_values['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . $languages_id . "'");
        echo '<tr><td class="main">' . $products_options_name_values['products_options_name'] . ':</td><td>' . "\n" . '<select name ="id[' . $products_options_name_values['products_options_id'] . ']">' . "\n"; 
        while ($products_options_values = tep_db_fetch_array($products_options)) {
          echo "\n" . '<option name="' . $products_options_name_values['products_options_name'] . '" value="' . $products_options_values['products_options_values_id'] . '"';
          if ( ($products_options_values['options_values_price'] == 0 && $selected == 0) || ($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name_values['products_options_id']] == $products_options_values['products_options_values_id'])) {
            $selected = 1;
            echo ' SELECTED';
          }
          echo '>' . $products_options_values['products_options_values_name'];
          if ($products_options_values['options_values_price'] != '0') {
            echo ' (' . $products_options_values['price_prefix'] . $currencies->format($products_options_values['options_values_price']) .')&nbsp';
          }
          echo  '</option>';
        };
        echo '</select></td></tr>';
      }
      echo '</table>';
    }
?>
        </td>
      </tr>
<?php
    $reviews = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "'");
    $reviews_values = tep_db_fetch_array($reviews);
    if ($reviews_values['count'] > 0) {
?>
      <tr>
        <td class="main"><br><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews_values['count']; ?></td>
      </tr>
<?php
    }

    if ($product_info_values['products_url']) {
?>
      <tr>
        <td class="main"><br><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info_values['products_url']), 'NONSSL', true, false)); ?></td>
      </tr>
<?php
    }

    if ($product_info_values['products_date_available'] > date('d-m-Y H:i:s')) {
?>
      <tr>
        <td align="center" class="smallText"><br><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info_values['products_date_available'])); ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="center" class="smallText"><br><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info_values['products_date_added'])); ?></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php if (!DW_IMPEDIR_COMENTARIOS){ ?>
            <td class="main"><a href="<? echo tep_href_link(FILENAME_PRODUCT_REVIEWS, substr(tep_get_all_get_params(), 0, -1)); ?>"><?php echo tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS); ?></a></td>
            <?php }?>
		<td align="right" class="main"><input type="hidden" name="products_id" value="<?php echo $product_info_values['products_id']; ?>"><?php echo tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br>
<?php
    if ( (USE_CACHE == 'true') && !SID) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
  }
?>
        </td>
      </tr>
    </table></form></td>
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
