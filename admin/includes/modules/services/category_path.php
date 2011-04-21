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

  class osC_Services_category_path_Admin {
    var $title,
        $description,
        $uninstallable = false,
        $depends,
        $precedes;

    function osC_Services_category_path_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/category_path.php');

      $this->title = $osC_Language->get('services_category_path_title');
      $this->description = $osC_Language->get('services_category_path_description');
    
	  $title1 = $osC_Language->get('services_category_path_admin_1');
	  $title2 = $osC_Language->get('services_category_path_admin_2');
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  
	  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title2' WHERE configuration_key = 'SERVICES_CATEGORY_PATH_CALCULATE_PRODUCT_COUNT'");  	
	
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Calculate Number Of Products In Each Category', 'SERVICES_CATEGORY_PATH_CALCULATE_PRODUCT_COUNT', '1', 'Recursively calculate how many products are in each category.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('SERVICES_CATEGORY_PATH_CALCULATE_PRODUCT_COUNT');
    }
  }
?>
