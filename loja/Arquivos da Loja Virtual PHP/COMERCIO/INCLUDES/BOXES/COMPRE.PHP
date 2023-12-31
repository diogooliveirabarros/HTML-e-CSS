<?php
/*
  $Id: compre.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/
?>
<!-- compre //-->
          <tr>
            <td>
<?php
  if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_image, p.products_price, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status='1' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.status = '1' order by p.products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left',
                                 'text'  => BOX_HEADING_COMPRE
                                );
    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_PRODUCTS_NEW, '', 'NONSSL'));

    if ($random_product['specials_new_products_price']) {
      $whats_new_price =  '<s>' . $currencies->format($random_product['products_price']) . '</s><br>';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->format($random_product['specials_new_products_price']) . '</span>';
    } else {
      $whats_new_price =  $currencies->format($random_product['products_price']);
    }
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'center',
                                 'text'  => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . tep_get_product_path($random_product['products_id']) . '&products_id=' . $random_product['products_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'], 'NONSSL') . '">' . $random_product['products_name'] . '</a><br>' . $whats_new_price
                                );
    new infoBox($info_box_contents);
  }
?>
            </td>
          </tr>
<!-- whats_new_eof //-->
