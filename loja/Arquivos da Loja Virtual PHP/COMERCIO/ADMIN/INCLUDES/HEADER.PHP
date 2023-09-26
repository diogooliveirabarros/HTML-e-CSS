<?php
/*
  $Id: header.php, v 2.2 24/07/2003 by Paulo Cezar - Artsampa Exp $

  osCommerce
  http://www.oscommerce.com/

  Artsampa - Graffiti Art Shop
  http://www.artsampa.com/

  Copyright (c) 2000,2003 osCommerce

  Released under the GNU General Public License
 
*/

  if ($errorStack->size > 0) {
    echo $errorStack->output();
  }
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="left"><br>&nbsp; &nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'logo.gif', STORE_NAME); ?></td>
    <td align="center"><br><?php echo '<a href="http://www.oscommerce.com/community/faq/" target="_blank">' . tep_image(DIR_WS_IMAGES . 'header_faq.gif', HEADER_TITLE_FAQ, '48', '47') . '</a>'; ?></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerNavigation">

    <td class="headerNavigation" align="center"><b><?php echo '<a href="index.php"><font color="#000000"><B>Administração</B></font></a>'; ?> &nbsp;|&nbsp; <?php echo '<a href="../default.php"><font color="#000000"><B>Loja</B></font></a>'; ?> &nbsp;|&nbsp; <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="whitelink"><B>Estatísticas</B></a>'; ?>&nbsp;&nbsp;</b></td>
  </tr>
</table>
