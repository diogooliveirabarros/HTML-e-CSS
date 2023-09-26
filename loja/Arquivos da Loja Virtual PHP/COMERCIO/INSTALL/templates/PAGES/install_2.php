<?php
/*
  $Id: install_2.php,v 1.2 2002/01/04 01:38:09 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<p><span class="pageHeading"><font color="#9a9a9a">Loja Virtual osCommerce 2.2 Br</font></p>

<p class="pageTitle">Instalação Parte - 2</p>

<p><b>Step 1: Importação do Banco de Dados</b></p>

<?php
  if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($HTTP_POST_VARS['DB_DATABASE']));

    $db_error = false;
    osc_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

    if (!$db_error) {
      osc_db_test_create_db_permission($db['DB_DATABASE']);
    }

    if ($db_error) {
?>

<p>O teste de conexão com o banco de dados não obteve sucesso.</p>

<p>Servidor MySQL retornou a seguinte mensagem de erro:</p>

<p class="boxme"><?php echo $db_error; ?></p>

<p>Por favor clique em <i>Back</i> e insira informações corretas sobre seu banco de dados.</p>

<p>Caso tenha problemas em instalar sua loja virtual contate o nosso suporte.</p>

<form name="install" action="install.php" method="post">

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
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_back.gif" border="0" alt="Back"></td>
  </tr>
</table>

</form>
<?php
    } else {
?>

<p>O teste de conexão com o banco de dados obteve sucesso.</p>

<p>Por favor continue o processo de instalação a fim de importar o arquivo base de sua loja.</p>

<p>Não interrompa o processo ou seu banco de dados pode ser corrompido.</p>

<p>O arquivo que será importado para sua base de dados é: <b><?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_CATALOG'] . 'install/oscommerce.sql'; ?></b>.</p>

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
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continuar"></td>
  </tr>
</table>

</form>


<?php
    }
  }
?>