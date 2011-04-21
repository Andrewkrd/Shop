<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_OrderTotal_low_order_fee extends osC_OrderTotal_Admin {
    var $_title,
        $_code = 'low_order_fee',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_status = false,
        $_sort_order;

    function osC_OrderTotal_low_order_fee() {
      global $osC_Database, $osC_Language;

      $this->_title = $osC_Language->get('order_total_loworderfee_title');
      $this->_description = $osC_Language->get('order_total_loworderfee_description');
      $this->_status = (defined('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS') && (MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS == '1') ? true : false);
      $this->_sort_order = (defined('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER') ? MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER : null);
    
	  $title1 = $osC_Language->get('order_total_loworderfee_admin_1');
	  $title2 = $osC_Language->get('order_total_loworderfee_admin_2');
	  $title3 = $osC_Language->get('order_total_loworderfee_admin_3');
	  $title4 = $osC_Language->get('order_total_loworderfee_admin_4');
	  $title5 = $osC_Language->get('order_total_loworderfee_admin_5');
	  $title6 = $osC_Language->get('order_total_loworderfee_admin_6');
	  $title7 = $osC_Language->get('order_total_loworderfee_admin_7');
	  $title8 = $osC_Language->get('order_total_loworderfee_admin_8');
	  $title9 = $osC_Language->get('order_total_loworderfee_admin_9');
	  $title10 = $osC_Language->get('order_total_loworderfee_admin_10');
	  $title11 = $osC_Language->get('order_total_loworderfee_admin_11');
	  $title12 = $osC_Language->get('order_total_loworderfee_admin_12');
	  $title13 = $osC_Language->get('order_total_loworderfee_admin_13');
	  $title14 = $osC_Language->get('order_total_loworderfee_admin_14');
	  $national = $osC_Language->get('order_total_loworderfee_admin_15');
	  $international = $osC_Language->get('order_total_loworderfee_admin_16');
	  $both = $osC_Language->get('order_total_loworderfee_admin_17');	

	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title8' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title9' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title10' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title11' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title12' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_value = '$both', configuration_description = '$title13', set_function = 'osc_cfg_set_boolean_value(array(\'$national\', \'$international\', \'$both\'))' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title14' WHERE configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS'");	  
	
	}
	}

    function isInstalled() {
      return (bool)defined('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS');
    }

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', '1', 'Do you want to display the low order fee?', '6', '1', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '4', 'Sort order of display.', '6', '2', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', '-1', 'Do you want to allow low order fees?', '6', '3', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('Order Fee For Orders Under', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Add the low order fee to orders under this amount.', '6', '4', 'currencies->format', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'Low order fee.', '6', '5', 'currencies->format', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Attach Low Order Fee On Orders Made', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'Attach low order fee for orders sent to the set destination.', '6', '6', 'osc_cfg_set_boolean_value(array(\'national\', \'international\', \'both\'))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'Use the following tax class on the low order fee.', '6', '7', 'osc_cfg_use_get_tax_class_title', 'osc_cfg_set_tax_classes_pull_down_menu', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION',
                             'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS');
      }

      return $this->_keys;
    }
  }
?>
