<?php
/*
 * Quantity Discounts 
 * Version 3.0 for osCommerce 3.0 
 * By Scott Wilson (swguy) 
 * @copyright That Software Guy (www.thatsoftwareguy.com) 
*/

  class osC_OrderTotal_quantity_discounts extends osC_OrderTotal_Admin {
    var $_title,
        $_code = 'quantity_discounts',
        $_author_name = 'That Software Guy',
        $_author_www = 'http://www.thatsoftwareguy.com',
        $_status = false,
        $_sort_order;

    function osC_OrderTotal_quantity_discounts() {
      global $osC_Database, $osC_Language;

      $this->_title = $osC_Language->get('order_total_quantity_discounts_title');
      $this->_description = $osC_Language->get('order_total_quantity_discounts_description');
      $this->_status = (defined('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS') && (MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS == '1') ? true : false);
      $this->_sort_order = (defined('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER') ? MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER : null);
      
	  $title1 = $osC_Language->get('order_total_quantity_discounts_admin_1');
	  $title2 = $osC_Language->get('order_total_quantity_discounts_admin_2');
	  $title3 = $osC_Language->get('order_total_quantity_discounts_admin_3');
	  $title4 = $osC_Language->get('order_total_quantity_discounts_admin_4');
	  $title5 = $osC_Language->get('order_total_quantity_discounts_admin_5');
	  $title6 = $osC_Language->get('order_total_quantity_discounts_admin_6');
	  $title7 = $osC_Language->get('order_total_quantity_discounts_admin_7');
	  $title8 = $osC_Language->get('order_total_quantity_discounts_admin_8');
	  $title9 = $osC_Language->get('order_total_quantity_discounts_admin_9');
	  $title10 = $osC_Language->get('order_total_quantity_discounts_admin_10');
	  $title11 = $osC_Language->get('order_total_quantity_discounts_admin_11');
	  $title12 = $osC_Language->get('order_total_quantity_discounts_admin_12');
	  $title13 = $osC_Language->get('order_total_quantity_discounts_admin_13');
	  $title14 = $osC_Language->get('order_total_quantity_discounts_admin_14');
	  $title15 = $osC_Language->get('order_total_quantity_discounts_admin_15');
	  $title16 = $osC_Language->get('order_total_quantity_discounts_admin_16');
	  $title17 = $osC_Language->get('order_total_quantity_discounts_admin_17');
	  $title18 = $osC_Language->get('order_total_quantity_discounts_admin_18');
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title3' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title4' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title5', configuration_description = '$title6' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_INC_TAX'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title7', configuration_description = '$title8' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_CALC_TAX'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title9', configuration_description = '$title10' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_UNITS'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title11', configuration_description = '$title12' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_TOTAL_BASIS'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title13', configuration_description = '$title14' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_COUNTING_METHOD'");
  	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title15 1', configuration_description = '$title16' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_1'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title15 2', configuration_description = '$title16' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_2'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title15 3', configuration_description = '$title16' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_3'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title15 4', configuration_description = '$title16' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_4'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title15 5', configuration_description = '$title16' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_5'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title17 1', configuration_description = '$title18' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_1'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title17 2', configuration_description = '$title18' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_2'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title17 3', configuration_description = '$title18' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_3'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title17 4', configuration_description = '$title18' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_4'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title17 5', configuration_description = '$title18' WHERE configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_5'");

    }
	}

    function isInstalled() {
      return (bool)defined('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS');
    }

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('&copy; That Software Guy', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS', '1', '', '6', '1','osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER', '0', 'Sort order of display.', '6', '2', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_INC_TAX', '-1', 'Include Tax in calculation.', '6', '3','osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_CALC_TAX', '1', 'Re-Calculate Tax', '6', '3','osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Discount Basis', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_TOTAL_BASIS', '33', 'How quantity totals are computed', '6', '4','osc_cfg_set_boolean_value(array(33, 34, 35))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Discount Units', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_UNITS', '31', 'Are AMOUNT values below expressed as a percentage or as currency units (e.g. dollars)', '6', '4', 'osc_cfg_set_boolean_value(array(30, 31, 32))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Counting Method', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_COUNTING_METHOD', '36', 'Are LEVEL values below expressed in number of items or currency units (e.g. dollars spent)', '6', '4', 'osc_cfg_set_boolean_value(array(30, 36))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 1', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_1', '0', 'Total required to reach this discount level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 1', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_1', '0', 'Percent or amount off at this level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 2', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_2', '0', 'Total required to reach this discount level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 2', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_2', '0', 'Percent or amount off at this level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 3', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_3', '0', 'Total required to reach this discount level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 3', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_3', '0', 'Percent or amount off at this level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 4', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_4', '0', 'Total required to reach this discount level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 4', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_4', '0', 'Percent or amount off at this level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 5', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_5', '0', 'Total required to reach this discount level', '6', '5', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 5', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_5', '0', 'Percent or amount off at this level', '6', '5', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
         $this->_keys = array('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_INC_TAX',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_CALC_TAX',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_UNITS',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_TOTAL_BASIS',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_COUNTING_METHOD',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_1',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_1',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_2',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_2',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_3',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_3',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_4',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_4',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_5',
         'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_5');
      }

      return $this->_keys;
    }
  }
?>
