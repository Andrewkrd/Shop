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

  class osC_Services_session_Admin {
    var $title,
        $description,
        $uninstallable = false,
        $depends,
        $precedes;

    function osC_Services_session_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/session.php');

      $this->title = $osC_Language->get('services_session_title');
      $this->description = $osC_Language->get('services_session_description');
    
	  $title1 = $osC_Language->get('services_session_admin_1');
	  $title2 = $osC_Language->get('services_session_admin_2');
	  $title3 = $osC_Language->get('services_session_admin_3');
	  $title4 = $osC_Language->get('services_session_admin_4');
	  $title5 = $osC_Language->get('services_session_admin_5');
	  $title6 = $osC_Language->get('services_session_admin_6');
	  $title7 = $osC_Language->get('services_session_admin_7');
	  $title8 = $osC_Language->get('services_session_admin_8');
	  $title9 = $osC_Language->get('services_session_admin_9');
	  $title10 = $osC_Language->get('services_session_admin_10');
	  $title11 = $osC_Language->get('services_session_admin_11');
	  $title12 = $osC_Language->get('services_session_admin_12');
	  $title13 = $osC_Language->get('services_session_admin_13');
	  $title14 = $osC_Language->get('services_session_admin_14');
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title8' WHERE configuration_key = 'SERVICE_SESSION_EXPIRATION_TIME'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title9' WHERE configuration_key = 'SERVICE_SESSION_FORCE_COOKIE_USAGE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title10' WHERE configuration_key = 'SERVICE_SESSION_BLOCK_SPIDERS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title11' WHERE configuration_key = 'SERVICE_SESSION_CHECK_SSL_SESSION_ID'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title12' WHERE configuration_key = 'SERVICE_SESSION_CHECK_USER_AGENT'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_description = '$title13' WHERE configuration_key = 'SERVICE_SESSION_CHECK_IP_ADDRESS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title14' WHERE configuration_key = 'SERVICE_SESSION_REGENERATE_ID'");	  
	
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Session Expiration Time', 'SERVICE_SESSION_EXPIRATION_TIME', '30', 'The time (in minutes) to keep sessions active for. A value of 0 means until the browser is closed.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Force Cookie Usage', 'SERVICE_SESSION_FORCE_COOKIE_USAGE', '-1', 'Only start a session when cookies are enabled.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Block Search Engine Spiders', 'SERVICE_SESSION_BLOCK_SPIDERS', '-1', 'Block search engine spider robots from starting a session.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check SSL Session ID', 'SERVICE_SESSION_CHECK_SSL_SESSION_ID', '-1', 'Check the SSL_SESSION_ID on every secure HTTPS page request.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check User Agent', 'SERVICE_SESSION_CHECK_USER_AGENT', '-1', 'Check the browser user agent on every page request.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Check IP Address', 'SERVICE_SESSION_CHECK_IP_ADDRESS', '-1', 'Check the IP address on every page request.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Regenerate Session ID', 'SERVICE_SESSION_REGENERATE_ID', '-1', 'Regenerate the session ID when a customer logs on or creates an account.', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('SERVICE_SESSION_EXPIRATION_TIME',
                   'SERVICE_SESSION_FORCE_COOKIE_USAGE',
                   'SERVICE_SESSION_BLOCK_SPIDERS',
                   'SERVICE_SESSION_CHECK_SSL_SESSION_ID',
                   'SERVICE_SESSION_CHECK_USER_AGENT',
                   'SERVICE_SESSION_CHECK_IP_ADDRESS',
                   'SERVICE_SESSION_REGENERATE_ID');
    }
  }
?>
