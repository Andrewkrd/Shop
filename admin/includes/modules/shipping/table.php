<?php
/*
  $Id: table.php 440 2006-02-19 18:40:20Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Shipping_table extends osC_Shipping_Admin {
    var $icon;

    var $_title,
        $_code = 'table',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_status = false,
        $_sort_order;

// class constructor
    function osC_Shipping_table() {
      global $osC_Database, $osC_Language;

      $this->icon = '';

      $this->_title = $osC_Language->get('shipping_table_title');
      $this->_description = $osC_Language->get('shipping_table_description');
      $this->_status = (defined('MODULE_SHIPPING_TABLE_STATUS') && (MODULE_SHIPPING_TABLE_STATUS == '1') ? true : false);
      $this->_sort_order = (defined('MODULE_SHIPPING_TABLE_SORT_ORDER') ? MODULE_SHIPPING_TABLE_SORT_ORDER : null);
    
	  $title1 = $osC_Language->get('shipping_table_admin_1');
	  $title2 = $osC_Language->get('shipping_table_admin_2');
	  $title3 = $osC_Language->get('shipping_table_admin_3');
	  $title4 = $osC_Language->get('shipping_table_admin_4');
	  $title5 = $osC_Language->get('shipping_table_admin_5');
	  $title6 = $osC_Language->get('shipping_table_admin_6');
	  $title7 = $osC_Language->get('shipping_table_admin_7');
	  $title8 = $osC_Language->get('shipping_table_admin_8');
	  $title9 = $osC_Language->get('shipping_table_admin_9');
	  $title10 = $osC_Language->get('shipping_table_admin_10');	
	  $title11 = $osC_Language->get('shipping_table_admin_11');
	  $title12 = $osC_Language->get('shipping_table_admin_12');	
	  $title13 = $osC_Language->get('shipping_table_admin_13');
	  $title14 = $osC_Language->get('shipping_table_admin_14');
	  $title15 = $osC_Language->get('shipping_table_admin_15');
	  $title16 = $osC_Language->get('shipping_table_admin_16');	

	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {	  
	  
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title9' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_STATUS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title10' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_COST'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title11' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_MODE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title12' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_HANDLING'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title13' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_TAX_CLASS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_description = '$title14' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_ZONE'");		
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title15' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_SORT_ORDER'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title8', configuration_description = '$title16' WHERE configuration_key = 'MODULE_SHIPPING_TABLE_WEIGHT_UNIT'");		  
	
	}  
	}

// class methods
    function isInstalled() {
      return (bool)defined('MODULE_SHIPPING_TABLE_STATUS');
    }

    function install() {
      global $osC_Database, $osC_Language;

      parent::install();	  

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Table Method', 'MODULE_SHIPPING_TABLE_STATUS', '1', 'Do you want to offer table rate shipping?', '6', '0', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shipping Table', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Table Method', 'MODULE_SHIPPING_TABLE_MODE', '10', 'The shipping cost is based on the order total or the total weight of the items ordered.', '6', '0', 'osc_cfg_set_boolean_value(array(10, 11))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handling Fee', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Handling fee for this shipping method.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'osc_cfg_use_get_tax_class_title', 'osc_cfg_set_tax_classes_pull_down_menu', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'osc_cfg_use_get_zone_class_title', 'osc_cfg_set_zone_classes_pull_down_menu', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Module weight Unit', 'MODULE_SHIPPING_TABLE_WEIGHT_UNIT', '2', 'What unit of weight does this shipping module use?.', '6', '0', 'osC_Weight::getTitle', 'osc_cfg_set_weight_classes_pulldown_menu', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_SHIPPING_TABLE_STATUS',
                             'MODULE_SHIPPING_TABLE_COST',
                             'MODULE_SHIPPING_TABLE_MODE',
                             'MODULE_SHIPPING_TABLE_HANDLING',
                             'MODULE_SHIPPING_TABLE_TAX_CLASS',
                             'MODULE_SHIPPING_TABLE_ZONE',
                             'MODULE_SHIPPING_TABLE_SORT_ORDER',
                             'MODULE_SHIPPING_TABLE_WEIGHT_UNIT');
      }

      return $this->_keys;
    }
  }
?>
