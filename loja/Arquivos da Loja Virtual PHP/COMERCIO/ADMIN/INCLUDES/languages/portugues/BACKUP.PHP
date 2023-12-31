<?php
/*
  $Id: backup.php,v 1.16 2002/01/09 07:57:44 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'C�pia de seguran�a do banco de dados');

define('TABLE_HEADING_TITLE', 'T�tulo');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Tamanho');
define('TABLE_HEADING_ACTION', 'A��o');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nova C�pia de Seguran�a');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Local');
define('TEXT_INFO_NEW_BACKUP', 'N�o interrompa o processo de c�pia, que pode durar alguns minutos.');
define('TEXT_INFO_UNPACK', '<br><br>(depois de descomprimir o arquivo)');
define('TEXT_INFO_RESTORE', 'N�o interrompa o processo de restaura��o.<br><br>Quanto maior o seu arquivo, mais este processo ir� demorar!<br><br>Se for poss�vel, utilize um cliente de mysql.<br><br>Por exemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'N�o interrompa o processo de restaura��o.<br><br>Quanto maior o seu arquivo, mais este processo ir� demorar!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'O arquivo para upload deve ser em formato texto.');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Tamanho:');
define('TEXT_INFO_COMPRESSION', 'Comprimir:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_ZIP', 'Usar ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sem comprimir (directamente SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Baixar somente (n�o guardar no servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Procure realizar este processo em uma conex�o segura');
define('TEXT_NO_EXTENSION', 'Sem extens�o');
define('TEXT_BACKUP_DIRECTORY', 'Diret�rio de Backup:');
define('TEXT_LAST_RESTORATION', '�ltima Restaura��o:');
define('TEXT_FORGET', '(<u>forget</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erro: N�o existe um diret�rio de c�pias de seguran�a.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erro: N�o h� permiss�o de escrita no diret�rio de c�pias de seguran�a.');
?>