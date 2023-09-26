<?php
/*
  $Id: tell_a_friend.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TELL_A_FRIEND);

  $location = ' : <a href="' . tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';

  if (tep_session_is_registered('customer_id')) {
    $account = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
    $account_values = tep_db_fetch_array($account);
  } elseif (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false') {
    tep_redirect(tep_href_link(FILENAME_LOGIN, 'origin=' . FILENAME_TELL_A_FRIEND . '&emailproduct=' . $HTTP_GET_VARS['products_id'] . '&send_to=' . $HTTP_GET_VARS['send_to'], 'SSL'));
  }

  if (!$HTTP_GET_VARS['products_id']) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'));
  }

  $product_info = tep_db_query("select pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.language_id = '" . $languages_id . "'");
  $product_info_values = tep_db_fetch_array($product_info);
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
            <td class="pageHeading"><?php echo sprintf(HEADING_TITLE, $product_info_values['products_name']); ?></td>
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_contact_us.gif', sprintf(HEADING_TITLE, $product_info_values['products_name']), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($HTTP_GET_VARS['action'] == 'process') {
    if (tep_session_is_registered('customer_id')) {
      $from_name = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
      $from_email_address = $account_values['customers_email_address'];
    } else {
      $from_name = $HTTP_POST_VARS['yourname'];
      $from_email_address = $HTTP_POST_VARS['from'];
    }

    $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
    $email_body = sprintf(TEXT_EMAIL_INTRO, $HTTP_POST_VARS['friendname'], $from_name, $HTTP_POST_VARS['products_name'], STORE_NAME) . "\n\n";
    if ($HTTP_POST_VARS['yourmessage'] != '') {
      $email_body .= $HTTP_POST_VARS['yourmessage'] . "\n\n";
    }
    $email_body .= sprintf(TEXT_EMAIL_LINK, HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?products_id=' . $HTTP_GET_VARS['products_id']) . "\n\n";
    $email_body .= sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");
    tep_mail($HTTP_POST_VARS['friendname'], $HTTP_POST_VARS['friendemail'], $email_subject, stripslashes($email_body), '', $from_email_address, '');
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, stripslashes($HTTP_POST_VARS['products_name']), $HTTP_POST_VARS['friendemail']); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
      </tr>
<?php
  } else {
    if (tep_session_is_registered('customer_id')) {
      $your_name_prompt = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
      $your_email_address_prompt = $account_values['customers_email_address'];
    } else {
      $your_name_prompt = tep_draw_input_field('yourname', $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname']);
      $your_email_address_prompt = tep_draw_input_field('from', $account_values['customers_email_address']);
    }
?>
      <tr>
        <td><form <?php echo 'action="' . tep_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL') . '"'; ?> method="post"><input type="hidden" name="products_name" value="<?php echo $product_info_values['products_name']; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="formAreaTitle"><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td class="main"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></td>
                    <td class="main"><?php echo $your_name_prompt; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_EMAIL; ?></td>
                    <td class="main"><?php echo $your_email_address_prompt; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="formAreaTitle"><br><?php echo FORM_TITLE_FRIEND_DETAILS; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td class="main"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_NAME; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('friendname');?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('friendemail', $HTTP_GET_VARS['send_to']);?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="formAreaTitle"><br><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td class="main"><?php echo tep_draw_textarea_field('yourmessage', 'soft', 40, 8);?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
            <td align="right" class="main"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
          </tr>
        </table></form></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
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