<?php
/*
  $Id: flat.php 421 2006-02-08 17:53:17Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  class osC_Shipping_free extends osC_Shipping_Admin {
    var $icon;

    var $_title,
        $_code = 'free',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_status = false,
        $_sort_order;

// class constructor
    function osC_Shipping_free() {
      global $osC_Database, $osC_Language;

      $this->icon = '';

      $this->_title = $osC_Language->get('shipping_free_title');
      $this->_description = $osC_Language->get('shipping_free_description');
      $this->_status = (defined('MODULE_SHIPPING_FREE_STATUS') && (MODULE_SHIPPING_FREE_STATUS == '1') ? true : false);
    
	  $title1 = $osC_Language->get('shipping_free_admin_1');
	  $title2 = $osC_Language->get('shipping_free_admin_2');
	  $title3 = $osC_Language->get('shipping_free_admin_3');
	  $title4 = $osC_Language->get('shipping_free_admin_4');
	  $title5 = $osC_Language->get('shipping_free_admin_5');
	  $title6 = $osC_Language->get('shipping_free_admin_6');
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title4' WHERE configuration_key = 'MODULE_SHIPPING_FREE_STATUS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title5' WHERE configuration_key = 'MODULE_SHIPPING_FREE_MINIMUM_ORDER'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title6' WHERE configuration_key = 'MODULE_SHIPPING_FREE_ZONE'");	  
	
	}
	}

// class methods
    function isInstalled() {
      return (bool)defined('MODULE_SHIPPING_FREE_STATUS');
    }

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Free Shipping', 'MODULE_SHIPPING_FREE_STATUS', '1', 'Do you want to offer flat rate shipping?', '6', '0', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shipping Cost', 'MODULE_SHIPPING_FREE_MINIMUM_ORDER', '20', 'The minimum order amount to apply free shipping to.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_FREE_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'osc_cfg_use_get_zone_class_title', 'osc_cfg_set_zone_classes_pull_down_menu', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_SHIPPING_FREE_STATUS',
                             'MODULE_SHIPPING_FREE_MINIMUM_ORDER',
                             'MODULE_SHIPPING_FREE_ZONE');
      }

      return $this->_keys;
    }
  }
?>
