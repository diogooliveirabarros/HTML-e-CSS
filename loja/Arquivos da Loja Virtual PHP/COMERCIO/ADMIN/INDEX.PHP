<?php


  require('includes/application_top.php');

  $cat = array(array('title' => BOX_HEADING_CONFIGURATION,
                     'image' => 'configuration.gif',
                     'href' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1'),
                     'children' => array(array('title' => 'Minha Loja', 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1')))),
               array('title' => BOX_HEADING_MODULES,
                     'image' => 'modules.gif',
                     'href' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=shipping')))),
               array('title' => BOX_HEADING_CATALOG,
                     'image' => 'catalog.gif',
                     'href' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                     'children' => array(array('title' => 'Conte�do', 'link' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_MANUFACTURERS, 'link' => tep_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog')))),
               array('title' => BOX_HEADING_LOCATION_AND_TAXES,
                     'image' => 'location.gif',
                     'href' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                     'children' => array(array('title' => BOX_TAXES_COUNTRIES, 'link' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_ZONES, 'link' => tep_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes')))),
               array('title' => BOX_HEADING_CUSTOMERS,
                     'image' => 'customers.gif',
                     'href' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                     'children' => array(array('title' => BOX_CUSTOMERS_CUSTOMERS, 'link' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers')),
                                         array('title' => BOX_CUSTOMERS_ORDERS, 'link' => tep_href_link(FILENAME_ORDERS, 'selected_box=customers')))),
               array('title' => BOX_HEADING_LOCALIZATION,
                     'image' => 'localization.gif',
                     'href' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                     'children' => array(array('title' => BOX_LOCALIZATION_CURRENCIES, 'link' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization')),
                                         array('title' => BOX_LOCALIZATION_LANGUAGES, 'link' => tep_href_link(FILENAME_LANGUAGES, 'selected_box=localization')))),
               array('title' => BOX_HEADING_REPORTS,
                     'image' => 'reports.gif',
                     'href' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'),
                     'children' => array(array('title' => 'Produtos', 'link' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports')),
                                         array('title' => 'Pedidos', 'link' => tep_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports')))),
               array('title' => BOX_HEADING_TOOLS,
                     'image' => 'tools.gif',
                     'href' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'),
                     'children' => array(array('title' => 'Backup', 'link' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools')),
                                                                                  array('title' => 'Editar Textos', 'link' => tep_href_link(FILENAME_DEFINE_LANGUAGE, 'selected_box=tools')))));

  $languages = tep_get_languages();
  $languages_array = array();
  for ($i=0; $i<sizeof($languages); $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<style type="text/css"><!--
a.text:link, a.text:visited { color: #000000; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }
a.main:link, a.main:visited { color: #000000; text-decoration: none; }
A.main:hover { color: #000000; text-decoration: underline; }
a.sub:link, a.sub:visited { color: #000000; text-decoration: none; }
A.sub:hover { color: #000000; text-decoration: underline; }
.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; line-height: 1.5; color: #000000; }
.main { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; font-weight: bold; line-height: 1.5; color: #000000; }
.sub { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; line-height: 1.5; color: #000000; }
.text { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; line-height: 1.5; color: #000000; }
//--></style>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" Oncontextmenu="return false;">
<br>
<table border="0" width="700" height="100%" cellspacing="0" cellpadding="0" align="center" valign="middle">
  <tr>
    <td><table border="0" width="700" height="440" cellspacing="0" cellpadding="1" align="center" valign="middle">
      <tr bgcolor="#B2C5D9">
        <td><table border="0" width="700" height="440" cellspacing="0" cellpadding="0">
          <tr bgcolor="#F4F6FB" height="60">
            <td height="60"> &nbsp; <?php echo tep_image(DIR_WS_IMAGES . 'logo.gif', 'osCommerce E-Commerce'); ?></td>
            <td align="right" class="text" nowrap><?php echo ' <a href="' . DIR_WS_CATALOG . '">Loja Virtual</a> | <a href="manualoja/faq.html" TARGET="_blank">Manual da Loja</a>'; ?>&nbsp;&nbsp;</td>
          </tr>
          <tr bgcolor="#F4F6FB">
            <td colspan="2"><table border="0" width="460" height="390" cellspacing="0" cellpadding="2">
              <tr>
                <td width="100" valign="top"><table border="0" width="100"  height="390" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top">

                    </td>
                  </tr>
                </table></td>
                <td width="460"><table border="0" width="460" height="390" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr><?php echo tep_draw_form('languages', 'index.php', '', 'get'); ?>
                        <td class="heading">Pain&eacute;l do Administrador da Loja</td>
                        <td align="right"><?php echo tep_draw_pull_down_menu('language', $languages_array, $HTTP_GET_VARS['language'], 'onChange="this.form.submit();"'); ?></td>
                      </form></tr>
                    </table></td>
                  </tr>
<?php
  $col = 2;
  $counter = 0;
  for ($i=0; $i<sizeof($cat); $i++) {
    $counter++;
    if ($counter < $col) {
      echo '                  <tr>' . "\n";
    }

    echo '                    <td><table border="0" cellspacing="0" cellpadding="2">' . "\n" .
         '                      <tr>' . "\n" .
         '                        <td><a href="' . $cat[$i]['href'] . '">' . tep_image(DIR_WS_IMAGES . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '48', '47') . '</a></td>' . "\n" .
         '                        <td><table border="0" cellspacing="0" cellpadding="2">' . "\n" .
         '                          <tr>' . "\n" .
         '                            <td" class="main"><a href="' . $cat[$i]['href'] . '" class="main">' . $cat[$i]['title'] . '</a></td>' . "\n" .
         '                          </tr>' . "\n" .
         '                          <tr>' . "\n" .
         '                            <td class="sub">';

    $children = '';
    for ($j=0; $j<sizeof($cat[$i]['children']); $j++) {
      $children .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="sub">' . $cat[$i]['children'][$j]['title'] . '</a>, ';
    }
    echo substr($children, 0, -2);

    echo '</td> ' . "\n" .
         '                          </tr>' . "\n" .
         '                        </table></td>' . "\n" .
         '                      </tr>' . "\n" .
         '                    </table></td>' . "\n";

    if ($counter >= $col) {
      echo '                  </tr>' . "\n";
      $counter = 0;
    }
  }
?>
  </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    <td align="center" class="smallText">

<br><br>Copyright � 2003 / 2004 - <a href="http://www.artsampa.com" target="_blank">Artsampa.com</a><br> Software Derivado de <a href="http://www.oscommerce.com" target="_blank">osCommerce</a><P>

</td></tr>
    </table></td>
  </tr></table>
</body>
</html>
