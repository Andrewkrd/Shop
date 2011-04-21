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

  class osC_Services_whos_online_Admin {
    var $title,
        $description,
        $uninstallable = true,
        $depends = array('session', 'core'),
        $precedes;

    function osC_Services_whos_online_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/whos_online.php');

      $this->title = $osC_Language->get('services_whos_online_title');
      $this->description = $osC_Language->get('services_whos_online_description');
    
	  $title1 = $osC_Language->get('services_whos_online_admin_1');
	  $title2 = $osC_Language->get('services_whos_online_admin_2');	
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  
	  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title2' WHERE configuration_key = 'SERVICE_WHOS_ONLINE_SPIDER_DETECTION'");	  
	
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Detect Search Engine Spider Robots', 'SERVICE_WHOS_ONLINE_SPIDER_DETECTION', '1', 'Detect search engine spider robots (GoogleBot, Yahoo, etc).', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('SERVICE_WHOS_ONLINE_SPIDER_DETECTION');
    }
  }
?>
