<?php
/*
  $Id: tools.php,v 1.18 2002/01/11 05:03:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tools //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=tools'));

  if ($selected_box == 'tools') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_BACKUP) . '">' . BOX_TOOLS_BACKUP . '</a><br>' .                                                  
                                   '<a href="' . tep_href_link(FILENAME_DEFINE_LANGUAGE) . '">' . BOX_TOOLS_DEFINE_LANGUAGE . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_MAIL) . '">' . BOX_TOOLS_MAIL . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_WHOS_ONLINE) . '"> Online User</a><br>' .
                                   '<a href="create_indexes.php"> Indexar a Database </a><br>' .
                                   '<a href="dbstatus.php"> Status da Database</a><br>'
                                   );
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- tools_eof //-->
