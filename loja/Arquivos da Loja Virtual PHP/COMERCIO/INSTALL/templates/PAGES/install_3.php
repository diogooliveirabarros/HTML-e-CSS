<?php
/*
  $Id: install_3.php,v 1.2 2002/01/05 06:40:40 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<p><span class="pageHeading"><font color="#9a9a9a">Loja Virtual osCommerce 2.2 Br</font></p>

<p class="pageTitle">Instalação Parte - 3</p>

<p><b>Step 1: Importando a Database</b></p>

<?php
  if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($HTTP_POST_VARS['DB_DATABASE']));

    osc_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

    $db_error = false;
    $script_filename = (($SCRIPT_FILENAME) ? $SCRIPT_FILENAME : $HTTP_SERVER_VARS['SCRIPT_FILENAME']);
    $script_directory = dirname($script_filename);
    $sql_file = $script_directory . '/oscommerce.sql';

    set_time_limit(180);
    osc_db_install($db['DB_DATABASE'], $sql_file);

    if ($db_error) {
?>

<p>Os seguintes erros ocorreram:</p>

<p class="boxme"><?php echo $db_error; ?></p>

<form name="install" action="install.php?step=3" method="post">

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
?>

<p>O Banco de Dados foi importado com sucesso!</p>

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
<?php
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
?>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continuar"></td>
<?php
      } else {
?>
    <td align="center"><a href="index.php"><img src="images/button_continue.gif" border="0" alt="Continuar"></a></td>
<?php
      }
?>
  </tr>
</table>

</form>

<?php
    }
  }
?>