<?php
/*
  $Id: main_page.php,v 1.1 2002/01/02 13:03:21 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

<head>

<STYLE type="text/css">
<!--
BODY {
scrollbar-face-color: #FFFFFF;
scrollbar-highlight-color: #000063;
scrollbar-3dlight-color: #FFFFFF;
scrollbar-darkshadow-color: #000063;
scrollbar-shadow-color: #000063;
scrollbar-arrow-color: #000063;
scrollbar-track-color: #FFFFFF;
}
-->
</STYLE>

<title>Loja Virtual osCommerce 2.2 Br</title>

<meta name="ROBOTS" content="NOFOLLOW">

<link rel="stylesheet" type="text/css" href="templates/main_page/stylesheet.css">

</head>

<body text="#000000" bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" oncontextmenu="return false;">

<?php require('templates/main_page/header.php'); ?>

<table cellspacing="0" cellpadding="0" width="780" border="0">
  <tr>
    <td><img src="images/pixel_trans.gif" border="0" width="1" height="5"></td>
  </tr>
</table>

<table cellspacing="0" cellpadding="0" width="780" border="0" align="center">
  <tr>
    <td width="125" valign="top">

<?php require('templates/main_page/boxes_left.php'); ?>

    </td>
    <td width="5"></td>
    <td width="650" valign="top">

<?php require('templates/pages/' . $page_contents); ?>

    </td>
  </tr>
</table>

<br>
<?php require('templates/main_page/footer.php'); ?>
<br>

</body>

</html>