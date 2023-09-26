<?php
/*
  $Id: backup.php,v 1.16 2002/01/09 07:57:44 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Cópia de segurança do banco de dados');

define('TABLE_HEADING_TITLE', 'Título');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Tamanho');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nova Cópia de Segurança');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Local');
define('TEXT_INFO_NEW_BACKUP', 'Não interrompa o processo de cópia, que pode durar alguns minutos.');
define('TEXT_INFO_UNPACK', '<br><br>(depois de descomprimir o arquivo)');
define('TEXT_INFO_RESTORE', 'Não interrompa o processo de restauração.<br><br>Quanto maior o seu arquivo, mais este processo irá demorar!<br><br>Se for possível, utilize um cliente de mysql.<br><br>Por exemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Não interrompa o processo de restauração.<br><br>Quanto maior o seu arquivo, mais este processo irá demorar!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'O arquivo para upload deve ser em formato texto.');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Tamanho:');
define('TEXT_INFO_COMPRESSION', 'Comprimir:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_ZIP', 'Usar ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sem comprimir (directamente SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Baixar somente (não guardar no servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Procure realizar este processo em uma conexão segura');
define('TEXT_NO_EXTENSION', 'Sem extensão');
define('TEXT_BACKUP_DIRECTORY', 'Diretório de Backup:');
define('TEXT_LAST_RESTORATION', 'Última Restauração:');
define('TEXT_FORGET', '(<u>forget</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erro: Não existe um diretório de cópias de segurança.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erro: Não há permissão de escrita no diretório de cópias de segurança.');
?>