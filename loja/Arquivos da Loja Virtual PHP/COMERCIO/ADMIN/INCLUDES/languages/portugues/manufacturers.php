<?php
/*
  $Id: manufacturers.php,v 1.8 2001/09/23 18:38:52 dwatkins Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('TOP_BAR_TITLE', 'Fabricantes');
define('HEADING_TITLE', 'Fabricantes');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_MANUFACTURERS', 'Fabricantes');
define('TABLE_HEADING_IMAGE', 'Imagem');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_MANUFACTURERS', 'Fabricantes:');
define('TEXT_DATE_ADDED', 'Inserido em:');
define('TEXT_LAST_MODIFIED', 'Última Modificação:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');

define('TEXT_NEW_INTRO', 'Insira os dados do novo fabricante');
define('TEXT_EDIT_INTRO', 'Faça as mudanças necessárias');
define('TEXT_EDIT_MANUFACTURERS_ID', 'ID do Fabricante:');
define('TEXT_EDIT_MANUFACTURERS_NAME', 'Nome do Fabricante:');
define('TEXT_EDIT_MANUFACTURERS_IMAGE', 'Imagem do Fabricante:');
define('TEXT_EDIT_MANUFACTURERS_URL', 'Fabricante URL:');

define('TEXT_DELETE_INTRO', 'Tem certeza que deseja apagar este fabricante?');
define('TEXT_DELETE_PRODUCTS', 'Quer apagar também todos os produtos deste fabricante? (incluindo comentários, ofertas e lançamentos)');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTENCIA:</b> Existe produtos que pertencem a este fabricante!');

define('ERROR_ACTION', 'HA OCURRIDO UN ERROR! ULTIMA ACCION : ' . $HTTP_GET_VARS['error']);
?>
