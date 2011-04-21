<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

/**
 * The administration side of the ChronoPay payment module
 */

  class osC_Payment_chronopay extends osC_Payment_Admin {

/**
 * The administrative title of the payment module
 *
 * @var string
 * @access private
 */

    var $_title;

/**
 * The code of the payment module
 *
 * @var string
 * @access private
 */

    var $_code = 'chronopay';

/**
 * The developers name
 *
 * @var string
 * @access private
 */

    var $_author_name = 'osCommerce';

/**
 * The developers address
 *
 * @var string
 * @access private
 */

    var $_author_www = 'http://www.oscommerce.com';

/**
 * The status of the module
 *
 * @var boolean
 * @access private
 */

    var $_status = false;

/**
 * Constructor
 */

    function osC_Payment_chronopay() {
      global $osC_Database, $osC_Language;

      $this->_title = $osC_Language->get('payment_chronopay_title');
      $this->_description = $osC_Language->get('payment_chronopay_description');
      $this->_method_title = $osC_Language->get('payment_chronopay_method_title');
      $this->_status = (defined('MODULE_PAYMENT_CHRONOPAY_STATUS') && (MODULE_PAYMENT_CHRONOPAY_STATUS == '1') ? true : false);
      $this->_sort_order = (defined('MODULE_PAYMENT_CHRONOPAY_SORT_ORDER') ? MODULE_PAYMENT_CHRONOPAY_SORT_ORDER : null);
    
	  $title1 = $osC_Language->get('payment_chronopay_admin_1');
	  $title2 = $osC_Language->get('payment_chronopay_admin_2');
	  $title3 = $osC_Language->get('payment_chronopay_admin_3');
	  $title4 = $osC_Language->get('payment_chronopay_admin_4');
	  $title5 = $osC_Language->get('payment_chronopay_admin_5');
	  $title6 = $osC_Language->get('payment_chronopay_admin_6');
	  $title7 = $osC_Language->get('payment_chronopay_admin_7');
	  $title8 = $osC_Language->get('payment_chronopay_admin_8');
	  $title9 = $osC_Language->get('payment_chronopay_admin_9');
	  $title10 = $osC_Language->get('payment_chronopay_admin_10');
	  $title11 = $osC_Language->get('payment_chronopay_admin_11');
	  $title12 = $osC_Language->get('payment_chronopay_admin_12'); 
	  $title13 = $osC_Language->get('payment_chronopay_admin_13');
	  $title14 = $osC_Language->get('payment_chronopay_admin_14');	

	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title8' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_STATUS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title9' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_PRODUCT_ID'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title10' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_MD5_HASH'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title4', configuration_description = '$title11' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_CURRENCY'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title12' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_SORT_ORDER'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title6', configuration_description = '$title13' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_ZONE'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title14' WHERE configuration_key = 'MODULE_PAYMENT_CHRONOPAY_ORDER_STATUS_ID'");	  
	
	}
	}

/**
 * Checks to see if the module has been installed
 *
 * @access public
 * @return boolean
 */

    function isInstalled() {
      return (bool)defined('MODULE_PAYMENT_CHRONOPAY_STATUS');
    }

/**
 * Installs the module
 *
 * @access public
 * @see osC_Payment_Admin::install()
 */

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Enable ChronoPay Payments', 'MODULE_PAYMENT_CHRONOPAY_STATUS', '-1', 'Do you want to accept ChronoPay payments?', '6', '0', 'osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ChronoPay Product ID', 'MODULE_PAYMENT_CHRONOPAY_PRODUCT_ID', '', 'The product ID to assign transactions to.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MD5 Hash Signature', 'MODULE_PAYMENT_CHRONOPAY_MD5_HASH', '', 'Use this value to verify transactions with.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Currency', 'MODULE_PAYMENT_CHRONOPAY_CURRENCY', 'USD', 'The currency to use for credit card transactions', '6', '0', 'osc_cfg_set_boolean_value(array(14,\'USD\',\'EUR\'))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_CHRONOPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_CHRONOPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '0', 'osc_cfg_use_get_zone_class_title', 'osc_cfg_set_zone_classes_pull_down_menu', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_CHRONOPAY_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'osc_cfg_set_order_statuses_pull_down_menu', 'osc_cfg_use_get_order_status_title', now())");
    }

/**
 * Return the configuration parameter keys in an array
 *
 * @access public
 * @return array
 */

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_PAYMENT_CHRONOPAY_STATUS',
                             'MODULE_PAYMENT_CHRONOPAY_PRODUCT_ID',
                             'MODULE_PAYMENT_CHRONOPAY_MD5_HASH',
                             'MODULE_PAYMENT_CHRONOPAY_CURRENCY',
                             'MODULE_PAYMENT_CHRONOPAY_ZONE',
                             'MODULE_PAYMENT_CHRONOPAY_ORDER_STATUS_ID',
                             'MODULE_PAYMENT_CHRONOPAY_SORT_ORDER');
      }

      return $this->_keys;
    }
  }
?>
