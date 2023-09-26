<?php
/*
  $Id: box.php,v 1.3 2002/01/08 18:58:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  Example usage:

  $heading = array();
  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=tools'));

  $contents = array();
  $contents[] = array('text'  => SOME_TEXT);

  $box = new box;
  echo $box->infoBox($heading, $contents);
*/

  class box extends table {
    function box() {
      $this->heading = array();
      $this->contents = array();
    }

    function infoBox($heading, $contents) {
      $this->table_row_parameters = 'class="boxHeading"';
      $this->table_data_parameters = 'class="infoBoxHeading"';
      $this->heading = $this->table($heading);

      $this->table_row_parameters = '';
      $this->table_data_parameters = 'class="boxContents"';
      $this->contents = $this->table($contents);

      return $this->heading . $this->contents;
    }

    function menuBox($heading, $contents) {
      $this->table_data_parameters = 'class="infoBoxHeading"';
      if ($heading[0]['link']) {
        $heading[0]['text'] = '&nbsp;<a href="' . $heading[0]['link'] . '" class="blacklink">' . $heading[0]['text'] . '</a>&nbsp;';
      } else {
        $heading[0]['text'] = '&nbsp;' . $heading[0]['text'] . '&nbsp;';
      }
      $this->heading = $this->table($heading);

      $this->table_data_parameters = 'class="infoBox"';
      $this->contents = $this->table($contents);

      return $this->heading . $this->contents;
    }
  }
?>