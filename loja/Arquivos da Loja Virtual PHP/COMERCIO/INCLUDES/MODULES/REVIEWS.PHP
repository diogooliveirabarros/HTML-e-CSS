<?php
/*
  $Id: reviews.php,v 1.6 2001/11/29 20:49:18 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
?>
<table border="0" cellspacing="0" cellpadding="2">
<?php
  if (sizeof($reviews_array) == '0') {
?>
  <tr>
    <td class="main"><?php echo TEXT_NO_REVIEWS; ?></td>
  </tr>
<?php
  } else {
    for($i=0; $i<sizeof($reviews_array); $i++) {
?>
  <tr>
    <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews_array[$i]['products_id'] . '&reviews_id=' . $reviews_array[$i]['reviews_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $reviews_array[$i]['products_image'], $reviews_array[$i]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></td>
    <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews_array[$i]['products_id'] . '&reviews_id=' . $reviews_array[$i]['reviews_id'], 'NONSSL') . '"><b><u>' . $reviews_array[$i]['products_name'] . '</u></b></a> (' . sprintf(TEXT_REVIEW_BY, $reviews_array[$i]['authors_name']) . ', ' . sprintf(TEXT_REVIEW_WORD_COUNT, $reviews_array[$i]['word_count']) . ')<br>' . $reviews_array[$i]['review'] . '<br><br><i>' . sprintf(TEXT_REVIEW_RATING, tep_image(DIR_WS_IMAGES . 'stars_' . $reviews_array[$i]['rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews_array[$i]['rating'])), sprintf(TEXT_OF_5_STARS, $reviews_array[$i]['rating'])) . '<br>' . sprintf(TEXT_REVIEW_DATE_ADDED, $reviews_array[$i]['date_added']) . '</i>'; ?></td>
  </tr>
<?php
      if (($i+1) != sizeof($reviews_array)) {
?>
  <tr>
    <td colspan="2" class="main">&nbsp;</td>
  </tr>
<?php
      }
    }
  }
?>
</table>
