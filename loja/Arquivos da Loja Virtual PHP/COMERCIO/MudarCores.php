<?php
/*
  $Id: MudarCores.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  require('includes/application_top.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Script para Alteração de Cores</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<?
$filetpl = "./dw_styles.dat";
$dw_template = fopen($filetpl, "r"); 
$dw_tplcontent = fread ($dw_template, filesize ($filetpl)); 
$dw_tfile = fopen("/home/deltawor/www/newstore/catalog/stylesheet.css","w"); 
$dw_conteudonovo = str_replace("%DW_BGCLR%", DW_BGCOLOR, $dw_tplcontent);
$fp = fwrite($dw_tfile, $dw_conteudonovo); 
fclose ($dw_template);
fclose ($dw_tfile);

?>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>