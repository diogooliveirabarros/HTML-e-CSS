<?php
/*
osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2002 osCommerce

Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
define('HTTP_SERVER', 'http://www.sualoja.com.br'); // eg, http://localhost - should not be NULL for productive servers
define('HTTPS_SERVER', 'https://www.sualoja.com.br'); // eg, https://localhost - should not be NULL for productive servers
define('ENABLE_SSL', false); // secure webserver for checkout procedure?
define('DIR_WS_CATALOG', '/comercio/'); // absolute path required
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
define('DIR_WS_INCLUDES', 'includes/'); // If "URL fopen wrappers" are enabled in PHP (which they are in the default configuration), this can be a URL instead of a local pathname
define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_PAYMENT_MODULES', DIR_WS_MODULES . 'payment/');
define('DIR_WS_SHIPPING_MODULES', DIR_WS_MODULES . 'shipping/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

// define our database connection
define('DB_SERVER', 'localhost'); // eg, localhost - should not be NULL for productive servers
define('DB_SERVER_USERNAME', 'solojas');
define('DB_SERVER_PASSWORD', 'xxxxx');
define('DB_DATABASE', 'comercio');
define('USE_PCONNECT', false); // use persisstent connections?
define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
?>