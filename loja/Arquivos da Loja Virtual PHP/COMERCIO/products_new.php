<?php
/*
  $Id: products_new.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_NEW);

  $location = ' : <a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';
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
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_products_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.status = '1' order by p.products_date_added DESC, pd.products_name";

  $products_new_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_PRODUCTS_NEW, $products_new_query_raw, $products_new_numrows);

  $products_new_query = tep_db_query($products_new_query_raw);
  while ($products_new = tep_db_fetch_array($products_new_query)) {
    $products_new_array[] = array('id' => $products_new['products_id'],
                                  'name' => $products_new['products_name'],
                                  'image' => $products_new['products_image'],
                                  'price' => $products_new['products_price'],
                                  'specials_price' => $products_new['specials_new_products_price'],
                                  'date_added' => tep_date_long($products_new['products_date_added']),
                                  'manufacturer' => $products_new['manufacturers_name']);
  }

  require(DIR_WS_MODULES  . 'products_new.php');
?>
        </td>
      </tr>
<?php
  if ($products_new_numrows > 0 && (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count($products_new_numrows, MAX_DISPLAY_PRODUCTS_NEW, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $products_new_split->display_links($products_new_numrows, MAX_DISPLAY_PRODUCTS_NEW, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
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
