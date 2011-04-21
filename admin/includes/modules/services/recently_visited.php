<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Services_recently_visited_Admin {
    var $title,
        $description,
        $uninstallable = true,
        $depends = array('session', 'category_path'),
        $precedes;

    function osC_Services_recently_visited_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/recently_visited.php');

      $this->title = $osC_Language->get('services_recently_visited_title');
      $this->description = $osC_Language->get('services_recently_visited_description');
    
	  $title1 = $osC_Language->get('services_recently_visited_admin_1');
	  $title2 = $osC_Language->get('services_recently_visited_admin_2');
	  $title3 = $osC_Language->get('services_recently_visited_admin_3');
	  $title4 = $osC_Language->get('services_recently_visited_admin_4');
	  $title5 = $osC_Language->get('services_recently_visited_admin_5');
	  $title6 = $osC_Language->get('services_recently_visited_admin_6');
	  $title7 = $osC_Language->get('services_recently_visited_admin_7');
	  $title8 = $osC_Language->get('services_recently_visited_admin_8');
	  $title9 = $osC_Language->get('services_recently_visited_admin_9');
	  $title10 = $osC_Language->get('services_recently_visited_admin_10');
	  $title11 = $osC_Language->get('services_recently_visited_admin_11');
	  $title12 = $osC_Language->get('services_recently_visited_admin_12');
	  $title13 = $osC_Language->get('services_recently_visited_admin_13');
	  $title14 = $osC_Language->get('services_recently_visited_admin_14');
	  $title15 = $osC_Language->get('services_recently_visited_admin_15');
	  $title16 = $osC_Language->get('services_recently_visited_admin_16');	
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  
	  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title9' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCTS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title10' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_IMAGES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title11' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_PRICES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title12' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_MAX_PRODUCTS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title13' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_SHOW_CATEGORIES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_description = '$title14' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_MAX_CATEGORIES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title15' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_SHOW_SEARCHES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title8', configuration_description = '$title16' WHERE configuration_key = 'SERVICE_RECENTLY_VISITED_MAX_SEARCHES'");	  
	
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Display latest products', 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCTS', '1', 'Display recently visited products.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Display product images', 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_IMAGES', '1', 'Display the product image.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Display product prices', 'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_PRICES', '1', 'Display the products price.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum products to show', 'SERVICE_RECENTLY_VISITED_MAX_PRODUCTS', '5', 'Maximum number of recently visited products to show', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Display latest categories', 'SERVICE_RECENTLY_VISITED_SHOW_CATEGORIES', '1', 'Display recently visited categories.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum categories to show', 'SERVICE_RECENTLY_VISITED_MAX_CATEGORIES', '3', 'Mazimum number of recently visited categories to show', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Display latest searches', 'SERVICE_RECENTLY_VISITED_SHOW_SEARCHES', '1', 'Show recent searches.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum searches to show', 'SERVICE_RECENTLY_VISITED_MAX_SEARCHES', '3', 'Mazimum number of recent searches to display', '6', '0', now())");
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('SERVICE_RECENTLY_VISITED_SHOW_PRODUCTS',
                   'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_IMAGES',
                   'SERVICE_RECENTLY_VISITED_SHOW_PRODUCT_PRICES',
                   'SERVICE_RECENTLY_VISITED_MAX_PRODUCTS',
                   'SERVICE_RECENTLY_VISITED_SHOW_CATEGORIES',
                   'SERVICE_RECENTLY_VISITED_MAX_CATEGORIES',
                   'SERVICE_RECENTLY_VISITED_SHOW_SEARCHES',
                   'SERVICE_RECENTLY_VISITED_MAX_SEARCHES');
    }
  }
?>
