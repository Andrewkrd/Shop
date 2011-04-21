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

  class osC_Services_debug_Admin {
    var $title,
        $description,
        $uninstallable = true,
        $depends = 'language',
        $precedes;

    function osC_Services_debug_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/debug.php');

      $this->title = $osC_Language->get('services_debug_title');
      $this->description = $osC_Language->get('services_debug_description');
    
	  $title1 = $osC_Language->get('services_debug_admin_1');
	  $title2 = $osC_Language->get('services_debug_admin_2');
	  $title3 = $osC_Language->get('services_debug_admin_3');
	  $title4 = $osC_Language->get('services_debug_admin_4');
	  $title5 = $osC_Language->get('services_debug_admin_5');
	  $title6 = $osC_Language->get('services_debug_admin_6');
	  $title7 = $osC_Language->get('services_debug_admin_7');
	  $title8 = $osC_Language->get('services_debug_admin_8');
	  $title9 = $osC_Language->get('services_debug_admin_9');
	  $title10 = $osC_Language->get('services_debug_admin_10');
	  $title11 = $osC_Language->get('services_debug_admin_11');
	  $title12 = $osC_Language->get('services_debug_admin_12');
	  $title13 = $osC_Language->get('services_debug_admin_13');
	  $title14 = $osC_Language->get('services_debug_admin_14');
	  $title15 = $osC_Language->get('services_debug_admin_15');
	  $title16 = $osC_Language->get('services_debug_admin_16');
	  $title17 = $osC_Language->get('services_debug_admin_17');
	  $title18 = $osC_Language->get('services_debug_admin_18');
	  $title19 = $osC_Language->get('services_debug_admin_19');
	  $title20 = $osC_Language->get('services_debug_admin_20');	  
	  $title21 = $osC_Language->get('services_debug_admin_21');
	  $title22 = $osC_Language->get('services_debug_admin_22');		

	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  
	  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title11' WHERE configuration_key = 'SERVICE_DEBUG_EXECUTION_TIME_LOG'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title12' WHERE configuration_key = 'SERVICE_DEBUG_EXECUTION_DISPLAY'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title13' WHERE configuration_key = 'SERVICE_DEBUG_LOG_DB_QUERIES'");  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title14' WHERE configuration_key = 'SERVICE_DEBUG_OUTPUT_DB_QUERIES'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title15' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_LOCALE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_description = '$title16' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_INSTALLATION_MODULE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title17' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_CONFIGURATION'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title8', configuration_description = '$title18' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_SESSION_DIRECTORY'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title9', configuration_description = '$title19' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_SESSION_AUTOSTART'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title10', configuration_description = '$title20' WHERE configuration_key = 'SERVICE_DEBUG_CHECK_DOWNLOAD_DIRECTORY'");	
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title21', configuration_description = '$title22' WHERE configuration_key = 'SERVICE_DEBUG_NUMBER_OF_QUERIES'");		  
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Page Execution Time Log File', 'SERVICE_DEBUG_EXECUTION_TIME_LOG', '', 'Location of the page execution time log file (eg, /www/log/page_parse.log).', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Show The Page Execution Time', 'SERVICE_DEBUG_EXECUTION_DISPLAY', '1', 'Show the page execution time.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Log Database Queries', 'SERVICE_DEBUG_LOG_DB_QUERIES', '-1', 'Log all database queries in the page execution time log file.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Show Database Queries', 'SERVICE_DEBUG_OUTPUT_DB_QUERIES', '-1', 'Show all database queries made.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Check Language Locale', 'SERVICE_DEBUG_CHECK_LOCALE', '1', 'Show a warning message if the set language locale does not exist on the server.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check Installation Module', 'SERVICE_DEBUG_CHECK_INSTALLATION_MODULE', '1', 'Show a warning message if the installation module exists.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check Configuration File', 'SERVICE_DEBUG_CHECK_CONFIGURATION', '1', 'Show a warning if the configuration file is writeable.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check Sessions Directory', 'SERVICE_DEBUG_CHECK_SESSION_DIRECTORY', '1', 'Show a warning if the file-based session directory does not exist.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check Sessions Auto Start', 'SERVICE_DEBUG_CHECK_SESSION_AUTOSTART', '1', 'Show a warning if PHP is configured to automatically start sessions.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check Download Directory', 'SERVICE_DEBUG_CHECK_DOWNLOAD_DIRECTORY', '1', 'Show a warning if the digital product download directory does not exist.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Show number of queries', 'SERVICE_DEBUG_NUMBER_OF_QUERIES', '1', 'Show number of queries.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");	  
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('SERVICE_DEBUG_OUTPUT_DB_QUERIES',
				   'SERVICE_DEBUG_NUMBER_OF_QUERIES',
                   'SERVICE_DEBUG_LOG_DB_QUERIES',
                   'SERVICE_DEBUG_EXECUTION_TIME_LOG',
                   'SERVICE_DEBUG_EXECUTION_DISPLAY',
// COMMENTS STRING 'SERVICE_DEBUG_SHOW_DEVELOPMENT_WARNING',
                   'SERVICE_DEBUG_CHECK_LOCALE',
                   'SERVICE_DEBUG_CHECK_INSTALLATION_MODULE',
                   'SERVICE_DEBUG_CHECK_CONFIGURATION',
                   'SERVICE_DEBUG_CHECK_SESSION_DIRECTORY',
                   'SERVICE_DEBUG_CHECK_SESSION_AUTOSTART',
                   'SERVICE_DEBUG_CHECK_DOWNLOAD_DIRECTORY');
    }
  }
?>
