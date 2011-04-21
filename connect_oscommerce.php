<?php

ini_set ( 'display_errors', '1' );
error_reporting ( E_ALL );

/*
Версия CML для магазинов на движке oscommerce

Тестированно на версии osCommerce 3.05 sp 1.4
Распространяется под лицензией GPL 3.0
Автор Перушев Владислав
e-mail	homutke@mail.ru
16 мая 2010 Год

Обсуждение скрипта , дополнения и пожелания можно высказывать по адресу

http://infostart.ru/community/groups/622/

в группе CommerceML
*/

# Все, что имеет отношение к движку osCommerce 3.0
require('includes/configure.php');
require('includes/database_tables.php');
require('includes/classes/database.php');
#Добавление модуля конвертации
#require('includes/classes/image.php');
#require('admin/includes/classes/image.php');

$osC_Database = osC_Database::connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE_CLASS);
$osC_Database->selectDatabase(DB_DATABASE);
#$osC_Database->setDebug(true);

/*
http://www.oscommerce.info/confluence/display/OSCDOC/Database+Class+(osC_Database)#DatabaseClass%28osC_Database%29-SimpleQueries
*/
#Текущая версия скрипта
DEFINE('FIX_VERSION' , '1.0.1');
#использовать архивацию файлов при обмене
DEFINE('FIX_ZIP' , 'yes');
#максимальный размер архива
DEFINE('FIX_ZIPSIZE' , 2048000);
#путь до директории с маленькими картинками
DEFINE('JPATH_BASE_PICTURE_SMALL' , 'images/products/thumbnails');
#путь до директории с картинками
DEFINE('JPATH_BASE_PICTURE' , 'images/products/originals');
# Код русского языка по умолчанию
DEFINE('FIX_LANGUAGE',2);
# Наименование цены по умолчанию
DEFINE('FIX_TYPEPRICE','цена продажи');
# 0- Всех клиентов web магазина переносить в 1С без изменений, 1- Всех клиентов переносить на одного
# Контрагента "Физ. лицо"
DEFINE('FIX_CLIENT' ,1);
DEFINE('FIX_CODING' ,'UTF-16');

define ( 'DS', DIRECTORY_SEPARATOR );
//  категории товара
$category = array ();
# товары
$products = array ();
# типы цен
$price = array ();
# цены на товар
$price_tovar = array ();
# характеристики на товар
$char_type_name = array ();
# производитель
$manufacturer_1C_ID = '';
#массив производителей
$manufacturer = array ();
#ID продавца, имя продавца берем из CML
$vendor_1C_ID = 0;
#ID группы производителей ищется по имени продавца, берем из CML
$mf_category_id = 0;

# групп характеристик товаров
# [Цвета]= 1
# [размеры]= 2
$variants_groups = array();
# состав групп характеристик товаров
# [Цвета][красный]= 1
# [Цвета][синий]= 4
# [размеры][39]= 2

$variants_groups_value = array();

#Функция принудительной отладки результат пишется в корень сайта в файл
#log.txt
#можно закоментировать
function _Log($get_referer)
{
	$fopen = fopen ("log.txt", "a+");
	fputs ($fopen, "$get_referer\n");
	fclose ($fopen);
}

/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2009 osCommerce

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License v2 (1991)
as published by the Free Software Foundation.
*/
/*
define('TABLE_ADMINISTRATORS', DB_TABLE_PREFIX . 'administrators');
define('TABLE_ADMINISTRATORS_ACCESS', DB_TABLE_PREFIX . 'administrators_access');
define('TABLE_ADMINISTRATORS_LOG', DB_TABLE_PREFIX . 'administrators_log');
define('TABLE_ADDRESS_BOOK', DB_TABLE_PREFIX . 'address_book');
define('TABLE_BANNERS', DB_TABLE_PREFIX . 'banners');
define('TABLE_BANNERS_HISTORY', DB_TABLE_PREFIX . 'banners_history');
define('TABLE_CATEGORIES', DB_TABLE_PREFIX . 'categories');
define('TABLE_CATEGORIES_DESCRIPTION', DB_TABLE_PREFIX . 'categories_description');
define('TABLE_CONFIGURATION', DB_TABLE_PREFIX . 'configuration');
define('TABLE_CONFIGURATION_GROUP', DB_TABLE_PREFIX . 'configuration_group');
define('TABLE_COUNTER', DB_TABLE_PREFIX . 'counter');
define('TABLE_COUNTER_HISTORY', DB_TABLE_PREFIX . 'counter_history');
define('TABLE_COUNTRIES', DB_TABLE_PREFIX . 'countries');
define('TABLE_CREDIT_CARDS', DB_TABLE_PREFIX . 'credit_cards');
define('TABLE_CURRENCIES', DB_TABLE_PREFIX . 'currencies');
define('TABLE_CUSTOMERS', DB_TABLE_PREFIX . 'customers');
define('TABLE_GEO_ZONES', DB_TABLE_PREFIX . 'geo_zones');
define('TABLE_language', DB_TABLE_PREFIX . 'language');
define('TABLE_language_DEFINITIONS', DB_TABLE_PREFIX . 'language_definitions');
define('TABLE_MANUFACTURERS', DB_TABLE_PREFIX . 'manufacturers');
define('TABLE_MANUFACTURERS_INFO', DB_TABLE_PREFIX . 'manufacturers_info');
define('TABLE_NEWSLETTERS', DB_TABLE_PREFIX . 'newsletters');
define('TABLE_NEWSLETTERS_LOG', DB_TABLE_PREFIX . 'newsletters_log');
define('TABLE_ORDERS', DB_TABLE_PREFIX . 'orders');
define('TABLE_ORDERS_PRODUCTS', DB_TABLE_PREFIX . 'orders_products');
define('TABLE_ORDERS_PRODUCTS_DOWNLOAD', DB_TABLE_PREFIX . 'orders_products_download');
define('TABLE_ORDERS_PRODUCTS_VARIANTS', DB_TABLE_PREFIX . 'orders_products_variants');
define('TABLE_ORDERS_STATUS', DB_TABLE_PREFIX . 'orders_status');
define('TABLE_ORDERS_STATUS_HISTORY', DB_TABLE_PREFIX . 'orders_status_history');
define('TABLE_ORDERS_TOTAL', DB_TABLE_PREFIX . 'orders_total');
define('TABLE_ORDERS_TRANSACTIONS_HISTORY', DB_TABLE_PREFIX . 'orders_transactions_history');
define('TABLE_ORDERS_TRANSACTIONS_STATUS', DB_TABLE_PREFIX . 'orders_transactions_status');
define('TABLE_PRODUCT_ATTRIBUTES', DB_TABLE_PREFIX . 'product_attributes');
define('TABLE_PRODUCTS', DB_TABLE_PREFIX . 'products');
define('TABLE_PRODUCTS_DESCRIPTION', DB_TABLE_PREFIX . 'products_description');
define('TABLE_PRODUCTS_IMAGES', DB_TABLE_PREFIX . 'products_images');
define('TABLE_PRODUCTS_IMAGES_GROUPS', DB_TABLE_PREFIX . 'products_images_groups');
define('TABLE_PRODUCTS_NOTIFICATIONS', DB_TABLE_PREFIX . 'products_notifications');
define('TABLE_PRODUCTS_TO_CATEGORIES', DB_TABLE_PREFIX . 'products_to_categories');
define('TABLE_PRODUCTS_VARIANTS', DB_TABLE_PREFIX . 'products_variants');
define('TABLE_PRODUCTS_VARIANTS_GROUPS', DB_TABLE_PREFIX . 'products_variants_groups');
define('TABLE_PRODUCTS_VARIANTS_VALUES', DB_TABLE_PREFIX . 'products_variants_values');
define('TABLE_REVIEWS', DB_TABLE_PREFIX . 'reviews');
define('TABLE_SESSIONS', DB_TABLE_PREFIX . 'sessions');
define('TABLE_SHIPPING_AVAILABILITY', DB_TABLE_PREFIX . 'shipping_availability');
define('TABLE_SHOPPING_CARTS', DB_TABLE_PREFIX . 'shopping_carts');
define('TABLE_SHOPPING_CARTS_CUSTOM_VARIANTS_VALUES', DB_TABLE_PREFIX . 'shopping_carts_custom_variants_values');
define('TABLE_SPECIALS', DB_TABLE_PREFIX . 'specials');
define('TABLE_TAX_CLASS', DB_TABLE_PREFIX . 'tax_class');
define('TABLE_TAX_RATES', DB_TABLE_PREFIX . 'tax_rates');
define('TABLE_TEMPLATES', DB_TABLE_PREFIX . 'templates');
define('TABLE_TEMPLATES_BOXES', DB_TABLE_PREFIX . 'templates_boxes');
define('TABLE_TEMPLATES_BOXES_TO_PAGES', DB_TABLE_PREFIX . 'templates_boxes_to_pages');
define('TABLE_WEIGHT_CLASS', DB_TABLE_PREFIX . 'weight_classes');
define('TABLE_WEIGHT_CLASS_RULES', DB_TABLE_PREFIX . 'weight_classes_rules');
define('TABLE_WHOS_ONLINE', DB_TABLE_PREFIX . 'whos_online');
define('TABLE_ZONES', DB_TABLE_PREFIX . 'zones');
define('TABLE_ZONES_TO_GEO_ZONES', DB_TABLE_PREFIX . 'zones_to_geo_zones');
*/

