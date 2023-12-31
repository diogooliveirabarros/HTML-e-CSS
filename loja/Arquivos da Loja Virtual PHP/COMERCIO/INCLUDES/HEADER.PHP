<?php
/*
  $Id: header.php,v 1.31 2001/12/19 15:32:55 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 osCommerce

  Released under the GNU General Public License
*/
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><?php echo tep_image(DIR_WS_IMAGES . 'lojapadrao.gif', STORE_NAME); ?></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerNavigation">
    <td class="headerNavigation">

<?php
  echo '&nbsp;&nbsp;<a href="' . HTTP_SERVER . '" class="headerNavigation">' . HEADER_TITLE_TOP . '</a> &raquo; <a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerNavigation">' . HEADER_TITLE_CATALOG . '</a>';

  if ($cPath) {
    if (!ereg('_', $cPath)) {
      $cPath_array = array($cPath);
    }
    $cPath_new = '';
    for($i=0; $i<sizeof($cPath_array); $i++) {
      if ($cPath_new == '') {
        $cPath_new .= $cPath_array[$i];
      } else {
        $cPath_new .= '_' . $cPath_array[$i];
      }
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $cPath_array[$i] . "' and language_id='" . $languages_id . "'");
      $categories = tep_db_fetch_array($categories_query);
      echo ' &raquo; <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cPath_new, 'NONSSL') . '" class="headerNavigation">' . $categories['categories_name'] . '</a>';
    }
  } elseif ($HTTP_GET_VARS['manufacturers_id']) {
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . $HTTP_GET_VARS['manufacturers_id'] . "'");
    $manufacturers = tep_db_fetch_array($manufacturers_query);
    echo ' &raquo; <a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'], 'NONSSL') . '" class="headerNavigation">' . $manufacturers['manufacturers_name'] . '</a>';
  }
  if ($HTTP_GET_VARS['products_id']) {
    $model = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "'");
    $model_values = tep_db_fetch_array($model);
    echo ' &raquo; <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $HTTP_GET_VARS['cPath'] . '&products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL') . '" class="headerNavigation">' . $model_values['products_model'] . '</a>';
  }
  if ($location) {
    echo $location;
  }
?>
    </td>
    <td align="right" class="headerNavigation"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;</td>
  </tr>
</table>
<?php
  if ($HTTP_GET_VARS['error_message'] != '') {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo urldecode($HTTP_GET_VARS['error_message']); ?></td>
  </tr>
</table>
<?php
  }

  if ($HTTP_GET_VARS['info_message'] != '') {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo $HTTP_GET_VARS['info_message']; ?></td>
  </tr>
</table>
<?php
  }
?>
