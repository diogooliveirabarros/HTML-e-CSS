<?php
if (strstr($include_file, '..'))
$include_file = str_replace('..', '', $include_file);

if (strstr($include_file, '@'))
$include_file = str_replace('@', '', $include_file);

if (strstr($include_file, ':'))
$include_file = str_replace(':', '', $include_file);

if (isset($include_file) &&
defined('DIR_WS_INCLUDES') &&
!defined($include_file . '__') &&
file_exists($include_file) &&
!isset($HTTP_GET_VARS['include_file']) &&
!isset($HTTP_POST_VARS['include_file']) &&
!isset($HTTP_COOKIE_VARS['include_file']) &&
!isset($HTTP_SESSION_VARS['include_file']) &&
!isset($HTTP_POST_FILES['include_file']) &&
!isset($HTTP_ENV_VARS['include_file'])) {

define($include_file . '__', 1);
include($include_file);
}
?>