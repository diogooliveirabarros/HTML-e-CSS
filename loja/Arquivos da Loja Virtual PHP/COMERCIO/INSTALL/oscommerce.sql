# osCommerce, Open Source E-Commerce Solutions
# http://www.oscommerce.com
#
# Database Backup For Artsampa - Graafiti Art Shop
# Copyright (c) 2003 Paulo Cezar
#

drop table if exists address_book;
create table address_book (
  customers_id int(5) default '0' not null ,
  address_book_id int(5) default '1' not null ,
  entry_gender char(1) not null ,
  entry_company varchar(32) ,
  entry_firstname varchar(32) not null ,
  entry_lastname varchar(32) not null ,
  entry_street_address varchar(64) not null ,
  entry_suburb varchar(32) ,
  entry_postcode varchar(10) not null ,
  entry_city varchar(32) not null ,
  entry_state varchar(32) ,
  entry_country_id int(5) default '0' not null ,
  entry_zone_id int(5) default '0' not null ,
  PRIMARY KEY (address_book_id, customers_id)
);



drop table if exists address_format;
create table address_format (
  address_format_id int(5) not null auto_increment,
  address_format varchar(128) not null ,
  address_summary varchar(48) not null ,
  PRIMARY KEY (address_format_id)
);

insert into address_format (address_format_id, address_format, address_summary) values ('1', '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

drop table if exists banners;
create table banners (
  banners_id int(5) not null auto_increment,
  banners_title varchar(64) not null ,
  banners_url varchar(64) not null ,
  banners_image varchar(64) not null ,
  banners_group varchar(10) not null ,
  banners_html_text text ,
  expires_impressions int(7) default '0' ,
  expires_date datetime ,
  date_scheduled datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_status_change datetime ,
  status int(1) default '1' ,
  PRIMARY KEY (banners_id)
);

insert into banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('1', 'osCommerce', 'http://www.oscommerce.com', 'banners/oscommerce.gif', '468x50', '', '0', NULL, NULL, '2002-01-13 20:52:36', NULL, '1');

drop table if exists banners_history;
create table banners_history (
  banners_history_id int(5) not null auto_increment,
  banners_id int(5) default '0' not null ,
  banners_shown int(5) default '0' not null ,
  banners_clicked int(5) default '0' not null ,
  banners_history_date datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (banners_history_id)
);

insert into banners_history (banners_history_id, banners_id, banners_shown, banners_clicked, banners_history_date) values ('1', '1', '10', '1', '2002-01-13 20:57:53');

drop table if exists categories;
create table categories (
  categories_id int(5) not null auto_increment,
  categories_image varchar(64) ,
  parent_id int(5) default '0' not null ,
  sort_order int(3) ,
  date_added datetime ,
  last_modified datetime ,
  status int(1) default '1' ,
  PRIMARY KEY (categories_id),
  KEY idx_categories_parent_id (parent_id),
  KEY idx_parent_id (parent_id),
  KEY idx_sort_order (sort_order)
);

drop table if exists categories_description;
create table categories_description (
  categories_id int(5) default '0' not null ,
  language_id int(5) default '1' not null ,
  categories_name varchar(32) not null ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
);

drop table if exists configuration;
create table configuration (
  configuration_id int(5) not null auto_increment,
  configuration_title varchar(64) not null ,
  configuration_key varchar(64) not null ,
  configuration_value varchar(255) not null ,
  configuration_description varchar(255) not null ,
  configuration_group_id int(5) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id),
  KEY idx_configuration_key (configuration_key),
  KEY idx_configuration_value (configuration_value),
  KEY idx_sort_order (sort_order),
  KEY idx_date_added (date_added)
);

insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', 'Nome da Loja', 'STORE_NAME', 'Artsampa - Graafiti Art Shop', 'O nome de sua loja', '1', '1', '2003-08-16 15:53:19', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', 'Nome do Proprietário', 'STORE_OWNER', 'Paulo Cezar', 'Nome do Proprietário da Loja', '1', '2', '2003-05-15 22:09:38', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'E-Mail', 'STORE_OWNER_EMAIL_ADDRESS', 'artsampa@artsampa.com', 'E-mail do proprietário', '1', '3', '2003-05-15 22:10:13', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'E-Mail From', 'EMAIL_FROM', 'artsampa@artsampa.com', 'E-mail de resposta ao enviar informativos', '1', '4', '2003-05-15 22:10:33', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', 'Usar MIME HTML quando enviar e-mails', 'EMAIL_USE_HTML', 'false', 'Enviar e-mails em formato HTML', '1', '5', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', 'País', 'STORE_COUNTRY', '30', 'País onde a loja está localizada', '1', '6', '2002-01-13 22:45:30', '2002-01-13 20:52:36', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('158', 'Estado', 'STORE_ZONE', '130', 'Estado onde a loja está localizada', '1', '7', '2003-05-15 22:11:04', '2002-01-13 20:52:36', 'tep_get_zone_name', 'tep_cfg_pull_down_zone_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', 'Avisar pedidos por e-mail', 'SEND_EXTRA_ORDER_EMAILS_TO', 'Compra no Artshop<artsampa@artsampa.com>', 'Enviar aviso para o e-mail da loja quando pedidos forem realizados: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '1', '10', '2003-05-15 22:11:50', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', 'Enviar Emails', 'SEND_EMAILS', 'true', 'Enviar Emails', '1', '12', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', 'Mostrar cesta de compras após inserir produto', 'DISPLAY_CART', 'true', 'Mostrar cesta de compras após inserir produto (ou retornar a página de origem)', '1', '13', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', 'Permitir que visitante envie página para amigo', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'true', 'Permitir que visitante envie página para amigo', '1', '14', '2003-05-09 11:40:34', '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', 'Verificar Emails através do DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'true', 'Verificar Emails através do DNS', '1', '15', '2003-05-13 19:18:37', '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('137', 'Titulo do Site', 'DW_TITULO', 'Artsampa - Graffiti Art Shop', 'Título do seu site', '1', '18', '2003-08-16 15:55:20', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('141', 'Texto Inicial do Site', 'DW_TEXTO_ADM', '', 'Digite aqui o texto a ser exibido na página inicial do site<br>Importante: este campo é limitado a 255 caracteres. Para definir um texto inicial com mais de 255 caracteres vá até Ferramentas-Editar Textos-portugues.php e preencha no local indicado.', '1', '19', '2003-05-15 22:12:46', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('138', 'Logotipo', 'DW_LOGO', 'lojapadrao.gif', 'Logotipo da sua loja. Antes de alterar este valor, faça o upload da imagem para /loja/images/', '1', '20', '2003-05-15 22:13:17', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('139', 'Texto do Logotipo', 'DW_ALT_LOGO', 'Artsampa - 2003', 'Texto a ser exibido quando o mouse estiver sobre o logotipo da loja', '1', '21', '2003-08-16 15:58:36', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('140', 'Permitir Comentários', 'DW_PERMITIR_COMENTARIOS', 'false', 'Permitir que clientes publiquem comentários sobre seus produtos', '1', '22', '2003-05-15 22:16:09', '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('142', 'Exibir campo Idiomas', 'DW_PERMITIR_IDIOMAS', 'true', 'Exibir a caixa que indica os idiomas disponíveis para o site.', '1', '23', '2003-08-16 15:55:52', '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('143', 'Exibir campo Moedas', 'DW_PERMITIR_MOEDAS', 'true', 'Exibir a caixa que indica as moedas disponíveis para o site', '1', '24', '2003-08-16 15:55:59', '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('144', 'Texto do Rodapé', 'DW_FOOTER', 'Copyright © 2000-2003 Artsampa S/A - P.O Box Nº 15018 Cep: 01519-970 S&atilde;o Paulo - SP - Brasil.', 'Texto do Rodapé da Loja Virtual', '1', '25', '2003-08-16 15:57:29', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', 'Primeiro nome', 'ENTRY_FIRST_NAME_MIN_LENGTH', '3', 'Quantidade mínima de letras para o primeiro nome', '2', '1', '2003-05-15 22:18:41', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', 'Sobrenome', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Quantidade mínima de letras para o sobrenome', '2', '2', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', 'Data de Nascimento', 'ENTRY_DOB_MIN_LENGTH', '10', 'Quantidade mínima de letras para a data', '2', '3', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', 'E-Mail', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Quantidade mínima de letras para o e-mail', '2', '4', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', 'Endereço', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Quantidade mínima de letras para o endereço', '2', '5', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'Empresa', 'ENTRY_COMPANY_LENGTH', '2', 'Quantidade mínima de letras para o nome da Empresa', '2', '6', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', 'CEP', 'ENTRY_POSTCODE_MIN_LENGTH', '5', 'Quantidade mínima de letras para o CEP', '2', '7', '2003-05-15 22:19:36', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', 'Cidade', 'ENTRY_CITY_MIN_LENGTH', '3', 'Quantidade mínima de letras para a Cidade', '2', '8', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', 'País', 'ENTRY_STATE_MIN_LENGTH', '4', 'Quantidade mínima de letras para o país', '2', '9', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', 'Número do Telefone', 'ENTRY_TELEPHONE_MIN_LENGTH', '6', 'Quantidade mínima de letras para o telefone', '2', '10', '2003-05-15 22:20:00', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', 'Senha', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Quantidade mínima de letras para a senha', '2', '11', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', 'Comentários', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Quantidade mínima de letras em um comentário', '2', '14', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', 'Mais Vendidos', 'MIN_DISPLAY_BESTSELLERS', '1', 'Número mínimo de mais vendidos para exibição', '2', '15', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', 'Também Compraram', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Número mínimo de produtos para exibição em \'Clientes também Compraram\' box', '2', '16', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', 'Livro de Endereços', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Número máximo de endereços de entrega que um cliente pode ter', '3', '1', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', 'Resultado da Busca', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Número máximo de produtos a serem listados', '3', '2', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Número máximo de links em uma página', '3', '3', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', 'Ofertas', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Máximo número de ofertas a serem exibidas', '3', '4', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', 'Novidades', 'MAX_DISPLAY_NEW_PRODUCTS', '6', 'Máximo número de novos produtos a serem exibidos em uma categoria', '3', '5', '2003-08-21 12:10:05', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('38', 'Lançamentos', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Máximo números de lançamentos a serem exibidos', '3', '6', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('39', 'Lista de Fabricantes', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Usado no box dos fabricantes; quando o número de fabricantes exceder este número o menu passará a ser de seleção', '3', '7', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('40', 'Tamanho da Caixa de seleção de fabricantes', 'MAX_MANUFACTURERS_LIST', '1', 'Usado no box dos fabricantes; quando o valor é \'1\' a drop-down list é utilizada no box dos fabricantes.', '3', '7', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('41', 'Tamanho máximo do nome do Fabricante', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Usado no box dos fabricantes; máximo número de letras do nome do fabricante a ser exibido', '3', '8', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('42', 'Comentários', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Máximo número de comentários a serem exibidos', '3', '9', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('43', 'Seleção randômica de comentários', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'Número de comentários que serão utilizados na seleção', '3', '10', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('44', 'Seleção Randômica de Novidades', 'MAX_RANDOM_SELECT_NEW', '20', 'Quantos registros serão utilizados para selecionar novidades a serem exibidas', '3', '11', '2003-08-20 18:46:29', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('45', 'Seleção Randômica de Ofertas', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'Quantos registros serão utilizados para selecionar ofertas a serem exibidas', '3', '12', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('46', 'Categorias a serem listadas', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '10', 'Número de categorias a serem listadas por fila', '3', '13', '2003-05-15 22:21:00', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('47', 'Lista de Novos Produtos', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Número máximo de produtos a serem listados na página de novos produtos', '3', '14', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('48', 'Mais Vendidos', 'MAX_DISPLAY_BESTSELLERS', '5', 'Máximo número de mais vendidos a serem exibidos', '3', '15', '2003-08-20 18:45:25', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('49', 'Também compraram', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Máximo número de indicações a serem exibidos no box \'Clientes também compraram\' box', '3', '16', '2003-05-15 22:21:17', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('50', 'Largura da Imagem Pequena', 'SMALL_IMAGE_WIDTH', '', 'Em pixels', '4', '1', '2003-05-15 22:21:29', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('51', 'Altura da Imagem Pequena', 'SMALL_IMAGE_HEIGHT', '', 'Em pixels', '4', '2', '2003-05-15 22:21:42', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('52', 'Largura da Imagem do Cabeçalho', 'HEADING_IMAGE_WIDTH', '', 'Em pixels', '4', '3', '2003-05-15 22:21:52', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('53', 'Altura da Imagem do Cabeçalho', 'HEADING_IMAGE_HEIGHT', '', 'Em pixels', '4', '4', '2003-05-15 22:22:03', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('54', 'Largura da Imagem da Subcategoria', 'SUBCATEGORY_IMAGE_WIDTH', '', 'Em pixels', '4', '5', '2003-05-15 22:22:17', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('55', 'Altura da Imagem da Subcategoria', 'SUBCATEGORY_IMAGE_HEIGHT', '', 'Em pixels', '4', '6', '2003-05-15 22:22:28', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('56', 'Calcular tamanho da Imagem', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calcula o tamanho da imagem?', '4', '7', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('57', 'Imagem Obrigatória', 'IMAGE_REQUIRED', 'false', 'Abilitar inserção obrigatória de imagens.', '4', '8', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('58', 'Módulos instalados', 'MODULE_PAYMENT_INSTALLED', 'bradesco.php;mail.php;mailorder.php', 'Lista os arquivos de módulos de pagamento separados por um ponto e virgula. Esta listagem é automática. (Exemplo: cc.php;cod.php;paypal.php)', '6', '0', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('59', 'Módulos instalados', 'MODULE_SHIPPING_INSTALLED', 'remessa_internacional_alemanha.php;remessa_internacional_canada.php;remessa_internacional_usa.php;remessa_nacional.php;remessa_nacional_2.php', 'Lista os arquivos de módulos de frete separados por um ponto e virgula. Esta listagem é automática. (Example: ups.php;flat.php;item.php)', '6', '0', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('63', 'Moeda Default', 'DEFAULT_CURRENCY', 'BR', 'Moeda Default', '6', '0', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('64', 'Linguagem Default', 'DEFAULT_LANGUAGE', 'pt', 'Linguagem Default', '6', '0', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('65', 'Código do País', 'STORE_ORIGIN_COUNTRY', 'NONE', 'Entre o &quot;ISO 3166&quot; código do país onde se localiza a sua loja.  Para saber o código de seu país, visite a  <A HREF=\"http://www.din.de/gremien/nas/nabd/iso3166ma/codlstp1/index.html\" TARGET=\"_blank\">ISO 3166 Maintenance Agency</A>.', '7', '1', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('66', 'CEP', 'STORE_ORIGIN_ZIP', 'NONE', 'Entre o CEP de sua Loja.', '7', '2', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('67', 'Entre o peso máximo do pacote que irá entregar', 'SHIPPING_MAX_WEIGHT', '1', 'Limite máximo de peso.', '7', '3', '2003-05-15 22:22:47', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('68', 'Peso Normal dos Pacotes.', 'SHIPPING_BOX_WEIGHT', '0.500', 'Qual é o peso normal dos pacotes que costuma entregar?', '7', '4', '2003-05-15 22:23:10', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('69', 'Pacotes grandes Incrementar porcentagem.', 'SHIPPING_BOX_PADDING', '0', 'For 10% enter 10', '7', '5', '2003-05-15 22:23:24', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('70', 'Taxa extra', 'SHIPPING_HANDLING', '0.00', 'Taxa extra de frete a ser embutida no cálculo.', '7', '6', '2003-05-15 22:23:41', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('71', 'Mostrar Imagem do Produto', 'PRODUCT_LIST_IMAGE', '1', 'Escolha 1 para sim ou 0 para não', '8', '1', '2003-04-13 22:33:02', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('72', 'Mostrar nome dos Fabricantes', 'PRODUCT_LIST_MANUFACTURER', '0', 'Escolha 1 para sim ou 0 para não', '8', '2', '2003-05-15 22:24:15', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('73', 'Mostrar modelo dos produtos', 'PRODUCT_LIST_MODEL', '0', 'Escolha 1 para sim ou 0 para não', '8', '3', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('74', 'Mostrar nome dos produtos', 'PRODUCT_LIST_NAME', '1', 'Escolha 1 para sim ou 0 para não', '8', '4', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('75', 'Exibir preços dos produtos', 'PRODUCT_LIST_PRICE', '1', 'Escolha 1 para sim ou 0 para não', '8', '5', '2003-04-13 22:32:09', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('76', 'Mostrar quantidade dos produtos', 'PRODUCT_LIST_QUANTITY', '0', 'Escolha 1 para sim ou 0 para não', '8', '6', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('77', 'Mostrar peso dos produtos', 'PRODUCT_LIST_WEIGHT', '0', 'Escolha 1 para sim ou 0 para não', '8', '7', '2003-05-15 22:24:37', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('78', 'Mostrar coluna Compre Agora', 'PRODUCT_LIST_BUY_NOW', '1', 'Escolha 1 para sim ou 0 para não', '8', '8', '2003-04-13 22:32:49', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('79', 'Exibir filtros categorias/fabricantes (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Escolha 1 para sim ou 0 para não', '8', '9', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('80', 'Escolha a localização dos botões Anterior/Próxima (1-topo, 2-em', 'PREV_NEXT_BAR_LOCATION', '2', 'Escolha a localização dos botões Anterior/Próxima (1-topo, 2-em baixo, 3-nos dois lugares)', '8', '10', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('81', 'Checar Estoque', 'STOCK_CHECK', 'true', 'Ativar checagem do estoque', '9', '1', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('82', 'Subtrair do Estoque', 'STOCK_LIMITED', 'true', 'Subtrair produto do estoque quando for realizado um pedido', '9', '2', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('83', 'Permitir ir ao caixa', 'STOCK_ALLOW_CHECKOUT', 'true', 'Permitir cliente ir ao caixa mesmo quando o estoque for insuficiente', '9', '3', NULL, '2002-01-13 20:52:36', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('84', 'Marcar produtos fora de estoque', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Exibir *** quando o produto não estiver disponível em estoque', '9', '4', NULL, '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('85', 'Estoque baixo', 'STOCK_REORDER_LEVEL', '1', 'Defina a quantidade crítica do seu estoque', '9', '5', '2003-05-15 22:24:56', '2002-01-13 20:52:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('96', 'Taxa Extra', 'MODULE_SHIPPING_ZONES_HANDLING', '0', 'Taxa extra para este método, ligar ou desligar', '6', '0', NULL, '2002-01-13 21:27:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('95', 'Ligar ou desligar este método', 'MODULE_SHIPPING_ZONES_STATUS', '1', 'Vai utilizar os serviços do SEDEX para enviar mercadorias?', '6', '0', NULL, '2002-01-13 21:27:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('116', 'Taxa Extra', 'MODULE_SHIPPING_NORMAL_HANDLING', '0', 'Taxa extra para este método, ligar ou desligar', '6', '0', NULL, '2002-01-13 21:27:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('145', 'Background', 'DW_BGCOLOR', '#FFFFFF', 'Background (Padrão: #FFFFFF)', '10', '1', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('146', 'Cabeçalho', 'DW_TOPBGCOLOR', '#FFFFFF', 'Cor do Cabeçalho (Padrão: #FFFFFF)', '10', '2', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('147', 'Barra Superior de Navegação', 'DW_TOPBARCOLOR', '#bbc3d3', 'Cor da Barra Superior de Navegação (Padrão: #bbc3d3)', '10', '3', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('148', 'Barra Inferior de Navegação', 'DW_FOOTERBARCOLOR', '#bbc3d3', 'Cor da Barra Inferior de Navegação (Padrão: #bbc3d3)', '10', '4', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('149', 'Cabeçalho das Caixas de Texto', 'DW_INFOBOXTOPCOLOR', '#bbc3d3', 'Cor do Cabeçalho das Caixas de Texto (Padrão: #bbc3d3)', '10', '5', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('150', 'Caixas de Texto', 'DW_INFOBOXCOLOR', '#f8f8f9', 'Cor das Caixas de Texto (Padrão: #f8f8f9)', '10', '6', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('151', 'Título das Listagens', 'DW_LISTTOPBGCOLOR', '#d2e9fb', 'Cor do Título das Listagens (Padrão: #d2e9fb)', '10', '7', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('152', 'Texto', 'DW_FONTCOLOR', '#000000', 'Cor do Texto (Padrão: #000000)', '10', '8', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('153', 'Links', 'DW_LINKCOLOR', '#000000', 'Cor dos Links (Padrão: #000000)', '10', '9', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('154', 'Links (onMouseOver)', 'DW_LINKOVERCOLOR', '#AABBDD', 'Cor dos Links quando o mouse estiver sobre eles (Padrão: #AABBDD)', '10', '10', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('155', 'Texto da Barra Superior de Navegação', 'DW_TOPFONTCOLOR', '#FFFFFF', 'Cor do Texto da Barra Superior de Navegação (Padrão: #FFFFFF)', '10', '11', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('156', 'Texto da Barra Inferior de Navegação', 'DW_FOOTERFONTCOLOR', '#FFFFFF', 'Cor do Texto da Barra Inferior de Navegação (Padrão: #FFFFFF)', '10', '12', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('157', 'Texto das Caixas de Texto', 'DW_INFOBOXTEXTCOLOR', '#FFFFFF', 'Cor do Texto das Caixas de Texto (Padrão: #FFFFFF)', '10', '13', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('159', 'Texto do Título das Listagens', 'DW_LISTTOPFONTCOLOR', '#000000', 'Cor do Texto do Título das Listagens (Padrão: #000000)', '10', '14', NULL, '2002-01-13 21:27:58', 'dw_updatecolors', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('178', 'ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA1', 'PR, RJ', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('161', 'ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA1', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('162', 'ZONA 02 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA2', 'MG, SC', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('163', 'ZONA 02 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA2', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('164', 'ZONA 03 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA3', 'DF, ES, MS, RS', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('165', 'ZONA 03 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA3', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('166', 'ZONA 04 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA4', 'BA, GO, MT, TO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('167', 'ZONA 04 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA4', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('168', 'ZONA 05 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA5', 'AL, SE', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('169', 'ZONA 05 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA5', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('170', 'ZONA 06 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA6', 'PB, PE, PI, RO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('171', 'ZONA 06 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA6', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('172', 'ZONA 07 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA7', 'AC, AP, AM, CE, MA, PA, RN', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('173', 'ZONA 07 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA7', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('174', 'ZONA 08 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA8', 'RR', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('175', 'ZONA 08 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA8', '1:7.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('176', 'ZONA 09 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_UF_ZONA9', 'SP', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('177', 'ZONA 09 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_ZONA9', '1:6.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('269', 'Habilitar Remessa Nacional', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_STATUS', '1', 'Habilitar Remessa Nacional? (0=NÃO 1=SIM)?', '6', '0', NULL, '2003-05-15 22:37:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('181', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_NACIONAL_METODO', 'Sedex', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('290', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_METODO', 'Encomenda Normal / Registrada', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-05-15 22:37:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('182', 'Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_NACIONAL_2_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', NULL, '2003-04-11 16:05:01', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('291', 'Habilitar Remessa Nacional', 'MODULE_SHIPPING_REMESSA_NACIONAL_STATUS', '1', 'Habilitar Remessa Nacional? (0=NÃO 1=SIM)?', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('292', 'ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA1', 'PR, RJ', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('293', 'ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA1', '1:14.0,1:14.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('294', 'ZONA 02 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA2', 'MG, SC', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('295', 'ZONA 02 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA2', '1:13.0,1:13.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('296', 'ZONA 03 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA3', 'DF, ES, MS, RS', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('297', 'ZONA 03 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA3', '1:17.0,1:17.0,1:17.0,1:17.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('298', 'ZONA 04 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA4', 'BA, GO, MT, TO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('299', 'ZONA 04 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA4', '1:21.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('300', 'ZONA 05 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA5', 'AL, SE', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('301', 'ZONA 05 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA5', '1:23.0,1:23.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('302', 'ZONA 06 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA6', 'PB, PE, PI, RO', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('303', 'ZONA 06 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA6', '1:27.0,1:27.0,1:27.0,1:27.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('304', 'ZONA 07 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA7', 'AC, AP, AM, CE, MA, PA, RN', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('305', 'ZONA 07 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA7', '1:30.0,1:30.0,1:30.0,1:30.0,1:30.0,1:30.0,1:30.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('306', 'ZONA 08 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA8', 'RR', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('307', 'ZONA 08 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA8', '1:34.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('308', 'ZONA 09 (Estados)', 'MODULE_SHIPPING_REMESSA_NACIONAL_UF_ZONA9', 'SP', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('309', 'ZONA 09 (Tarifa)', 'MODULE_SHIPPING_REMESSA_NACIONAL_ZONA9', '1:8.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('310', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_NACIONAL_METODO', 'Sedex', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('311', 'Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_NACIONAL_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', NULL, '2003-05-20 22:23:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('313', 'Habilitar Remessa Internacional USA', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_USA_STATUS', '1', 'Habilitar Remessa Internacional Usa? (0=NÃO 1=SIM)?', '6', '0', NULL, '2003-08-18 16:20:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('314', 'ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_USA_UF_ZONA1', 'AL, AK, AS, AZ, AR, AF, AA, AC, AE, AM, AP, CA, CO, CT, DE, DC, FM, FL, GA, GU, HI, ID, IL, IN, IA, KS, KY, LA, ME, MH, MD, MA, MI, MN, MS, MO, MT, NE, NV, NH, NJ, NM, NY, NC, ND, MP, OH, OK, OR, PW, PA, PR, RI, SC, SD, TN, TX, UT, VT, VI, VA, WA, WV, WI,', 'Listagem da sigla dos países que compõem esta zona.', '6', '0', NULL, '2003-08-18 16:20:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('315', 'ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_USA_ZONA1', '1:20.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-08-18 16:20:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('316', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_USA_METODO', 'Mail Internacional', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-08-18 16:20:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('317', 'Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_USA_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', NULL, '2003-08-18 16:20:28', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('319', 'World Mail Order? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_MAILORDER_STATUS', '1', '', '6', '3', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('320', 'Mensagem Opções de Pagamento', 'MODULE_PAYMENT_MAILORDER_TEXT_SELECTION', '', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '4', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('321', 'Mensagem para o Cliente', 'MODULE_PAYMENT_MAILORDER_TEXT_CONFIRMATION', 'All shipping pay in US dollar USD, to hide the money Your request will be a shipping when the value of the request be received For more inf. email to: artsampa@artsampa.com.  The price of the shipping (delivery) for this country is $20,00.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '5', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('322', 'Titular da Conta', 'MODULE_PAYMENT_MAILORDER_TITULAR', 'Send To: Artsampa S/A.', 'Titular da Conta', '6', '3', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('323', 'Caixa Postal', 'MODULE_PAYMENT_MAILORDER_CPOSTAL', '15018', '15018', '6', '4', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('324', 'CEP', 'MODULE_PAYMENT_MAILORDER_CEP', '01519-970', 'CEP', '6', '5', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('325', 'Estado', 'MODULE_PAYMENT_MAILORDER_ESTADO', 'São Paulo SP - Brazil', 'Estado', '6', '2', NULL, '2003-08-18 18:36:50', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('327', 'Habilitar Remessa Internacional Canadá', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_CANADA_STATUS', '1', 'Habilitar Remessa Internacional Usa? (0=NÃO 1=SIM)?', '6', '0', NULL, '2003-08-20 22:45:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('328', 'ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_CANADA_UF_ZONA1', 'AB, BC, MB, NF, NB, NS, NT, NU, ON, PE, QC, SK, YT', 'Listagem da sigla dos países que compõem esta zona.', '6', '0', NULL, '2003-08-20 22:45:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('329', 'ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_CANADA_ZONA1', '1:20.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-08-20 22:45:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('330', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_CANADA_METODO', 'Mail Internacional', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-08-20 22:45:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('331', 'Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_CANADA_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', NULL, '2003-08-20 22:45:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('332', 'Habilitar Remessa Internacional Alemanha', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_ALEMANHA_STATUS', '1', 'Habilitar Remessa Internacional Usa? (0=NÃO 1=SIM)?', '6', '0', NULL, '2003-08-27 21:28:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('333', 'ZONA 01 (Estados)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_ALEMANHA_UF_ZONA1', 'NDS, BAW, BAY, BER, BRG, BRE, HAM, HES, MEC, NRW, RHE, SAR, SAS, SAC, SCN, THE', 'Listagem da sigla dos países que compõem esta zona.', '6', '0', NULL, '2003-08-27 21:28:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('334', 'ZONA 01 (Tarifa)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_ALEMANHA_ZONA1', '1:30.0', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', NULL, '2003-08-27 21:28:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('335', 'Forma de Envio', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_ALEMANHA_METODO', 'Mail internacional', 'Serviço a ser utilizado na remessa', '6', '0', NULL, '2003-08-27 21:28:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('336', 'Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_REMESSA_INTERNACIONAL_ALEMANHA_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', NULL, '2003-08-27 21:28:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('354', 'Mensagem para o Cliente', 'MODULE_PAYMENT_MAIL_TEXT_CONFIRMATION', 'Shipping pay in Euro, to hide the money Your request will be a shipping when the value of the request be received For more inf. email to: artsampa@artsampa.com. The shipping (delivery) for this country is €30,00.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '5', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('353', 'Mensagem Opções de Pagamento', 'MODULE_PAYMENT_MAIL_TEXT_SELECTION', 'Mail Order', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '4', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('355', 'Titular da Conta', 'MODULE_PAYMENT_MAIL_TITULAR', 'Send To: Artsampa S/A.', 'Titular da Conta', '6', '3', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('356', 'Caixa Postal', 'MODULE_PAYMENT_MAIL_CPOSTAL', '15018', 'C. Postal', '6', '4', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('357', 'CEP', 'MODULE_PAYMENT_MAIL_CEP', '01519-970', 'CEP', '6', '5', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('358', 'Estado', 'MODULE_PAYMENT_MAIL_ESTADO', 'São Paulo SP - Brazil', 'Estado', '6', '2', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('352', 'World Mail Order? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_MAIL_STATUS', '1', '', '6', '3', NULL, '2003-08-27 23:03:10', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('360', 'Aceitar Depósito/Transferência Bco Bradesco? (0=NÃO 1=SIM)', 'MODULE_PAYMENT_BRADESCO_STATUS', '1', '', '6', '3', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('361', 'Mensagem (Opções de Pagamento)', 'MODULE_PAYMENT_BRADESCO_TEXT_SELECTION', 'Depósito/Transferência Bancária (Bco Bradesco)', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '4', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('362', 'Mensagem (Instruções para o Cliente)', 'MODULE_PAYMENT_BRADESCO_TEXT_CONFIRMATION', 'Seu pedido será enviado quando confirmado o pagamento. Para agilizar o processo, envie um e-mail para: artsampa@artsampa.com, com o num. do seu pedido e a data do depósito.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '5', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('363', 'Titular da Conta Bancária', 'MODULE_PAYMENT_BRADESCO_TITULAR', 'Paulo Cezar.', 'Titular da Conta Bancária', '6', '3', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('364', 'Nome do Banco', 'MODULE_PAYMENT_BRADESCO_BANCO', 'Bco Bradesco', 'Nome do Banco', '6', '4', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('365', 'Agência', 'MODULE_PAYMENT_BRADESCO_AGENCIA', '2036-2', 'Agência', '6', '5', NULL, '2003-08-28 16:49:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('366', 'Conta Corrente', 'MODULE_PAYMENT_BRADESCO_CC', '7584-1', 'Conta Corrente', '6', '2', NULL, '2003-08-28 16:49:49', NULL, NULL);

drop table if exists configuration_group;
create table configuration_group (
  configuration_group_id int(5) not null auto_increment,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
);

insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'Sua Loja', 'Informações gerais sobre a loja', '1', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'Valores mínimos', 'Valores mínimos para as funções / dados', '2', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'Valores máximos', 'Valores máximos para as funções / dados', '3', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'Imagens', 'Parâmetros das Imagens', '4', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('6', 'Opções de Módulos', 'Livre de Configuração', '6', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('7', 'Entrega/Pacotes', 'Opções de entrega de sua loja', '7', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('8', 'Apresentação dos Produtos', 'Opções de configuração para apresentação dos produtos', '8', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('9', 'Estoque', 'Estoque opções', '9', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('10', 'Cores', 'Cores da Loja', '10', '1');

drop table if exists counter;
create table counter (
  startdate char(8) ,
  counter int(12) ,
  KEY idx_counter (counter),
  KEY idx_startdate (startdate)
);

insert into counter (startdate, counter) values ('20030519', '1');

drop table if exists counter_history;
create table counter_history (
  month char(8) ,
  counter int(12) 
);


drop table if exists countries;
create table countries (
  countries_id int(5) not null auto_increment,
  countries_name varchar(64) not null ,
  countries_iso_code_2 char(2) not null ,
  countries_iso_code_3 char(3) not null ,
  address_format_id int(5) default '0' not null ,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('1', 'Afghanistan', 'AF', 'AFG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('2', 'Albania', 'AL', 'ALB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('3', 'Algeria', 'DZ', 'DZA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('4', 'American Samoa', 'AS', 'ASM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('5', 'Andorra', 'AD', 'AND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('6', 'Angola', 'AO', 'AGO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('7', 'Anguilla', 'AI', 'AIA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('8', 'Antarctica', 'AQ', 'ATA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('9', 'Antigua and Barbuda', 'AG', 'ATG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('10', 'Argentina', 'AR', 'ARG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('11', 'Armenia', 'AM', 'ARM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('12', 'Aruba', 'AW', 'ABW', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('13', 'Australia', 'AU', 'AUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('14', 'Austria', 'AT', 'AUT', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('15', 'Azerbaijan', 'AZ', 'AZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('16', 'Bahamas', 'BS', 'BHS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('17', 'Bahrain', 'BH', 'BHR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('18', 'Bangladesh', 'BD', 'BGD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('19', 'Barbados', 'BB', 'BRB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('20', 'Belarus', 'BY', 'BLR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('21', 'Belgium', 'BE', 'BEL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('22', 'Belize', 'BZ', 'BLZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('23', 'Benin', 'BJ', 'BEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('24', 'Bermuda', 'BM', 'BMU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('25', 'Bhutan', 'BT', 'BTN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('26', 'Bolivia', 'BO', 'BOL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('27', 'Bosnia and Herzegowina', 'BA', 'BIH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('28', 'Botswana', 'BW', 'BWA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('29', 'Bouvet Island', 'BV', 'BVT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('30', 'Brazil', 'BR', 'BRA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('32', 'Brunei Darussalam', 'BN', 'BRN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('33', 'Bulgaria', 'BG', 'BGR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('34', 'Burkina Faso', 'BF', 'BFA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('35', 'Burundi', 'BI', 'BDI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('36', 'Cambodia', 'KH', 'KHM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('37', 'Cameroon', 'CM', 'CMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('38', 'Canada', 'CA', 'CAN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('39', 'Cape Verde', 'CV', 'CPV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('40', 'Cayman Islands', 'KY', 'CYM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('41', 'Central African Republic', 'CF', 'CAF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('42', 'Chad', 'TD', 'TCD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('43', 'Chile', 'CL', 'CHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('44', 'China', 'CN', 'CHN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('45', 'Christmas Island', 'CX', 'CXR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('46', 'Cocos (Keeling) Islands', 'CC', 'CCK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('47', 'Colombia', 'CO', 'COL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('48', 'Comoros', 'KM', 'COM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('49', 'Congo', 'CG', 'COG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('50', 'Cook Islands', 'CK', 'COK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('51', 'Costa Rica', 'CR', 'CRI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('52', 'Cote D\'Ivoire', 'CI', 'CIV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('53', 'Croatia', 'HR', 'HRV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('54', 'Cuba', 'CU', 'CUB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('55', 'Cyprus', 'CY', 'CYP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('56', 'Czech Republic', 'CZ', 'CZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('57', 'Denmark', 'DK', 'DNK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('58', 'Djibouti', 'DJ', 'DJI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('59', 'Dominica', 'DM', 'DMA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('60', 'Dominican Republic', 'DO', 'DOM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('61', 'East Timor', 'TP', 'TMP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('62', 'Ecuador', 'EC', 'ECU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('63', 'Egypt', 'EG', 'EGY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('64', 'El Salvador', 'SV', 'SLV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('66', 'Eritrea', 'ER', 'ERI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('67', 'Estonia', 'EE', 'EST', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('68', 'Ethiopia', 'ET', 'ETH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('69', 'Falkland Islands (Malvinas)', 'FK', 'FLK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('70', 'Faroe Islands', 'FO', 'FRO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('71', 'Fiji', 'FJ', 'FJI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('72', 'Finland', 'FI', 'FIN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('73', 'France', 'FR', 'FRA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('74', 'France, Metropolitan', 'FX', 'FXX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('75', 'French Guiana', 'GF', 'GUF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('76', 'French Polynesia', 'PF', 'PYF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('77', 'French Southern Territories', 'TF', 'ATF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('78', 'Gabon', 'GA', 'GAB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('79', 'Gambia', 'GM', 'GMB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('80', 'Georgia', 'GE', 'GEO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('81', 'Germany', 'DE', 'DEU', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('82', 'Ghana', 'GH', 'GHA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('83', 'Gibraltar', 'GI', 'GIB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('84', 'Greece', 'GR', 'GRC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('85', 'Greenland', 'GL', 'GRL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('86', 'Grenada', 'GD', 'GRD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('87', 'Guadeloupe', 'GP', 'GLP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('88', 'Guam', 'GU', 'GUM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('89', 'Guatemala', 'GT', 'GTM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('90', 'Guinea', 'GN', 'GIN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('91', 'Guinea-bissau', 'GW', 'GNB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('92', 'Guyana', 'GY', 'GUY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('93', 'Haiti', 'HT', 'HTI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('94', 'Heard and Mc Donald Islands', 'HM', 'HMD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('95', 'Honduras', 'HN', 'HND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('96', 'Hong Kong', 'HK', 'HKG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('97', 'Hungary', 'HU', 'HUN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('98', 'Iceland', 'IS', 'ISL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('99', 'India', 'IN', 'IND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('100', 'Indonesia', 'ID', 'IDN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('101', 'Iran (Islamic Republic of)', 'IR', 'IRN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('102', 'Iraq', 'IQ', 'IRQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('103', 'Ireland', 'IE', 'IRL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('104', 'Israel', 'IL', 'ISR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('105', 'Italy', 'IT', 'ITA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('106', 'Jamaica', 'JM', 'JAM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('107', 'Japan', 'JP', 'JPN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('108', 'Jordan', 'JO', 'JOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('109', 'Kazakhstan', 'KZ', 'KAZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('110', 'Kenya', 'KE', 'KEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('111', 'Kiribati', 'KI', 'KIR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('112', 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('113', 'Korea, Republic of', 'KR', 'KOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('114', 'Kuwait', 'KW', 'KWT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('115', 'Kyrgyzstan', 'KG', 'KGZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('116', 'Lao People\'s Democratic Republic', 'LA', 'LAO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('117', 'Latvia', 'LV', 'LVA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('118', 'Lebanon', 'LB', 'LBN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('119', 'Lesotho', 'LS', 'LSO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('120', 'Liberia', 'LR', 'LBR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('121', 'Libyan Arab Jamahiriya', 'LY', 'LBY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('122', 'Liechtenstein', 'LI', 'LIE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('123', 'Lithuania', 'LT', 'LTU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('124', 'Luxembourg', 'LU', 'LUX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('125', 'Macau', 'MO', 'MAC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('126', 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('127', 'Madagascar', 'MG', 'MDG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('128', 'Malawi', 'MW', 'MWI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('129', 'Malaysia', 'MY', 'MYS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('130', 'Maldives', 'MV', 'MDV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('131', 'Mali', 'ML', 'MLI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('132', 'Malta', 'MT', 'MLT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('133', 'Marshall Islands', 'MH', 'MHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('134', 'Martinique', 'MQ', 'MTQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('135', 'Mauritania', 'MR', 'MRT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('136', 'Mauritius', 'MU', 'MUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('137', 'Mayotte', 'YT', 'MYT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('138', 'Mexico', 'MX', 'MEX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('139', 'Micronesia, Federated States of', 'FM', 'FSM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('140', 'Moldova, Republic of', 'MD', 'MDA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('141', 'Monaco', 'MC', 'MCO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('142', 'Mongolia', 'MN', 'MNG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('143', 'Montserrat', 'MS', 'MSR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('144', 'Morocco', 'MA', 'MAR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('145', 'Mozambique', 'MZ', 'MOZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('146', 'Myanmar', 'MM', 'MMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('147', 'Namibia', 'NA', 'NAM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('148', 'Nauru', 'NR', 'NRU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('149', 'Nepal', 'NP', 'NPL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('150', 'Netherlands', 'NL', 'NLD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('151', 'Netherlands Antilles', 'AN', 'ANT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('152', 'New Caledonia', 'NC', 'NCL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('153', 'New Zealand', 'NZ', 'NZL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('154', 'Nicaragua', 'NI', 'NIC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('155', 'Niger', 'NE', 'NER', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('156', 'Nigeria', 'NG', 'NGA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('157', 'Niue', 'NU', 'NIU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('158', 'Norfolk Island', 'NF', 'NFK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('159', 'Northern Mariana Islands', 'MP', 'MNP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('160', 'Norway', 'NO', 'NOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('161', 'Oman', 'OM', 'OMN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('162', 'Pakistan', 'PK', 'PAK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('163', 'Palau', 'PW', 'PLW', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('164', 'Panama', 'PA', 'PAN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('165', 'Papua New Guinea', 'PG', 'PNG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('166', 'Paraguay', 'PY', 'PRY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('167', 'Peru', 'PE', 'PER', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('168', 'Philippines', 'PH', 'PHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('169', 'Pitcairn', 'PN', 'PCN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('170', 'Poland', 'PL', 'POL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('171', 'Portugal', 'PT', 'PRT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('172', 'Puerto Rico', 'PR', 'PRI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('173', 'Qatar', 'QA', 'QAT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('174', 'Reunion', 'RE', 'REU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('175', 'Romania', 'RO', 'ROM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('176', 'Russian Federation', 'RU', 'RUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('177', 'Rwanda', 'RW', 'RWA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('178', 'Saint Kitts and Nevis', 'KN', 'KNA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('179', 'Saint Lucia', 'LC', 'LCA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('180', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('181', 'Samoa', 'WS', 'WSM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('182', 'San Marino', 'SM', 'SMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('183', 'Sao Tome and Principe', 'ST', 'STP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('184', 'Saudi Arabia', 'SA', 'SAU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('185', 'Senegal', 'SN', 'SEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('186', 'Seychelles', 'SC', 'SYC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('187', 'Sierra Leone', 'SL', 'SLE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('188', 'Singapore', 'SG', 'SGP', '4');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('189', 'Slovakia (Slovak Republic)', 'SK', 'SVK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('190', 'Slovenia', 'SI', 'SVN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('191', 'Solomon Islands', 'SB', 'SLB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('192', 'Somalia', 'SO', 'SOM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('193', 'South Africa', 'ZA', 'ZAF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('194', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('195', 'Spain', 'ES', 'ESP', '3');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('196', 'Sri Lanka', 'LK', 'LKA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('197', 'St. Helena', 'SH', 'SHN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('198', 'St. Pierre and Miquelon', 'PM', 'SPM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('199', 'Sudan', 'SD', 'SDN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('200', 'Suriname', 'SR', 'SUR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('201', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('202', 'Swaziland', 'SZ', 'SWZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('203', 'Sweden', 'SE', 'SWE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('204', 'Switzerland', 'CH', 'CHE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('205', 'Syrian Arab Republic', 'SY', 'SYR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('206', 'Taiwan', 'TW', 'TWN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('207', 'Tajikistan', 'TJ', 'TJK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('208', 'Tanzania, United Republic of', 'TZ', 'TZA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('209', 'Thailand', 'TH', 'THA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('210', 'Togo', 'TG', 'TGO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('211', 'Tokelau', 'TK', 'TKL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('212', 'Tonga', 'TO', 'TON', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('213', 'Trinidad and Tobago', 'TT', 'TTO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('214', 'Tunisia', 'TN', 'TUN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('215', 'Turkey', 'TR', 'TUR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('216', 'Turkmenistan', 'TM', 'TKM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('217', 'Turks and Caicos Islands', 'TC', 'TCA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('218', 'Tuvalu', 'TV', 'TUV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('219', 'Uganda', 'UG', 'UGA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('220', 'Ukraine', 'UA', 'UKR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('221', 'United Arab Emirates', 'AE', 'ARE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('222', 'United Kingdom', 'GB', 'GBR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('223', 'United States', 'US', 'USA', '2');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('224', 'United States Minor Outlying Islands', 'UM', 'UMI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('225', 'Uruguay', 'UY', 'URY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('226', 'Uzbekistan', 'UZ', 'UZB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('227', 'Vanuatu', 'VU', 'VUT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('228', 'Vatican City State (Holy See)', 'VA', 'VAT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('229', 'Venezuela', 'VE', 'VEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('230', 'Viet Nam', 'VN', 'VNM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('231', 'Virgin Islands (British)', 'VG', 'VGB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('232', 'Virgin Islands (U.S.)', 'VI', 'VIR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('233', 'Wallis and Futuna Islands', 'WF', 'WLF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('234', 'Western Sahara', 'EH', 'ESH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('235', 'Yemen', 'YE', 'YEM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('236', 'Yugoslavia', 'YU', 'YUG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('237', 'Zaire', 'ZR', 'ZAR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('238', 'Zambia', 'ZM', 'ZMB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('239', 'Zimbabwe', 'ZW', 'ZWE', '1');

drop table if exists currencies;
create table currencies (
  currencies_id int(5) not null auto_increment,
  title varchar(32) not null ,
  code char(3) not null ,
  symbol_left varchar(12) ,
  symbol_right varchar(12) ,
  decimal_point char(1) ,
  thousands_point char(1) ,
  decimal_places char(1) ,
  value float(13,8) ,
  last_updated datetime ,
  PRIMARY KEY (currencies_id)
);

insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', 'US Dollar', 'USD', 'US$', '', '.', ',', '2', '0.30000001', '2002-01-13 20:52:36');
insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('5', 'Reais', 'BR', 'R$', '', '.', ',', '2', '1.00000000', NULL);
insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('6', 'Euro', 'EUR', '€', '', '.', ',', '2', '0.29000002', NULL);

drop table if exists customers;
create table customers (
  customers_id int(5) not null auto_increment,
  customers_gender char(1) not null ,
  customers_firstname varchar(32) not null ,
  customers_lastname varchar(32) not null ,
  customers_dob datetime default '0000-00-00 00:00:00' not null ,
  customers_email_address varchar(96) not null ,
  customers_default_address_id int(5) default '1' not null ,
  customers_telephone varchar(32) not null ,
  documento_cliente varchar(32) not null ,
  customers_fax varchar(32) ,
  customers_password varchar(40) not null ,
  customers_newsletter char(1) ,
  PRIMARY KEY (customers_id),
  KEY idx_customers_id (customers_id),
  KEY idx_customers_email_address (customers_email_address),
  KEY idx_customers_password (customers_password),
  KEY idx_customers_firstname (customers_firstname),
  KEY idx_customers_lastname (customers_lastname)
);


drop table if exists customers_basket;
create table customers_basket (
  customers_basket_id int(5) not null auto_increment,
  customers_id int(5) default '0' not null ,
  products_id tinytext not null ,
  customers_basket_quantity int(2) default '0' not null ,
  final_price decimal(6,2) default '0.00' not null ,
  customers_basket_date_added varchar(8) ,
  PRIMARY KEY (customers_basket_id)
);


drop table if exists customers_basket_attributes;
create table customers_basket_attributes (
  customers_basket_attributes_id int(5) not null auto_increment,
  customers_id int(5) default '0' not null ,
  products_id tinytext not null ,
  products_options_id int(5) default '0' not null ,
  products_options_value_id int(5) default '0' not null ,
  PRIMARY KEY (customers_basket_attributes_id)
);


drop table if exists customers_info;
create table customers_info (
  customers_info_id int(5) default '0' not null ,
  customers_info_date_of_last_logon datetime ,
  customers_info_number_of_logons int(5) ,
  customers_info_date_account_created datetime ,
  customers_info_date_account_last_modified datetime ,
  PRIMARY KEY (customers_info_id)
);


drop table if exists geo_zones;
create table geo_zones (
  geo_zone_id int(5) not null auto_increment,
  geo_zone_name varchar(32) not null ,
  geo_zone_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (geo_zone_id),
  KEY idx_geo_zone_id (geo_zone_id)
);


drop table if exists languages;
create table languages (
  languages_id int(5) not null auto_increment,
  name varchar(32) not null ,
  code char(2) not null ,
  image varchar(64) ,
  directory varchar(32) ,
  sort_order int(3) ,
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name),
  KEY idx_languages_id (languages_id),
  KEY idx_name (name),
  KEY idx_sort_order (sort_order)
);

insert into languages (languages_id, name, code, image, directory, sort_order) values ('4', 'Português', 'pt', 'flag_br.gif', 'portugues', '0');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('5', 'english', 'en', 'flag_en.gif', 'english', '0');

drop table if exists manufacturers;
create table manufacturers (
  manufacturers_id int(5) not null auto_increment,
  manufacturers_name varchar(32) not null ,
  manufacturers_image varchar(64) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
);


drop table if exists manufacturers_info;
create table manufacturers_info (
  manufacturers_id int(5) default '0' not null ,
  languages_id int(5) default '0' not null ,
  manufacturers_url varchar(255) not null ,
  url_clicked int(5) default '0' not null ,
  date_last_click datetime ,
  PRIMARY KEY (manufacturers_id, languages_id)
);


drop table if exists orders;
create table orders (
  orders_id int(5) not null auto_increment,
  customers_id int(5) default '0' not null ,
  customers_name varchar(64) not null ,
  customers_street_address varchar(64) not null ,
  customers_suburb varchar(32) ,
  customers_city varchar(32) not null ,
  customers_postcode varchar(10) not null ,
  customers_state varchar(32) ,
  customers_country varchar(32) not null ,
  customers_telephone varchar(32) not null ,
  customers_email_address varchar(96) not null ,
  documento_cliente varchar(32) ,
  customers_address_format_id int(5) default '0' not null ,
  delivery_name varchar(64) not null ,
  delivery_street_address varchar(64) not null ,
  delivery_suburb varchar(32) ,
  delivery_city varchar(32) not null ,
  delivery_postcode varchar(10) not null ,
  delivery_state varchar(32) ,
  delivery_country varchar(32) not null ,
  delivery_address_format_id int(5) default '0' not null ,
  payment_method varchar(12) not null ,
  numero_boleto varchar(20) ,
  cc_type varchar(20) ,
  cc_owner varchar(64) ,
  cc_number varchar(32) ,
  cc_expires varchar(4) ,
  last_modified datetime ,
  date_purchased datetime ,
  shipping_cost decimal(8,2) default '0.00' not null ,
  shipping_method varchar(32) ,
  orders_status varchar(10) not null ,
  orders_date_finished datetime ,
  comments text ,
  currency char(3) ,
  currency_value decimal(14,6) ,
  PRIMARY KEY (orders_id),
  KEY idx_orders_id (orders_id),
  KEY idx_customers_id (customers_id)
);


drop table if exists orders_products;
create table orders_products (
  orders_products_id int(5) not null auto_increment,
  orders_id int(5) default '0' not null ,
  products_id int(5) default '0' not null ,
  products_model varchar(12) ,
  products_name varchar(64) not null ,
  products_price decimal(8,2) default '0.00' not null ,
  final_price decimal(8,2) default '0.00' not null ,
  products_tax decimal(7,4) default '0.0000' not null ,
  products_quantity int(2) default '0' not null ,
  PRIMARY KEY (orders_products_id),
  KEY idx_orders_products_id (orders_products_id),
  KEY idx_orders_id (orders_id)
);


drop table if exists orders_products_attributes;
create table orders_products_attributes (
  orders_products_attributes_id int(5) not null auto_increment,
  orders_id int(5) default '0' not null ,
  orders_products_id int(5) default '0' not null ,
  products_options varchar(32) not null ,
  products_options_values varchar(32) not null ,
  options_values_price decimal(8,2) default '0.00' not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_attributes_id (orders_products_attributes_id)
);


drop table if exists orders_status;
create table orders_status (
  orders_status_id int(5) default '0' not null ,
  language_id int(5) default '1' not null ,
  orders_status_name varchar(32) not null ,
  PRIMARY KEY (orders_status_id, language_id),
  KEY idx_orders_status_name (orders_status_name)
);

insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '4', 'Pendente');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '4', 'Processando');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '4', 'Enviado');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '5', 'Pending');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '5', 'Processing');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '5', 'Correspondent');

drop table if exists products;
create table products (
  products_id int(5) not null auto_increment,
  products_quantity int(4) default '0' not null ,
  products_model varchar(12) ,
  products_image varchar(64) ,
  products_price decimal(8,2) default '0.00' not null ,
  products_date_added datetime ,
  products_last_modified datetime ,
  products_date_available datetime ,
  products_weight decimal(5,2) default '0.00' not null ,
  products_status tinyint(1) default '0' not null ,
  products_tax_class_id int(5) default '0' not null ,
  manufacturers_id int(5) ,
  PRIMARY KEY (products_id)
);


drop table if exists products_attributes;
create table products_attributes (
  products_attributes_id int(5) not null auto_increment,
  products_id int(5) default '0' not null ,
  options_id int(5) default '0' not null ,
  options_values_id int(5) default '0' not null ,
  options_values_price decimal(8,2) default '0.00' not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (products_attributes_id),
  KEY idx_products_attributes_id (products_attributes_id),
  KEY idx_products_id (products_id),
  KEY idx_options_id (options_id)
);


drop table if exists products_description;
create table products_description (
  products_id int(5) not null auto_increment,
  language_id int(5) default '1' not null ,
  products_name varchar(64) not null ,
  products_description text ,
  products_url varchar(255) ,
  products_viewed int(5) default '0' ,
  PRIMARY KEY (products_id, language_id),
  KEY products_name (products_name),
  KEY idx_products_id (products_id),
  KEY idx_language_id (language_id),
  KEY idx_products_name (products_name)
);


drop table if exists products_options;
create table products_options (
  products_options_id int(5) default '0' not null ,
  language_id int(5) default '1' not null ,
  products_options_name varchar(32) not null ,
  PRIMARY KEY (products_options_id, language_id)
);


drop table if exists products_options_values;
create table products_options_values (
  products_options_values_id int(5) default '0' not null ,
  language_id int(5) default '1' not null ,
  products_options_values_name varchar(64) not null ,
  PRIMARY KEY (products_options_values_id, language_id)
);


drop table if exists products_options_values_to_products_options;
create table products_options_values_to_products_options (
  products_options_values_to_products_options_id int(5) not null auto_increment,
  products_options_id int(5) default '0' not null ,
  products_options_values_id int(5) default '0' not null ,
  PRIMARY KEY (products_options_values_to_products_options_id)
);


drop table if exists products_to_categories;
create table products_to_categories (
  products_id int(5) default '0' not null ,
  categories_id int(5) default '0' not null ,
  PRIMARY KEY (products_id, categories_id)
);


drop table if exists reviews;
create table reviews (
  reviews_id int(5) not null auto_increment,
  products_id int(5) default '0' not null ,
  customers_id int(5) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  PRIMARY KEY (reviews_id)
);


drop table if exists reviews_description;
create table reviews_description (
  reviews_id int(5) default '0' not null ,
  languages_id int(5) default '0' not null ,
  reviews_text text not null ,
  PRIMARY KEY (reviews_id, languages_id)
);


drop table if exists sessions;
create table sessions (
  sesskey varchar(32) not null ,
  expiry int(11) unsigned default '0' not null ,
  value text not null ,
  PRIMARY KEY (sesskey)
);

insert into sessions (sesskey, expiry, value) values ('544a66550fb76062bf7a8b173b0165fc', '1062639254', 'cart|O:12:\"shoppingcart\":3:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";N;}language|s:9:\"portugues\";languages_id|s:1:\"4\";currency|s:2:\"BR\";');

drop table if exists specials;
create table specials (
  specials_id int(5) not null auto_increment,
  products_id int(5) default '0' not null ,
  specials_new_products_price decimal(8,2) default '0.00' not null ,
  specials_date_added datetime ,
  specials_last_modified datetime ,
  expires_date datetime ,
  date_status_change datetime ,
  status int(1) default '1' ,
  PRIMARY KEY (specials_id)
);


drop table if exists tax_class;
create table tax_class (
  tax_class_id int(5) not null auto_increment,
  tax_class_title varchar(32) not null ,
  tax_class_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_class_id),
  KEY idx_tax_class_id (tax_class_id)
);


drop table if exists tax_rates;
create table tax_rates (
  tax_rates_id int(5) not null auto_increment,
  tax_zone_id int(5) default '0' not null ,
  tax_class_id int(5) default '0' not null ,
  tax_priority int(5) default '1' ,
  tax_rate decimal(7,4) default '0.0000' not null ,
  tax_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_rates_id),
  KEY idx_tax_rates_id (tax_rates_id)
);

insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('1', '1', '1', '1', '7.0000', 'FL TAX 7.0%', '2003-08-18 19:52:28', '2002-01-13 20:52:36');

drop table if exists whos_online;
create table whos_online (
  customer_id int(5) ,
  full_name varchar(64) not null ,
  session_id varchar(128) not null ,
  ip_address varchar(15) not null ,
  time_entry varchar(14) not null ,
  time_last_click varchar(14) not null ,
  last_page_url varchar(64) not null 
);

insert into whos_online (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('0', 'Guest', '1b84d9a482472c9608afd7333645343d', '200.158.219.168', '1062637909', '1062637909', '/comercio/default.php');

drop table if exists zones;
create table zones (
  zone_id int(5) not null auto_increment,
  zone_country_id int(5) default '0' not null ,
  zone_code varchar(5) not null ,
  zone_name varchar(32) not null ,
  PRIMARY KEY (zone_id),
  KEY idx_zone_id (zone_id),
  KEY idx_zone_country_id (zone_country_id),
  KEY idx_zone_name (zone_name),
  KEY idx_zone_code (zone_code)
);

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('1', '223', 'AL', 'Alabama');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('2', '223', 'AK', 'Alaska');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('3', '223', 'AS', 'American Samoa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('4', '223', 'AZ', 'Arizona');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('5', '223', 'AR', 'Arkansas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('6', '223', 'AF', 'Armed Forces Africa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('7', '223', 'AA', 'Armed Forces Americas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('8', '223', 'AC', 'Armed Forces Canada');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('9', '223', 'AE', 'Armed Forces Europe');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('10', '223', 'AM', 'Armed Forces Middle East');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('11', '223', 'AP', 'Armed Forces Pacific');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('12', '223', 'CA', 'California');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('13', '223', 'CO', 'Colorado');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('14', '223', 'CT', 'Connecticut');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('15', '223', 'DE', 'Delaware');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('16', '223', 'DC', 'District of Columbia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('17', '223', 'FM', 'Federated States Of Micronesia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('18', '223', 'FL', 'Florida');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('19', '223', 'GA', 'Georgia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('20', '223', 'GU', 'Guam');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('21', '223', 'HI', 'Hawaii');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('22', '223', 'ID', 'Idaho');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('23', '223', 'IL', 'Illinois');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('24', '223', 'IN', 'Indiana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('25', '223', 'IA', 'Iowa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('26', '223', 'KS', 'Kansas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('27', '223', 'KY', 'Kentucky');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('28', '223', 'LA', 'Louisiana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('29', '223', 'ME', 'Maine');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('30', '223', 'MH', 'Marshall Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('31', '223', 'MD', 'Maryland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('32', '223', 'MA', 'Massachusetts');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('33', '223', 'MI', 'Michigan');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('34', '223', 'MN', 'Minnesota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('35', '223', 'MS', 'Mississippi');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('36', '223', 'MO', 'Missouri');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('37', '223', 'MT', 'Montana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('38', '223', 'NE', 'Nebraska');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('39', '223', 'NV', 'Nevada');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('40', '223', 'NH', 'New Hampshire');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('41', '223', 'NJ', 'New Jersey');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('42', '223', 'NM', 'New Mexico');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('43', '223', 'NY', 'New York');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('44', '223', 'NC', 'North Carolina');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('45', '223', 'ND', 'North Dakota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('46', '223', 'MP', 'Northern Mariana Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('47', '223', 'OH', 'Ohio');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('48', '223', 'OK', 'Oklahoma');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('49', '223', 'OR', 'Oregon');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('50', '223', 'PW', 'Palau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('51', '223', 'PA', 'Pennsylvania');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('52', '223', 'PR', 'Puerto Rico');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('53', '223', 'RI', 'Rhode Island');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('54', '223', 'SC', 'South Carolina');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('55', '223', 'SD', 'South Dakota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('56', '223', 'TN', 'Tennessee');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('57', '223', 'TX', 'Texas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('58', '223', 'UT', 'Utah');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('59', '223', 'VT', 'Vermont');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('60', '223', 'VI', 'Virgin Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('61', '223', 'VA', 'Virginia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('62', '223', 'WA', 'Washington');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('63', '223', 'WV', 'West Virginia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('64', '223', 'WI', 'Wisconsin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('65', '223', 'WY', 'Wyoming');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('66', '38', 'AB', 'Alberta');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('67', '38', 'BC', 'British Columbia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('68', '38', 'MB', 'Manitoba');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('69', '38', 'NF', 'Newfoundland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('70', '38', 'NB', 'New Brunswick');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('71', '38', 'NS', 'Nova Scotia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('72', '38', 'NT', 'Northwest Territories');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('73', '38', 'NU', 'Nunavut');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('74', '38', 'ON', 'Ontario');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('75', '38', 'PE', 'Prince Edward Island');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('76', '38', 'QC', 'Quebec');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('77', '38', 'SK', 'Saskatchewan');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('78', '38', 'YT', 'Yukon Territory');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('79', '81', 'NDS', 'Niedersachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('80', '81', 'BAW', 'Baden-Wurttemberg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('81', '81', 'BAY', 'Bayern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('82', '81', 'BER', 'Berlin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('83', '81', 'BRG', 'Brandenburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('84', '81', 'BRE', 'Bremen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('85', '81', 'HAM', 'Hamburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('86', '81', 'HES', 'Hessen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('87', '81', 'MEC', 'Mecklenburg-Vorpommern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('88', '81', 'NRW', 'Nordrhein-Westfalen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('89', '81', 'RHE', 'Rheinland-Pfalz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('90', '81', 'SAR', 'Saarland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('91', '81', 'SAS', 'Sachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('92', '81', 'SAC', 'Sachsen-Anhalt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('93', '81', 'SCN', 'Schleswig-Holstein');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('94', '81', 'THE', 'Thuringen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('130', '30', 'SP', 'São Paulo');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('131', '30', 'RJ', 'Rio de Janeiro');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('132', '30', 'MG', 'Minas Gerais');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('133', '30', 'PR', 'Paraná');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('134', '30', 'SC', 'Santa Catarina');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('135', '30', 'DF', 'Distrito Federal');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('136', '30', 'ES', 'Espírito Santo');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('137', '30', 'MS', 'Mato Grosso do Sul');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('138', '30', 'RS', 'Rio Grande do Sul');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('139', '30', 'GO', 'Goiás');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('140', '30', 'BA', 'Bahia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('141', '30', 'MT', 'Mato Grosso');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('142', '30', 'TO', 'Tocantins');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('143', '30', 'AL', 'Alagoas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('144', '30', 'SE', 'Sergipe');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('145', '30', 'PB', 'Paraíba');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('146', '30', 'PE', 'Pernambuco');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('147', '30', 'PI', 'Piauí');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('148', '30', 'RO', 'Rondônia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('149', '30', 'AC', 'Acre');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('150', '30', 'AP', 'Amapá');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('151', '30', 'AM', 'Amazonas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('152', '30', 'CE', 'Ceará');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('153', '30', 'MA', 'Maranhão');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('154', '30', 'PA', 'Pará');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('155', '30', 'RN', 'Rio Grande do Norte');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('156', '30', 'RR', 'Roraima');

drop table if exists zones_to_geo_zones;
create table zones_to_geo_zones (
  association_id int(5) not null auto_increment,
  zone_country_id int(5) default '0' not null ,
  zone_id int(5) ,
  geo_zone_id int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (association_id),
  KEY idx_association_id (association_id)
);

insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('1', '30', '130', '1', NULL, '2002-01-13 20:52:36');

