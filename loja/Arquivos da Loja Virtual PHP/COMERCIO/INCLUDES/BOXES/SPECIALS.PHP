<?php
/*
  $Id: specials.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- specials //-->
<?php
  if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . $languages_id . "' and s.status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.status = '1' order by s.specials_date_added DESC limit " . MAX_RANDOM_SELECT_SPECIALS)) {
?>
          <tr>
            <td>
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left',
                                 'text'  => BOX_HEADING_SPECIALS
                                );
    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_SPECIALS, '', 'NONSSL'));

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'center',
                                 'text'  => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'], 'NONSSL') . '">' . $random_product['products_name'] . '</a><br><s>' . $currencies->format($random_product['products_price']) . '</s><br><span class="productSpecialPrice">' . $currencies->format($random_product['specials_new_products_price']) . '</span>'
                                );
    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<?php
  }
?>
<!-- specials_eof //-->
