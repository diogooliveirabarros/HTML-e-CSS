<?php
/*
  $Id: categories.php,v 1.15 2002/01/09 10:22:07 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categorias / Produtos');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_GOTO', 'Ir para:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('TABLE_HEADING_ACTION', 'Ação');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Novo Produto em &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preço:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo de Imposto:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Avaliação Média:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantidade:');
define('TEXT_DATE_ADDED', 'Inserido em:');
define('TEXT_DATE_AVAILABLE', 'Data da Disponibilização:');
define('TEXT_LAST_MODIFIED', 'Modificado em:');
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserir uma nova categoria ou produto em<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Para maiores informações visite a <a href="http://%s" target="blank"><u>página</u></a> deste produto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este produto foi inserido em %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este produto estará disponivel em %s.');

define('TEXT_EDIT_INTRO', 'Faça as mudanças necessárias');
define('TEXT_EDIT_CATEGORIES_ID', 'ID da Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Ordem:');

define('TEXT_INFO_COPY_TO_INTRO', 'Escolha a categoria para onde deseja copiar este produto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nova Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Apagar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Apagar Produto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Produto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar para');

define('TEXT_DELETE_CATEGORY_INTRO', 'Tem certeza que deseja apagar esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Tem certeza que deseja apagar permanentemente este produto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ADVERTENCIA:</b> Existem %s categorias que pertencem a esta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTENCIA:</b> Existem %s produtos nesta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Escoha a categoria para onde deseja mover <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Escolha a categoria para onde deseja mover <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> para:');

define('TEXT_NEW_CATEGORY_INTRO', 'Insira as seguinte informação para a nova categoria');
define('TEXT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_SORT_ORDER', 'Ordem:');

define('TEXT_PRODUCTS_STATUS', 'Status dos Produtos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Data que foi disponibilizado:');
define('TEXT_PRODUCT_AVAILABLE', 'Disponível');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Esgotado');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante do produto:');
define('TEXT_PRODUCTS_NAME', 'Nome do Produto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descrição do produto:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantidade:');
define('TEXT_PRODUCTS_MODEL', 'Modelo:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem:');
define('TEXT_PRODUCTS_URL', 'URL do Produto:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sem o http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Preço:');
define('TEXT_PRODUCTS_WEIGHT', 'Peso:');

define('EMPTY_CATEGORY', 'Categoria Vazia');

define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES);
?>
