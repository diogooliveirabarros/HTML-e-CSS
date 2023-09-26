<?php
/*
  $Id: install.php,v 1.3 2002/01/05 06:40:40 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  $script_filename = (($SCRIPT_FILENAME) ? $SCRIPT_FILENAME : $HTTP_SERVER_VARS['SCRIPT_FILENAME']);
  $request_uri = (($REQUEST_URI) ? $REQUEST_URI : $HTTP_SERVER_VARS['REQUEST_URI']);

  $dir_fs_www_root_array = explode('/', dirname($script_filename));
  $dir_fs_www_root = array();
  for ($i=0; $i<sizeof($dir_fs_www_root_array)-2; $i++) {
    $dir_fs_www_root[] = $dir_fs_www_root_array[$i];
  }
  $dir_fs_www_root = implode('/', $dir_fs_www_root);

  $dir_ws_www_root_array = explode('/', dirname($request_uri));
  $dir_ws_www_root = array();
  for ($i=0; $i<sizeof($dir_ws_www_root_array)-1; $i++) {
    $dir_ws_www_root[] = $dir_ws_www_root_array[$i];
  }
  $dir_ws_www_root = implode('/', $dir_ws_www_root);
?>
<p><span class="pageHeading"><font color="#9a9a9a">Loja Virtual osCommerce 2.2 Br</font></p>

<p class="pageTitle">Instalação Parte - 1</p>

<form name="install" action="install.php?step=2" method="post">

<p><b>1. Automatizando a instalação:</b></p>

<p><?php echo osc_draw_checkbox_field('install[]', 'database', true); ?> <b>Marque esta opção para que seu banco de dados seja criado</b><br>
</p>

<p><?php echo osc_draw_checkbox_field('install[]', 'configure', true); ?> <b>Marque esta opção para que sua configuração seja automática</b><br>
</p>

<p><b>2. Confirindo as informações dos diretórios do site:</b></p>

<p><b>Patch do diretório do seu site</b><br><?php echo osc_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root); ?><br>
</p>

<p><b>Patch do diretório da loja virtual</b><br><?php echo osc_draw_input_field('DIR_WS_CATALOG', $dir_ws_www_root . '/'); ?><br>
</p>

<p><b>Patch do diretório da administrção da loja</b><br><?php echo osc_draw_input_field('DIR_WS_ADMIN', $dir_ws_www_root . '/admin/'); ?><br>
</p>

<p><b>3. Entre as informações do seu banco de dados MySQL:</b></p>

<p><b>Servidor de Banco de Dados Localhost</b><br><?php echo osc_draw_input_field('DB_SERVER'); ?><br>
</p>

<p><b>Nome de Usuário</b><br><?php echo osc_draw_input_field('DB_SERVER_USERNAME'); ?><br>
</p>

<p><b>Senha de Usuário</b><br><?php echo osc_draw_input_field('DB_SERVER_PASSWORD'); ?><br>
</p>

<p><b>Nome do Banco de Dados MySQL</b><br><?php echo osc_draw_input_field('DB_DATABASE'); ?><br>
</p>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancelar"></a></td>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continuar"></td>
  </tr>
</table>

</form>