#Возвращает charset для языка
function osGetCharset()
{
	global $osC_Database;

	$Qselect =$osC_Database->query("select charset from " . TABLE_LANGUAGES . " where languages_id = " . FIX_LANGUAGE . "");

	$Qselect->execute();
	while ($Qselect->next()){
		return $Qselect->Value('charset');
	}
}


# Обработка характеристик товара возвращает строковый индекс характеристик
# id товар
# ownerid владелец на товар
function products_character($xml,$id,$ownerid) {


	global $osC_Database;

	global $variants_groups;
	global $variants_groups_value;

	#Перебираем характеристики товара
	#
	foreach ($xml->ХарактеристикиТовара->ХарактеристикаТовара as $char_data)
	{
		#TABLE_PRODUCTS_VARIANTS_GROUPS
		#УНИКАЛЬНОЕ НАИМЕНОВАНИЕ ХАРАКТЕРИСТИКИ
		$NameCharacter	=	(string)$char_data->Наименование;
		$zNameCharacter	=	(string)$char_data->Значение;

		if (!isset($variants_groups[$NameCharacter])) {
			$variants_groups[$NameCharacter]=$products_variants_groups_id = 0;
			$Qinstall = $osC_Database->query('insert into ' . TABLE_PRODUCTS_VARIANTS_GROUPS . '
			(languages_id, module ,title,sort_order) values 
			(:languages_id,:module,:title,:sort_order )');
			$Qinstall->bindValue(':module', 'pull_down_menu');
			$Qinstall->bindValue(':title', $NameCharacter);
			$Qinstall->bindInt(':languages_id', FIX_LANGUAGE);
			$Qinstall->bindInt(':sort_order', count($variants_groups[$NameCharacter]));

			$Qinstall->execute();
			$products_variants_groups_id	=	$osC_Database->nextID();
			$variants_groups[$NameCharacter]=$products_variants_groups_id;
		}
		else {
			$products_variants_groups_id = $variants_groups[$NameCharacter];
			_Log('TABLE_PRODUCTS_VARIANTS_GROUPS =' . $products_variants_groups_id);
		}


		#Наборы вариантов характеристик
		if (!isset($variants_groups_value[$NameCharacter][$zNameCharacter]))
		{
			$variants_groups_value[$NameCharacter][$zNameCharacter] = 0;
			$Qinstall = $osC_Database->query('insert into ' . TABLE_PRODUCTS_VARIANTS_VALUES . '
			(languages_id,title,products_variants_groups_id,sort_order) values 
			(:languages_id,:title,:products_variants_groups_id,:count)');
			$Qinstall->bindInt(':products_variants_groups_id',$products_variants_groups_id);
			$Qinstall->bindValue(':title', $zNameCharacter);
			$Qinstall->bindInt(':languages_id', FIX_LANGUAGE);
			$Qinstall->bindInt(':count', count($variants_groups_value[$NameCharacter]));
			$Qinstall->execute();
			$products_variants_values_id	=	$osC_Database->nextID();
			$variants_groups_value[$NameCharacter][$zNameCharacter] = $products_variants_values_id;
		}
		else {
			$products_variants_values_id	=	$variants_groups_value[$NameCharacter][$zNameCharacter];
		}
		#Наборы вариантов прикрепляем к товару
		$Qinstall = $osC_Database->query('insert into ' . TABLE_PRODUCTS_VARIANTS . '
			(products_id,products_variants_values_id,default_combo) values 
			(:products_id,:products_variants_values_id,0)');
		$Qinstall->bindInt(':products_id',$ownerid);
		$Qinstall->bindInt(':products_variants_values_id', $products_variants_values_id);
		$Qinstall->execute();


	}
}

# Обход свойств для поиска id производителя, по id производителя в свойствах товара находим значение свойства производитель
function property_find($xml,$property_name='') {
	$property = '';
	if (!isset($xml->Свойства))

	{
		return $property;
	}
	foreach ($xml->Свойства->Свойство as $property_data)
	{
		$name 	=(string)$property_data->Наименование;
		if ($name == $property_name) {
			$property	=(string)$property_data->Ид;
		}
	}
	return $property;
}
# Создание нового производителя с привязкой к группе продавца
function manufacturer_create($name) {

	global $osC_Database;

	$Qinstall = $osC_Database->query('insert into :table_templates (manufacturers_name, date_added) values (:manufacturers_name, :date_added)');
	$Qinstall->bindDate(':date_added',  date("Y-m-d H:i:s"));
	$Qinstall->bindValue(':manufacturers_name', $name);
	$Qinstall->bindTable(':table_templates', TABLE_MANUFACTURERS);
	$Qinstall->execute();
	$id	=	 $osC_Database->nextID();

	$Qinstall = $osC_Database->query('insert into :table_templates (manufacturers_id, languages_id, manufacturers_url)
	values (:manufacturers_id, :languages_id, :manufacturers_url)');
	$Qinstall->bindInt(':languages_id', FIX_LANGUAGE);
	$Qinstall->bindInt(':manufacturers_id', $id);

	$Qinstall->bindValue(':manufacturers_url', 'http://infostart.ru/community/groups/622/');
	$Qinstall->bindTable(':table_templates', TABLE_MANUFACTURERS_INFO);
	$Qinstall->execute();

	return $id;

}
# Загрузим производителей товара в массив
function LoadmanufacturerName() {

	global $osC_Database;

	$manufacturer = array ();

	$Qselect = $osC_Database->query('SELECT
  	b.manufacturers_name AS name, b.manufacturers_id AS id
	FROM  ' .TABLE_MANUFACTURERS_INFO.' a  LEFT OUTER JOIN '. TABLE_MANUFACTURERS .  ' b ON a.manufacturers_id = b.manufacturers_id
	WHERE  a.languages_id = :languages_id');

	#$Qselect->bindTable(':man', TABLE_MANUFACTURERS);
	#$Qselect->bindTable(':man_info', TABLE_MANUFACTURERS_INFO);
	$Qselect->bindInt(':languages_id', FIX_LANGUAGE);
	$Qselect->execute();

	while ( $Qselect->next() ) {
		$manufacturer [$Qselect->valueProtected('name')] = $Qselect->valueInt('id');
	}
	return $manufacturer;
}
function createzakaz() {

	global $osC_Database;


	$Qselect = $osC_Database->query('SELECT a.*,b.value as total,c.customers_firstname as 	firstname,
	c.customers_lastname as lastname
	FROM :tab1 a inner join :tab2 b
	inner join :tab3 c
	WHERE a.orders_id=b.orders_id and b.class=:filter and a.orders_status =1 
	and c.customers_id=a.customers_id');
	$Qselect->bindTable(':tab1', TABLE_ORDERS);
	$Qselect->bindTable(':tab2', TABLE_ORDERS_TOTAL);
	$Qselect->bindTable(':tab3', TABLE_CUSTOMERS);
	$Qselect->bindValue(':filter', 'sub_total');
	$Qselect->execute();

	_Log($Qselect->sql_query);

	$timechange = time ();
	_Log('Zakazov' . $Qselect->numberOfRows());
	if ($Qselect->numberOfRows() >0) {

		$no_spaces = '<?xml version="1.0" encoding="UTF-8"?>
							<КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="' . date ( 'Y-m-d', $timechange ) . 'T' . date ( 'H:m:s', $timechange ) . '"></КоммерческаяИнформация>';
		$xml = new SimpleXMLElement ( $no_spaces );

		while ( $Qselect->next() ) {
			$orders_id	=	$Qselect->value('orders_id');
			$doc = $xml->addChild ( "Документ" );

			# Валюта документа
			$val = $Qselect->value('currency');
			switch ($val) {
				case 'руб' :
					$val = 'RUB';
					break;
				case 'RUB' :
					$val = 'руб';
					break;
			}



			$doc->addChild ( "Ид", $orders_id);
			$doc->addChild ( "Номер", $orders_id );
			$doc->addChild ( "Дата", substr($Qselect->value('date_purchased'),0,10));
			$doc->addChild ( "ХозОперация", "Заказ товара" );
			$doc->addChild ( "Роль", "Продавец" );
			$doc->addChild ( "Валюта", $val );
			$doc->addChild ( "Курс", $Qselect->value('currency_value') );
			$doc->addChild ( "Сумма", $Qselect->value('total') );
			$doc->addChild ( "Время", substr($Qselect->value('date_purchased'),11));

			// Контрагенты

			if (FIX_CLIENT <> 1) {
				$FIO = $Qselect->value('customers_name') ;

				$k1 = $doc->addChild ( 'Контрагенты' );
				$k1_1 = $k1->addChild ( 'Контрагент' );
				$k1_2 = $k1_1->addChild ( "Наименование", $FIO );
				$k1_2 = $k1_1->addChild ( "Роль", "Покупатель" );
				$k1_2 = $k1_1->addChild ( "ПолноеНаименование", $FIO );
				$k1_2 = $k1_1->addChild ( "Имя", $Qselect->value('firstname') );
				$k1_2 = $k1_1->addChild ( "Фамилия", $Qselect->value('lastname') );

			} else {
				$k1 = $doc->addChild ( 'Контрагенты' );
				$k1_1 = $k1->addChild ( 'Контрагент' );
				$k1_2 = $k1_1->addChild ( "Наименование", "Физ лицо" );
				$k1_2 = $k1_1->addChild ( "Роль", "Покупатель" );
				$k1_2 = $k1_1->addChild ( "ПолноеНаименование", "Физ лицо" );
				$k1_2 = $k1_1->addChild ( "Имя", "лицо" );
				$k1_2 = $k1_1->addChild ( "Фамилия", "Физ" );
			}
			/*$k1_3 = $k1_1->addChild("АдресРегистрации");
			$k1_4 = $k1_3->addChild("Представление");
			$k1_4 = $k1_3->addChild("АдресноеПоле");
			<Представление>87698</Представление>
			- <АдресноеПоле>
			<Тип>Почтовый индекс</Тип>
			<Значение>6546</Значение>
			</АдресноеПоле>
			- <АдресноеПоле>
			<Тип>Улица</Тип>
			<Значение>87698</Значение>
			</АдресноеПоле>
			</АдресРегистрации>
			*/



			$Qselect2 = $osC_Database->query('SELECT *
			FROM :tab1 a WHERE a.orders_id =:filter');
			$Qselect2->bindTable(':tab1', TABLE_ORDERS_PRODUCTS);
			$Qselect2->bindValue(':filter', $orders_id);
			$Qselect2->execute();



			while ( $Qselect2->next() ) {

				$t1 = $doc->addChild ( 'Товары' );
				$t1_1 = $t1->addChild ( 'Товар' );
				$t1_2 = $t1_1->addChild ( "Ид", $Qselect2->value('products_id') );
				$t1_2 = $t1_1->addChild ( "Наименование", $Qselect2->value('products_name'));
				$t1_2 = $t1_1->addChild ( "ЦенаЗаЕдиницу", $Qselect2->value('products_price'));
				$t1_2 = $t1_1->addChild ( "Количество", $Qselect2->value('products_quantity') );
				$t1_2 = $t1_1->addChild ( "Сумма", $Qselect2->value('products_price')*$Qselect2->value('products_quantity'));
				$t1_2 = $t1_1->addChild ( "ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild ( "ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild ( "Наименование", "ВидНоменклатуры" );
				$t1_4 = $t1_3->addChild ( "Значение", "Товар" );

				$t1_2 = $t1_1->addChild ( "ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild ( "ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild ( "Наименование", "ТипНоменклатуры" );
				$t1_4 = $t1_3->addChild ( "Значение", "Товар" );

			}

		}

		// print the SimpleXMLElement as a XML well-formed string
		if (FIX_CODING == 'UTF-8') {
			header ( "Content-type: text/xml; charset=utf-8" );
			print iconv ( "utf-8", "windows-1251", $xml->asXML () );
		} else {
			print $xml->asXML ();
		}

	} else
	{
		$no_spaces = '<?xml version="1.0" encoding="UTF-8"?>
							<КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="' . date ( 'Y-m-d', $timechange ) . 'T' . date ( 'H:m:s', $timechange ) . '"></КоммерческаяИнформация>';
		$xml = new SimpleXMLElement ( $no_spaces );
		if (FIX_CODING == 'UTF-8') {
			header ( "Content-type: text/xml; charset=utf-8" );
			print iconv ( "utf-8", "windows-1251", $xml->asXML () );
		} else {
			print $xml->asXML ();
		}
	}

}


# Загрузка файла из 1С методом POST
# Все файлы попадают в директорию JPATH_BASE_PICTURE
# Загрузка файла POST'ом
function loadfile() {

	$filename_to_save = JPATH_BASE_PICTURE_SMALL . DS . $_REQUEST ['filename'];


	$image_data = file_get_contents ( "php://input" );

	if (isset ( $image_data )) {
		//if (file_exists($filename_to_save)) {unlink($filename_to_save);}


		$png_file = fopen ( $filename_to_save, "ab" ) or die ( "File not opened" );
		if ($png_file) {
			set_file_buffer ( $png_file, 20 );
			fwrite ( $png_file, $image_data );
			fclose ( $png_file );
			return "success";
		}
	}

	return "error POST";
}
# Распаковка архивов
function unzip($file, $folder = '') {


	$zip = zip_open ( $folder . $file );
	$files = 0;

	if ($zip) {
		while ( $zip_entry = zip_read ( $zip ) ) {

			$name = $folder . zip_entry_name ( $zip_entry );

			$path_parts = pathinfo ( $name );
			# Создем отсутствующие директории
			if (! is_dir ( $path_parts ['dirname'] )) {
				mkdir ( $path_parts ['dirname'], 0755, true );
			}

			if (zip_entry_open ( $zip, $zip_entry, "r" )) {
				$buf = zip_entry_read ( $zip_entry, zip_entry_filesize ( $zip_entry ) );

				$file = fopen ( $name, "wb" );
				if ($file) {
					fwrite ( $file, $buf );
					fclose ( $file );
					$files ++;
				} else {
				}
				zip_entry_close ( $zip_entry );
			}
		}
		zip_close ( $zip );
	} else {
	}

}
# Очистка таблиц в базе
function ClearBase($change) {
	global $osC_Database;

	if ($change == 'false') {
		# Чистим таблицу категорий
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_CATEGORIES);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_CATEGORIES . ' AUTO_INCREMENT = 0');
		$Qalter->execute();


		# Чистим таблицу дерева категорий
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_CATEGORIES_DESCRIPTION);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_CATEGORIES_DESCRIPTION . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		# Чистим таблицу товаров
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_PRODUCTS . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		# Чистим таблицу описаний товаров
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS_DESCRIPTION);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' .  TABLE_PRODUCTS_DESCRIPTION . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		# Чистим таблицу описаний товаров
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS_IMAGES);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' .  TABLE_PRODUCTS_IMAGES . ' AUTO_INCREMENT = 0');
		$Qalter->execute();


		# Чистим таблицу привязки товаров к категориям
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS_TO_CATEGORIES);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_PRODUCTS_TO_CATEGORIES . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		# Чистим таблицу произодителей
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_MANUFACTURERS);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_MANUFACTURERS . ' AUTO_INCREMENT = 0');
		$Qalter->execute();
		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_MANUFACTURERS_INFO);
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_MANUFACTURERS_INFO . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS_VARIANTS  );
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_PRODUCTS_VARIANTS  . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCTS_VARIANTS_VALUES );
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_PRODUCTS_VARIANTS_VALUES  . ' AUTO_INCREMENT = 0');
		$Qalter->execute();

		$Qdelete = $osC_Database->query('DELETE  FROM ' . TABLE_PRODUCT_ATTRIBUTES  );
		$Qdelete->execute();
		$Qalter = $osC_Database->query('ALTER TABLE  ' . TABLE_PRODUCT_ATTRIBUTES   . ' AUTO_INCREMENT = 0');
		$Qalter->execute();
	}
}
# Очистка таблиц в базе
function ClearBase2($change) {

	global $osC_Database;

	if ($change == 'false') {


	}
}
# Прочитаем таблицу группы характеристик
function readproducts_variants_groups()
{
	global $osC_Database;

	global $variants_groups;
	global $variants_groups_value;

	$Qselect =$osC_Database->query("select id,title from :tab where languages_id = " . FIX_LANGUAGE . "");
	$Qselect->bindTable(':tab', TABLE_PRODUCTS_VARIANTS_GROUPS);

	$Qselect->execute();
	while ($Qselect->next()){
		$variants_groups[$Qselect->Value('title')]=$Qselect->ValueInt('id');
		$Qselect1 =$osC_Database->query("select id,products_variants_groups_id,title from :tab where languages_id = " . FIX_LANGUAGE .
		" AND products_variants_groups_id=:products_variants_groups_id");
		$Qselect1->bindTable(':tab', TABLE_PRODUCTS_VARIANTS_VALUES);
		$Qselect1->bindInt(':products_variants_groups_id', (int)$Qselect->ValueInt('id'));
		$Qselect1->execute();
		while ($Qselect1->next()){
			$variants_groups_value[$Qselect->Value('title')][$Qselect1->Value('title')]=(int)$Qselect1->ValueInt('id');
		}
	}
}
# Создание новой ссылки товара на группу
function newProducts_xref($category_id, $product_id) {

	global $osC_Database;

	$Qinstall = $osC_Database->query('insert into '. TABLE_PRODUCTS_TO_CATEGORIES . '
	(categories_id ,products_id) values (
	:categories_id ,:products_id)');
	$Qinstall->bindInt(':categories_id ', $category_id);
	$Qinstall->bindInt(':products_id', $product_id);
	$Qinstall->execute();
	_Log('newProducts_xref ' . $category_id . ' ' . $product_id);
}
# Создание нового товара
function newProducts($product_parent_id,
$product_SKU,
$product_name,
$product_desc,
$product_full_image,
$product_ed,
$manufacturers_id,
$picture,
$has_children) {

	global $osC_Database;
	global $osC_Image_Admin;

	$Qinstall = $osC_Database->query('insert into '. TABLE_PRODUCTS . '
	(parent_id,
	products_model,
	products_status, 
	has_children,
	manufacturers_id,
	products_quantity,
	products_price,
	products_date_added,
	products_weight, 
	products_weight_class, products_tax_class_id,products_ordered) values (
	:parent_id,:products_model,:products_status, :has_children, :manufacturers_id, 0, 0, :products_date_added, 0 , 0 , 0, 0)');
	$Qinstall->bindInt(':parent_id', $product_parent_id);
	$Qinstall->bindValue(':products_model', $product_SKU);
	$Qinstall->bindInt(':products_status', 1);
	$Qinstall->bindDate(':products_date_added', date("Y-m-d H:i:s"));
	$Qinstall->bindInt(':manufacturers_id', $manufacturers_id);
	$Qinstall->bindInt(':has_children', $has_children);
	$Qinstall->execute();
	$pid	=	$osC_Database->nextID();

	$Qinstall = $osC_Database->query('insert into ' . TABLE_PRODUCTS_DESCRIPTION . '
	(products_id,language_id,products_name, products_description,products_keyword,products_tags) values (
	:products_id,:language_id,:products_name, :products_description,:products_keyword,
	:products_tags)');
	$Qinstall->bindInt(':products_id', $pid);
	$Qinstall->bindInt(':language_id', FIX_LANGUAGE);
	$Qinstall->bindValue(':products_name', addslashes($product_name));
	$Qinstall->bindValue(':products_description', addslashes($product_desc));
	 //Andrew Заменить символы на подчёркивание для соответствия GET данных и keywords
	/*$Arpl1 = array(" ");
	$Arpl2 = array(",", ".");
	$product_name = str_replace($Arpl1, "_", $product_name);
	$product_name = str_replace($Arpl2, "", $product_name);*/
	
	$Qinstall->bindValue(':products_tags', $product_name);
    $Atr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
        " "=> "_", "."=> "", "/"=> "_"
    );
    $product_name = strtr($product_name,$Atr);    
    $product_name = preg_replace('/[^A-Za-z0-9_\-]/', '', $product_name);
	
	$Qinstall->bindValue(':products_keyword', $product_name); // .'_art_' . $product_SKU);
	
	$Qinstall->execute();

	$Qinstall = $osC_Database->query('insert into ' . TABLE_PRODUCTS_IMAGES . '
	(products_id,image ,default_flag, sort_order,date_added ) values (
	:products_id,:image ,1, 1, now())');
	$Qinstall->bindInt(':products_id', $pid);
	$Qinstall->bindValue(':image', $picture);
	$Qinstall->execute();


	_Log('newProducts '. $product_parent_id . ' ' .  $pid . ' ' . $product_SKU);
	return $pid;
}
# Парсинг списка товаров и характеристик
function products_create($xml, $products) {

	global $category;

	global $manufacturer;
	global $manufacturer_1C_ID;


	global $osC_Database;

	if (!isset($xml->Товары)) return $products;

	$i=0;
	foreach ($xml->Товары->Товар as $product_data)
	{
		$i++;
		# guid товара
		$owner = substr((string)$product_data->Ид,0,36);
		# guid товара полный
		$owner2 = (string)$product_data->Ид;


		# Если товар уже был загружен в массив
		if (isset ( $products [$owner] )) {

			# Добавим товар на характеристику
			$products [$owner2] ['product_id'] = newProducts ($products [$owner] ['product_id'],$products [$owner] ['Артикул'].':e'.$i 			,$products [$owner] ['Наименование'],  $products [$owner] ['Реквизиты'] ['Полное наименование'],
			$products [$owner] ['picture'], $products [$owner] ['product_ed'],$products [$owner] ['manufacturer'],$products [$owner] ['picture'],0 );


			# Связываем товар и группу
			newProducts_xref ( $products [$owner] ['Группа'], $products [$owner2] ['product_id'] );

			# Характеристики товара
			if (isset($product_data->ХарактеристикиТовара))
			{
				products_character($product_data,$products [$owner2] ['product_id'],$products [$owner2] ['product_id']);
			}


		} # новый товар в массиве
		else
		{
			$products[$owner]['Наименование'] 	=(string)$product_data->Наименование;
			$products[$owner]['Артикул'] 		=(string)$product_data->Артикул;
			$products[$owner]['Группа'] 		= 0;

			foreach ($product_data->Группы as $groups_data)
			{
				$id	=	(string)$groups_data->Ид;
				$products [$owner] ['Группа'] = $category [$id] ['category_id'];
			}
			$products[$owner]['product_ed']=(string)$product_data->БазоваяЕдиница;

			# Реквизиты товара
			foreach ($product_data->ЗначенияРеквизитов->ЗначениеРеквизита as $recvizit_data)
			{
				$products [$owner] ['Реквизиты'] ["$recvizit_data->Наименование"] = "$recvizit_data->Значение";
			}


			# Свойства товара (поиск производителя)
			$products [$owner] ['manufacturer'] = 0;
			if (isset($product_data->ЗначенияСвойств))

			{
				foreach ($product_data->ЗначенияСвойств->ЗначенияСвойства as $sv_data)

				{
					# перебираем свойства ищем производителя
					if ($sv_data->Ид	==	$manufacturer_1C_ID)
					{

						# Если в производителях находим по имении производителя из 1С
						if (isset($manufacturer[(string)$sv_data->Значение]))
						{
							$products[$owner]['manufacturer']	=	$manufacturer[(string)$sv_data->Значение];
						}
						else
						{
							# В противном случае создаем новый элемент и получаем его id
							$products[$owner]['manufacturer']	=	manufacturer_create((string)$sv_data->Значение);
							# Дополним таблицу производителей новым элементом
							$manufacturer[(string)$sv_data->Значение]=$products [$owner] ['manufacturer'];
						}
					}
				}
			}
			if (isset($product_data->СтавкиНалогов))
			{
				foreach ($product_data->СтавкиНалогов->СтавкаНалога as $snalog)
				{
					$products [$owner] ['СтавкаНалога'] ["$snalog->Наименование"] = "$snalog->Ставка";
				}
			}


			$products[$owner]['picture']	=	(string)$product_data->Картинка;



			$Qselect = $osC_Database->query('
			SELECT a.products_id FROM :cat a INNER JOIN :cat1 b ON b.products_id = a.products_id
			WHERE b.products_model = :article AND a.language_id = :language_id LIMIT 1');

			$Qselect->bindTable(':cat1', TABLE_PRODUCTS);
			$Qselect->bindTable(':cat', TABLE_PRODUCTS_DESCRIPTION);
			$Qselect->bindInt(':language_id', FIX_LANGUAGE);
			$Qselect->bindValue(':article', $products[$owner]['Артикул']);
			$Qselect->execute();

			$rows_sub_Count = $Qselect->NumberOfRows();
			# Если товар  по артикулу есть в базе то мы не меняем id товара , а берем его id
			if (( $rows_sub_Count >0)) {

				_Log('tovar naiden ' . ' ' .  $rows_sub_Count);
				$products [$owner] ['product_id'] = ( int ) $rows_sub_Count;
				$Qupdate = $osC_Database->query('
				UPDATE :cat SET products_name=:name,products_description=:desc WHERE products_id = :products_id');

				$Qupdate->bindTable(':cat', TABLE_PRODUCTS_DESCRIPTION);
				$Qupdate->bindInt(':languages_id', FIX_LANGUAGE);
				$Qupdate->bindInt(':products_id', $products [$owner] ['product_id']);
				$Qupdate->bindValue(':name', $products[$owner]['Наименование']);
				$Qupdate->bindValue(':desc', $products [$owner] ['Реквизиты'] ['Полное наименование']);
				$Qupdate->execute();

				# Связываем товар и группу
				$Qupdate = $osC_Database->query('
				UPDATE :cat SET categories_id=:categories_id WHERE products_id = :products_id');
				$Qupdate->bindTable(':cat', TABLE_PRODUCTS_TO_CATEGORIES);
				$Qupdate->bindInt(':products_id', $products [$owner] ['product_id']);
				$Qupdate->bindInt(':categories_id', $products [$owner] ['Группа']);
				$Qupdate->execute();

			} else // Если товар  по артикулу  не найден в  базе то мы ее создаем
			{

				# Характеристики товара
				if (isset($product_data->ХарактеристикиТовара))
				$has_children=1;
				else
				$has_children=0;

				$products [$owner] ['product_id'] = newProducts (
				0,
				$products [$owner] ['Артикул'],
				$products [$owner] ['Наименование'],
				$products [$owner] ['Реквизиты'] ['Полное наименование'],
				$products [$owner] ['picture'],
				$products [$owner] ['product_ed'],
				$products [$owner] ['manufacturer'],
				$products[$owner]['picture'],
				$has_children );
				_Log('tovar ne naiden create ' . $has_children);
				# Связываем товар и группу
				newProducts_xref ( $products [$owner] ['Группа'], $products [$owner] ['product_id']);
			}

			# Характеристики товара
			if (isset($product_data->ХарактеристикиТовара))
			{
				# Добавим товар на характеристику
				$products [$owner2] ['product_id'] = newProducts ($products [$owner] ['product_id'],
				$products [$owner] ['Артикул'].':e'.$i, $products [$owner] ['Наименование'],
				$products [$owner] ['Реквизиты'] ['Полное наименование'], $products [$owner] ['picture'],
				$products [$owner] ['product_ed'],$products [$owner] ['manufacturer'] ,$products[$owner]['picture'],0);
				_Log('tovar ne naiden create + characteristic ' . $products [$owner2] ['product_id']);
				# Характеристики товара
				products_character($product_data, $products [$owner2]['product_id'], $products [$owner2] ['product_id']);
			}
		}
	}
	return $products;
}
# Создание новой категории
# $owner владелец
# $category_name наименование группы
function newCategory($category_name, $owner) {


	global $osC_Database;

	$Qinstall = $osC_Database->query('insert into :table_templates (parent_id) values (:parent_id)');
	$Qinstall->bindInt(':parent_id', $owner);
	$Qinstall->bindTable(':table_templates', TABLE_CATEGORIES);
	$Qinstall->execute();

	$categories_id	=	$osC_Database->nextID();

	$Qinstall = $osC_Database->query('insert into :table_templates (categories_id,language_id, categories_name)
	values (:categories_id,:language_id, :categories_name)');
	$Qinstall->bindInt(':categories_id', $categories_id);
	$Qinstall->bindInt(':language_id', FIX_LANGUAGE);
	$Qinstall->bindValue(':categories_name', $category_name);
	$Qinstall->bindTable(':table_templates', TABLE_CATEGORIES_DESCRIPTION);
	$Qinstall->execute();

	return $categories_id;
}
# Создание дерева групп
function groups_xref_create($category) {
	global $osC_Database;

	foreach ( $category as $category_data ) {
		$QUpdate = $osC_Database->query('update  :table_templates set
		parent_id= :parent_id,
		sort_order = :sort_order,
		date_added=:date_added,
		last_modified=:last_modified');
		$QUpdate->bindInt(':parent_id', $category_data ['owner']);
		$QUpdate->bindInt(':sort_order', 1);
		$QUpdate->bindDate(':date_added', date('Y-m-d H:i:s'));
		$QUpdate->bindDate(':last_modified', date('Y-m-d H:i:s'));
		$QUpdate->bindTable(':table_templates', TABLE_CATEGORIES);
		$QUpdate->execute();
	}
}
# Обход дерева групп полученных из 1С
function groups_create($xml, $category, $owner) {

	global $osC_Database;

	if (!isset($xml->Группы))

	{
		return $category;
	}

	foreach ($xml->Группы->Группа as $category_data)

	{
		$name 	=(string)$category_data->Наименование;
		$cnt	=(string)$category_data->Ид;

		$category [$cnt] ['name'] = $name;
		$category [$cnt] ['owner'] = $owner;

		$Qselect = $osC_Database->query('SELECT
		a.categories_id FROM  :cat a WHERE  a.language_id = :language_id AND
		a.categories_name=:name');

		$Qselect->bindTable(':cat', TABLE_CATEGORIES_DESCRIPTION);
		$Qselect->bindInt(':language_id', FIX_LANGUAGE);
		$Qselect->bindValue(':name', $name);
		$Qselect->execute();

		$rows_sub_Count = $Qselect->NumberOfRows();

		_Log('group ' . $name . ' find '. $rows_sub_Count);

		// Если группа по имени есть в базе то мы ее не меняем , а берем ее id
		if ($rows_sub_Count>0) {
			_Log('group naidena '.$rows_sub_Count . ' ' . $owner);

			$category [$cnt] ['category_id'] = ( int ) $rows_sub_Count;
			// сразу update категории

			$QUpdate = $osC_Database->query('update  :table_templates set
		parent_id= :parent_id,
		sort_order = :sort_order,
		date_added=:date_added,
		last_modified=:last_modified');
			$QUpdate->bindInt(':parent_id', $owner);
			$QUpdate->bindInt(':sort_order', 1);
			$QUpdate->bindDate(':date_added', date('Y-m-d H:i:s'));
			$QUpdate->bindDate(':last_modified', date('Y-m-d H:i:s'));
			$QUpdate->bindTable(':table_templates', TABLE_CATEGORIES);
			$QUpdate->execute();

		} else // Если группа по имени не найдена базе то мы ее создаем
		{
			$category [$cnt] ['category_id'] = newCategory ($name, $owner );
			_Log('group create'.$category [$cnt] ['category_id'] . ' ' . $owner);
		}
		$category = groups_create ( $category_data, $category, $category [$cnt] ['category_id'] );

	}
	return $category;
}
# Парсинг типов цен
function price_create($xml, $price) {

	if (!isset($xml->ТипыЦен)) return $price;

	$shopper_group_id	=	0;
	# Прочтем все типы цен из offers.xml
	foreach ($xml->ТипыЦен->ТипЦены as $price_data)
	{
		$owner								=(string)$price_data->Ид;
		$price[$owner]['Наименование'] 		=(string)$price_data->Наименование;
		$price[$owner]['Валюта'] 			=(string)$price_data->Валюта;

		if ($price [$owner] ['Наименование'] == FIX_TYPEPRICE) {
			_Log('shopper_group_id  ' . $owner . '' .$price[$owner]['Наименование']);
			$shopper_group_id = $owner;
			break;
		}

	}
	return $shopper_group_id;
}
# Парсинг типов цен на характеристики
function price_tovar_create($xml, $price_tovar, $price_ID) {

	global $products;

	global $osC_Database;

	if (!isset($xml->Предложения)) {
		return '';
	}
	# Перебираем товары
	foreach ($xml->Предложения->Предложение as $price_data)
	{
		$owner = substr((string)$price_data->Ид,0,36);
		$owner2 = (string)$price_data->Ид;
		# наложить цену на характеристики
		# подбор товара по наличию характеристик
		if (isset($products[$owner2]))
		{
			$owner=$owner2;
			_Log('product price add char '.$owner2);
		}

		$price_tovar [$owner] ['product_id'] = $products [$owner] ['product_id'];

		# Перебираем цены на товар

		foreach ($price_data->Цены->Цена as $price_tovar_data)

		{
			_Log('compare ' . $price_ID . ' ' . $price_tovar_data->ИдТипаЦены);
			if ($price_tovar_data->ИдТипаЦены==$price_ID) {
				$price_tovar[$owner]['ЦенаЗаЕдиницу']		=	(int)$price_tovar_data->ЦенаЗаЕдиницу;
				$price_tovar[$owner]['Валюта']				=	(string)$price_tovar_data->Валюта;
				$price_tovar[$owner]['Единица']				=	(string)$price_tovar_data->Единица;
				$price_tovar[$owner]['Коэффициент']			=	(string)$price_tovar_data->Коэффициент;
				$price_tovar[$owner]['Количество']			=	(int)$price_data->Количество;

				$Qupdate = $osC_Database->query('UPDATE ' . TABLE_PRODUCTS . '
				SET products_quantity=:products_quantity ,products_price=' . $price_tovar[$owner]['ЦенаЗаЕдиницу'] .  ' 
				WHERE products_id = :products_id');

				//$Qupdate->bindTable(':cat', 				TABLE_PRODUCTS);
				$Qupdate->bindInt(':products_id', 			$products [$owner] ['product_id']);
				//$Qupdate->bindInt(':manufacturers_id', 			$products [$owner] ['manufacturers']);
				$Qupdate->bindInt(':products_quantity', 	$price_tovar[$owner]['Количество']);
				//$Qupdate->bindInt(':products_quantity', 	1);

				//$Qupdate->bindInt(':products_price', 		$price_tovar[$owner]['ЦенаЗаЕдиницу']);
				$Qupdate->execute();

				break;
			}

		}
	}
	return $price_tovar;
}

# Авторизация osCommerce
function CheckAuthUser() {
	global $osC_Database;

	if (isset($_SERVER['PHP_AUTH_USER'])) {
		$username	=	trim($_SERVER['PHP_AUTH_USER']);
		$password	=	trim($_SERVER['PHP_AUTH_PW']);

		$Qadmin = $osC_Database->query('select user_name, user_password from :table_administrators where user_name = :user_name');
		$Qadmin->bindTable(':table_administrators', TABLE_ADMINISTRATORS);
		$Qadmin->bindValue(':user_name', $username);
		$Qadmin->execute();

		if ($Qadmin->numberOfRows()) {

			$stack = explode(':', $Qadmin->value('user_password'));

			if (sizeof($stack) != 2) return false;

			if (md5($stack[1] . $password) == $stack[0]) {
				return 'success/n';
			}
		}
	}
	return 'failed user name or password/n';
}

//?type=catalog&mode=checkauth
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'catalog'
&& isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'checkauth') {
	print 'success';//print CheckAuthUser();
}
# Авторизация загрузки заказов
# SALE


//?type=sale&mode=checkauth
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'sale'
&& isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'checkauth') {
	print 'success';//print CheckAuthUser();
}

// Передача файлов из 1С о принятых и измененных обменах
// требуется разобраться, что отсылает 1
//?type=sale&mode=file&filename=import.xml
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'sale' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'file' && isset ( $_REQUEST ['filename'] )) {
	$otvet = loadfile ();
	if ($otvet == 'success') {
		$xml = simplexml_load_file ( JPATH_BASE_PICTURE_SMALL . DS . $_REQUEST ['filename'] );
		$doc = array ();
		foreach ($xml->Документ as $docs)
		{
			$num	=	(int)$docs->Номер;
			$doc[$num]['Дата'] 			=	(string)$docs->Дата;
			$doc[$num]['Валюта'] 		=	(string)$docs->Валюта;
			$doc[$num]['Ид'] 			=	(string)$docs->Ид;
			$doc[$num]['Комментарий'] 	=	(string)$docs->Комментарий;
			$doc[$num]['Курс'] 			=	(int)$docs->Курс;
			$doc[$num]['Роль'] 			=	(string)$docs->Роль;
			$doc[$num]['ХозОперация'] 	=	(string)$docs->ХозОперация;
			$doc[$num]['Сумма'] 		=	(int)$docs->Сумма;

			foreach ($docs->ЗначенияРеквизитов->ЗначениеРеквизита as $rec)

			{
				$doc[$num]["$rec->Наименование"] = (string)$rec->Значение;
			}

			#
			# Изменяем статус заказа в osCommerce на статус полученный из 1С
			#"1";"Pending" 		- Обрабатывается
			#"2";"Confirmed" 	- Ожидает оплаты
			#"3";"Shipped"		- Оплачен (по умолчанию)
			#"4";"Cancelled"	- отменять



			if ($doc [$num] ["ПометкаУдаления"] == 'true') {
				$Qupdate = $osC_Database->query('
				UPDATE :cat SET orders_status=4 WHERE orders_id = :order_id');

				$Qupdate->bindTable(':cat', TABLE_ORDERS);
				$Qupdate->bindInt(':order_id', $num);
				$Qupdate->execute();
			}
			if ($doc [$num] ["Проведен"] == 'true') {
				$Qupdate = $osC_Database->query('
				UPDATE :cat SET orders_status=3 WHERE orders_id = :order_id');

				$Qupdate->bindTable(':cat', TABLE_ORDERS);
				$Qupdate->bindInt(':order_id', $num);
				$Qupdate->execute();
			}


			#стираем файл ответа 1С
			if (file_exists ( JPATH_BASE_PICTURE . DS . $_REQUEST ['filename'] )) {
				unlink ( JPATH_BASE_PICTURE . DS . $_REQUEST ['filename'] );
			}
		}
		print "success\n";
	}

	else {
		print "error " . $otvet;
	}
}

//?type=sale&mode=query
// Выгрузка заказов с типом 1
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'sale' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'query') {
	createzakaz ();
	//print 'success';
}

#?type=catalog&mode=export
// экспорт файлов
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'catalog' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'export') {
	print 'success';
}

#?type=catalog&mode=init

if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'catalog' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'init') {
	print "zip=" . FIX_ZIP . "\n" . FIX_ZIPSIZE;
}

# отдаем файлы
#?type=sale&mode=init
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'sale' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'init') {
	//print nl2br("zip=" . FIX_ZIP . "\n"  .	FIX_ZIPSIZE);
	print "zip=" . "no" . "\n" . FIX_ZIPSIZE;
}

// Передача файлов
//?type=catalog&mode=file&filename=import.xml
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'catalog' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'file' && isset ( $_REQUEST ['filename'] )) {
	print loadfile () . "\n" . $_REQUEST ['filename'];
}

// проверка импорт файлов
//?type=catalog&mode=import&filename=import.xml
if (isset ( $_REQUEST ['type'] ) && $_REQUEST ['type'] == 'catalog' && isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'import') {
	$cnt = 0;

	//switch ($_REQUEST['filename']) {
	switch ($_REQUEST ['filename']) {
		case "import.xml" :

			# Все файлы обмена загружены перебираем их и разархивировываем
			$file_txt = scandir ( JPATH_BASE_PICTURE_SMALL ); # получаем массив с именами файлов, из дирректории
			foreach ( $file_txt as $filename_to_save ) # перебираем получишийся массив
			{
				if (substr ( $filename_to_save, - 3 ) == 'zip') {
					# распаковываем архив
					unzip ( $filename_to_save, JPATH_BASE_PICTURE_SMALL . "/" );
					# удаляем полученный архив
					unlink ( JPATH_BASE_PICTURE_SMALL . "/" . $filename_to_save );
				}
			}
			print "success\n";
			break;

		case "offers.xml" :
			if (file_exists ( JPATH_BASE_PICTURE_SMALL . "/" . 'offers.xml' )) {

				# грузим производителей в массив
				$xml = simplexml_load_file ( JPATH_BASE_PICTURE_SMALL . DS . 'import.xml' );
				$clear	=	(string)$xml->Каталог->attributes()->СодержитТолькоИзменения;
				ClearBase ( $clear );
				$manufacturer = LoadmanufacturerName();
				# Парсим свойства товаров ищем ID производителя в свойствах товара
				$manufacturer_1C_ID = property_find($xml->Классификатор);

				readproducts_variants_groups(FIX_LANGUAGE);

				# Парсим группы
				$category = groups_create($xml->Классификатор,	$category ,  0);
				# Пишем группы
				//groups_xref_create ( $category );

				# Парсим продукты
				$products = products_create($xml->Каталог,	$products);

				# Дописываем характеристики
				//Write_product_attribute_sku();
				# Парсим цены
				$xml = simplexml_load_file ( JPATH_BASE_PICTURE_SMALL . DS . 'offers.xml' );
				$clear			=	(bool)$xml->ПакетПредложений->attributes()->СодержитТолькоИзменения;
				#ClearBase2 ( $clear );
				_Log('INTERVAL 2');
				$price_ID  		=	price_create($xml->ПакетПредложений	,	$price);
				_Log('INTERVAL 3 ' . $price_ID);
				$price_tovar  	=	price_tovar_create($xml->ПакетПредложений	,	$price_tovar, $price_ID);
				_Log('INTERVAL 4 ' . print_r($price_tovar,true));
				if (file_exists ( JPATH_BASE_PICTURE_SMALL . DS. 'import.xml' ))
				unlink ( JPATH_BASE_PICTURE_SMALL . DS . "import.xml" );
				if (file_exists ( JPATH_BASE_PICTURE_SMALL . DS . 'offers.xml' )) {
					unlink ( JPATH_BASE_PICTURE_SMALL . DS ."offers.xml" );
				}
				print "success\noffer.xml";
				break;
			}
	}
}
// Возврат результата импорта файла



if (isset ( $_REQUEST ['mode'] ) && $_REQUEST ['mode'] == 'help') {
	print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<body>';
	print "<sup><font color=red>Connect " . FIX_VERSION . "</font> <br />";
	print "Выгрузка/Загрузка в osCommerce 3 по протоколу commerceML 2.х<br />";
	print "Параметры: <br />";
	$phpversion = substr ( PHP_VERSION, 0, 6 );
	print "<ul>";
	print "<li>Версия PHP " . $phpversion . " ";
	if ($phpversion >= 5.2) {
		print "ok";
	} else {
		print "no";
	}
	print "</li>";
	print "<li>Директория для картинок и обмена " . JPATH_BASE_PICTURE_SMALL . " ";
	if (is_writable ( JPATH_BASE_PICTURE_SMALL )) {
		print "ok";
	} else {
		print "no";
	}
	print "</li>";
	print "<li>Директория для картинок превью " . JPATH_BASE_PICTURE_SMALL . " ";
	if (is_writable ( JPATH_BASE_PICTURE_SMALL )) {
		print "ok";
	} else {
		print "no";
	}
	print "</li>";
	print "<li>использовать zip (yes/no) " . FIX_ZIP . "</li>";
	print "<li>Размер zip архива (maxsize) " . FIX_ZIPSIZE / 1024 . " (Кб)</li>";
	print "<li>Charset osCommerce (требуется utf-8) " . osGetCharset (FIX_LANGUAGE) . " ";
	if (strtolower(osGetCharset(FIX_LANGUAGE)) == "utf-8") {
		print "ok";
	} else {
		print "no";
	}
	print "</li></ul>";
	print "Скрипт распространяется под лицензией GPL-3 <br />";
	print "Тестированно на osCommerce 3.0 sp 1.14 <br />";
	print "Автор Перушев В.В. e-mail	homutke@mail.ru 08 мая 2010 Год<br />";
	print "Обсуждение скрипта , дополнения и пожелания можно высказывать по адресу http://infostart.ru/community/groups/622/<br />";
	print "в группе CommerceML<br />";
	print "</sup></body></html>";
}


?>
