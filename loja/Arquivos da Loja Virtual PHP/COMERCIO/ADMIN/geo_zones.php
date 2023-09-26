<?php
/*
  $Id: geo_zones.php,v 1.10 2002/01/05 05:29:22 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if($HTTP_GET_VARS['zList']) {
    switch($HTTP_GET_VARS['action']) {
      case 'insert': tep_db_query("insert into " . TABLE_ZONES_TO_GEO_ZONES . " (zone_country_id,zone_id,geo_zone_id,date_added) values ('" . $HTTP_POST_VARS['zone_country_id'] . "', '" . $HTTP_POST_VARS['zone_id'] . "', '" . $HTTP_POST_VARS['geo_zone_id'] . "', now())");
                     header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL')); tep_exit();
                     break;
      case 'save': tep_db_query("update " . TABLE_ZONES_TO_GEO_ZONES . " set geo_zone_id = '" . $HTTP_POST_VARS['geo_zone_id'] . "', zone_country_id = '" . $HTTP_POST_VARS['zone_country_id'] . "', zone_id = " . ($HTTP_POST_VARS['zone_id']?"'".$HTTP_POST_VARS['zone_id'] . "'":'NULL') . ", last_modified = now() where association_id = '" . $HTTP_POST_VARS['association_id'] . "'");
                   header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL')); tep_exit();
                   break;
      case 'deleteconfirm': tep_db_query("delete from " . TABLE_ZONES_TO_GEO_ZONES . " where association_id = '" . $HTTP_POST_VARS['association_id'] . "'");
                            header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action', 'info')), 'NONSSL')); tep_exit();
                            break;
    }
  } else {
    if ($HTTP_GET_VARS['action']) {
      if ($HTTP_GET_VARS['action'] == 'insert') {
        tep_db_query("insert into " . TABLE_GEO_ZONES . " (geo_zone_name, geo_zone_description, date_added) values ('" . $HTTP_POST_VARS['geo_zone_name'] . "', '" . $HTTP_POST_VARS['geo_zone_description'] . "', now())");
        header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, '', 'NONSSL')); tep_exit();
      } elseif ($HTTP_GET_VARS['action'] == 'save') {
        tep_db_query("update " . TABLE_GEO_ZONES . " set geo_zone_name = '" . $HTTP_POST_VARS['geo_zone_name'] . "', geo_zone_description = '" . $HTTP_POST_VARS['geo_zone_description'] . "', last_modified = now() where geo_zone_id = '" . $HTTP_POST_VARS['geo_zone_id'] . "'");
        header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL')); tep_exit();
      } elseif ($HTTP_GET_VARS['action'] == 'deleteconfirm') {
        tep_db_query("delete from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . $HTTP_POST_VARS['geo_zone_id'] . "'");
        header('Location: ' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action', 'info')), 'NONSSL')); tep_exit();
      }
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<?
  if ($HTTP_GET_VARS['zList']  && (($HTTP_GET_VARS['action'] == 'edit') || ($HTTP_GET_VARS['action'] == 'new'))) {
?>
<script language="javascript"><!--
function resetZoneSelected(theForm) {
  if (theForm.state.value != '') {
    theForm.zone_id.selectedIndex = '0';
    if (theForm.zone_id.options.length > 0) {
      theForm.state.value = '<?php echo JS_STATE_SELECT; ?>';
    }
  }
}

function update_zone(theForm) {
  var NumState = theForm.zone_id.options.length;
  var SelectedCountry = "";

  while(NumState > 0) {
    NumState--;
    theForm.zone_id.options[NumState] = null;
  }         

  SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;
<?php echo tep_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>
}
//--></script>
<?php  
	}
?>
</head>
<body onload="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td class="topBarTitle">&nbsp;<?php echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php
  if ($HTTP_GET_VARS['zList']) {
    echo '<a href="' . FILENAME_GEO_ZONES . '">' . HEADING_TITLE . '</a> / ' . tep_get_geo_zone_name($HTTP_GET_VARS['zList']);
  } else {
    echo HEADING_TITLE;
  } ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
<?php
  if ($HTTP_GET_VARS['zList']) {
?>
                <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_COUNTRY_NAME; ?>&nbsp;</td>
                <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_COUNTRY_ZONE; ?>&nbsp;</td>
                <td align="center" class="tableHeading" width="10%">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
<?php
  } else {
?>
                <td class="tableHeading">&nbsp;<?php echo TABLE_HEADING_GEO_ZONE_NAME; ?>&nbsp;</td>
                <td align="center" class="tableHeading" width="10%">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
<?php
  }
?>
              </tr>
              <tr>
                <td colspan="3"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
  if ($HTTP_GET_VARS['zList']) {
    $rows = 0;
    $zones_query_raw = "select a.association_id, a.zone_country_id, c.countries_name, a.zone_id, a.geo_zone_id, a.last_modified, a.date_added, z.zone_name from " . TABLE_COUNTRIES . " c, " . TABLE_ZONES_TO_GEO_ZONES . " a LEFT JOIN " . TABLE_ZONES . " z ON (z.zone_id = a.zone_id) where (a.zone_country_id = c.countries_id) AND (a.geo_zone_id = " . $HTTP_GET_VARS['zList'] . ") order by association_id";
    $zones_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = tep_db_query($zones_query_raw);
    while ($zones = tep_db_fetch_array($zones_query)) {
      $rows++;
      if (((!$HTTP_GET_VARS['info']) || (@$HTTP_GET_VARS['info'] == $zones['association_id'])) && (!$tzaInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
        $tzaInfo = new geoZoneAssociationInfo($zones);
      }
      if ($zones['association_id'] == @$tzaInfo->id) {
        echo '                  <tr class="selectedRow">' . "\n";
      } else {
        echo '                  <tr class="tableRow" onmouseover="this.className=\'tableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'tableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('info', 'action')) . 'info=' . $zones['association_id'], 'NONSSL') . '\'">' . "\n";
      }
?>
                <td class="smallText">&nbsp;<?php echo $zones['countries_name']; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $zones['zone_id']?$zones['zone_name']:"*"; ?>&nbsp;</td>
<?php
      if ($zones['association_id'] == @$tzaInfo->id) {
?>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); ?>&nbsp;</td>
<?php
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('info', 'action', 'zList')) . 'info=' . $zones['geo_zone_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; ?>&nbsp;</td>
<?php
      }
?>
              </tr>
<?php
    }
  } else {
    $rows = 0;
    $zones_query_raw = "select geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added from " . TABLE_GEO_ZONES . " order by geo_zone_name";
    $zones_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = tep_db_query($zones_query_raw);
    while ($zones = tep_db_fetch_array($zones_query)) {
      $rows++;
      if (((!$HTTP_GET_VARS['info']) || (@$HTTP_GET_VARS['info'] == $zones['geo_zone_id'])) && (!$tzInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
        $tzInfo = new geoZoneInfo($zones);
      }
      if ($zones['geo_zone_id'] == @$tzInfo->id) {
        echo '                  <tr class="selectedRow">' . "\n";
      } else {
        echo '                  <tr class="tableRow" onmouseover="this.className=\'tableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'tableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('info', 'action')) . 'info=' . $zones['geo_zone_id'], 'NONSSL') . '\'">' . "\n";
      }
?>
                <td class="smallText">&nbsp;<b><?php echo '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('info', 'action')) . 'zList=' . $zones['geo_zone_id'], 'NONSSL') . '" class="blacklink"><u>' . $zones['geo_zone_name'] . '</u></a>'; ?></b>&nbsp;</td>
<?php
      if ($zones['geo_zone_id'] == @$tzInfo->id) {
?>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); ?>&nbsp;</td>
<?php
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('info', 'action')) . 'info=' . $zones['geo_zone_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; ?>&nbsp;</td>
<?php
      }
?>
              </tr>
<?php
    }
  }
?>
              <tr>
                <td colspan="3"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top" class="smallText">&nbsp;<?php echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_ZONES); ?>&nbsp;</td>
                    <td align="right" class="smallText">&nbsp;<?php echo TEXT_RESULT_PAGE; ?> <?php echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;<?php
  if (!$HTTP_GET_VARS['action']) {
    echo '<br><br>&nbsp;';
    if ($HTTP_GET_VARS['zList']) echo '<a href="' . FILENAME_GEO_ZONES . '">' . tep_image(DIR_WS_IMAGES . 'button_back.gif', IMAGE_BACK) . '</a>';
    echo '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action', 'info')) . 'action=new', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_new_geo_zone.gif', IMAGE_NEW_GEO_ZONE) . '</a>&nbsp;'; 
  }
?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="25%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $info_box_contents = array();
  if ($tzInfo) $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $tzInfo->title . '</b>&nbsp;');
  if ($tzaInfo) $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $tzaInfo->title . '</b>&nbsp;');
  if ((!$tzInfo) && (!$tzaInfo) && ($HTTP_GET_VARS['action'] == 'new')) $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . TEXT_INFO_HEADING_NEW_GEO_ZONE . '</b>&nbsp;');
?>
              <tr class="boxHeading">
                <td><?php new infoBoxHeading($info_box_contents); ?></td>
              </tr>
              <tr class="boxHeading">
                <td><?php echo tep_black_line(); ?></td>
              </tr>
<?php
  if ($HTTP_GET_VARS['zList']) {
    if ($HTTP_GET_VARS['action'] == 'new') {
      $form = '<form name="rates" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=insert', 'NONSSL') . '" method="post"><input type="hidden" name="association_id" value="' . $tzaInfo->id . '"><input type="hidden" name="geo_zone_id" value="' . $HTTP_GET_VARS['zList'] . '">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_EDIT_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_COUNTRY . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries(), $tzaInfo->country_id, 'onChange="update_zone(this.form);"') . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_COUNTRY_ZONE . '<br>' . tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down($tzaInfo->country_id), $tzaInfo->zone_id) . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } elseif ($HTTP_GET_VARS['action'] == 'edit') {
      $form = '<form name="rates" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=save', 'NONSSL') . '" method="post"><input type="hidden" name="association_id" value="' . $tzaInfo->id . '"><input type="hidden" name="geo_zone_id" value="' . $HTTP_GET_VARS['zList'] . '">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_EDIT_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_COUNTRY . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries(), $tzaInfo->country_id, 'onChange="update_zone(this.form);"') . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_COUNTRY_ZONE . '<br>' . tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down($tzaInfo->country_id), $tzaInfo->zone_id) . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } elseif ($HTTP_GET_VARS['action'] == 'delete') {
      $form = '<form name="zones" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=deleteconfirm', 'NONSSL') . '" method="post"><input type="hidden" name="association_id" value="' . $tzaInfo->id . '"><input type="hidden" name="geo_zone_id" value="' . $HTTP_GET_VARS['zList'] . '">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_DELETE_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $tzaInfo->title . '</b><br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_delete.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } else {
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=edit', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=delete', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_delete.gif', IMAGE_DELETE) . '</a>');
      $info_box_contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($tzaInfo->date_added) . '<br>&nbsp;' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($tzaInfo->last_modified));
    }
  } else {
    if ($HTTP_GET_VARS['action'] == 'new') {
      $form = '<form name="zones" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=insert', 'NONSSL') . '" method="post">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_INSERT_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_NAME . '<br><input type="text" name="geo_zone_name"><br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_DESCRIPTION . '<br><input type="text" name="geo_zone_description"><br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } elseif ($HTTP_GET_VARS['action'] == 'edit') {
      $form = '<form name="zones" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=save', 'NONSSL') . '" method="post"><input type="hidden" name="geo_zone_id" value="' . $tzInfo->id . '">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_EDIT_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_NAME . '<br><input type="text" name="geo_zone_name" value="' . $tzInfo->title . '"><br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_GEO_ZONE_DESCRIPTION . '<br><input type="text" name="geo_zone_description" value="' . $tzInfo->description . '"><br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } elseif ($HTTP_GET_VARS['action'] == 'delete') {
      $form = '<form name="zones" action="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=deleteconfirm', 'NONSSL') . '" method="post"><input type="hidden" name="geo_zone_id" value="' . $tzInfo->id . '">'  ."\n";
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_INFO_DELETE_INTRO . '<br>&nbsp;');
      $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $tzInfo->title . '</b><br>&nbsp;');
      $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_delete.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', IMAGE_CANCEL) . '</a>');
    } else {
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=edit', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_GEO_ZONES, tep_get_all_get_params(array('action')) . 'action=delete', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_delete.gif', IMAGE_DELETE) . '</a>');
      $info_box_contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($tzInfo->date_added) . '<br>&nbsp;' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($tzInfo->last_modified));
      $info_box_contents[] = array('align' => 'left', 'text' => '<br>' . TEXT_INFO_GEO_ZONE_DESCRIPTION . '<br>' . $tzInfo->description);
    }
  }
?>
              <tr><?php echo $form; ?>
                <td class="box"><?php new infoBox($info_box_contents); ?></td>
              <?php if ($form) echo '</form>'; ?></tr>
              <tr>
                <td class="box"><?php echo tep_black_line(); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
