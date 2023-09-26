<?php
/*
  $Id: install_4.php,v 1.3 2002/01/05 06:40:40 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<p><span class="pageHeading"><font color="#9a9a9a">Loja Virtual osCommerce 2.2 Br</font></p>

<p class="pageTitle">Instalação Parte - 4</p>

<p><b>Step 2: Configuração de sua Loja</b></p>

<?php
  if ( (!is_writeable($HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_CATALOG'] . 'includes/configure.php')) || (!is_writeable($HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_ADMIN'] . 'includes/configure.php')) ) {
?>

<p>Os seguintes erros ocorreram:</p>

<p><div class="boxMe"><b>O arquivo de configuração não existe ou não tem permissão de escrita.</b><br><br>Por favor tome as seguintes ações:
<ul class="boxMe"><li>cd <?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_CATALOG']; ?>includes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul>
<ul class="boxMe"><li>cd <?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_ADMIN']; ?>includes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul></div></p>

<p class="noteBox">Se <i>chmod 706</i> não adiantar, por favor tente <i>chmod 777</i></p>

<form name="install" action="install.php?step=4" method="post">

<?php
    reset($HTTP_POST_VARS);
    while (list($key, $value) = each($HTTP_POST_VARS)) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            echo osc_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          echo osc_draw_hidden_field($key, $value);
        }
      }
    }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancelar"></a></td>
    <td align="center"><input type="image" src="images/button_retry.gif" border="0" alt="Repetir"></td>
  </tr>
</table>

</form>

<?php
  } else {
    $http_host = (($HTTP_HOST) ? $HTTP_HOST : $HTTP_SERVER_VARS['HTTP_HOST']);
?>

<form name="install" action="install.php?step=5" method="post">

<p>The following configuration values will be written to:<br><br><?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_CATALOG']; ?>includes/configure.php<br><?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_ADMIN']; ?>includes/configure.php</p>

<p><b>1. Por favor confirme as informações de seu servidor:</b></p>

<p><b>HTTP Server</b><br><?php echo osc_draw_input_field('HTTP_SERVER', 'http://' . $HTTP_SERVER_VARS['HTTP_HOST']); ?><br>
</p>

<p><b>HTTPS Server</b><br><?php echo osc_draw_input_field('HTTPS_SERVER', 'https://' . $HTTP_SERVER_VARS['HTTP_HOST']); ?><br>
</p>

<p><b>Webserver Root Directory</b><br><?php echo osc_draw_input_field('DIR_FS_DOCUMENT_ROOT'); ?><br>
</p>

<p><b>WWW Catalog Directory</b><br><?php echo osc_draw_input_field('DIR_WS_CATALOG'); ?><br>
</p>

<p><b>WWW Administration Tool Directory</b><br><?php echo osc_draw_input_field('DIR_WS_ADMIN'); ?><br>
</p>

<p><b>2. Por favor confirme as informações de seu banco de dados:</b></p>

<p><b>Database Server</b><br><?php echo osc_draw_input_field('DB_SERVER'); ?><br>
</p>

<p><b>Usuário</b><br><?php echo osc_draw_input_field('DB_SERVER_USERNAME'); ?><br>
</p>

<p><b>Senha</b><br><?php echo osc_draw_input_field('DB_SERVER_PASSWORD'); ?><br>
</p>

<p><b>Banco de Dados</b><br><?php echo osc_draw_input_field('DB_DATABASE'); ?><br>
</p>

<p><?php echo osc_draw_checkbox_field('USE_PCONNECT', true); ?> <b>Ligar Conexão persistente de Banco de Dados</b><br>
</p>

<? //DW --->

osc_draw_hidden_field('STORE_SESSIONS', 'mysql');

/* <p><?php echo osc_draw_radio_field('STORE_SESSIONS', 'files', true); ?> <b>Salvar sessões da loja em arquivo</b><br>
<?php echo osc_draw_radio_field('STORE_SESSIONS', 'mysql'); ?> <b>Salvar sessões da loja em banco de dados.</b><br>
</p> */
//DW <--- ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancelar"></a></td>
    <td align="center"><input type="hidden" name="install[]" value="configure"><input type="image" src="images/button_continue.gif" border="0" alt="Continuar"></td>
  </tr>
</table>

</form>

<?php
  }
?>



