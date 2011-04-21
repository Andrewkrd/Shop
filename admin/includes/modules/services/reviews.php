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

  class osC_Services_reviews_Admin {
    var $title,
        $description,
        $uninstallable = true,
        $depends,
        $precedes;

    function osC_Services_reviews_Admin() {
      global $osC_Database, $osC_Language;

      $osC_Language->loadIniFile('modules/services/reviews.php');

      $this->title = $osC_Language->get('services_reviews_title');
      $this->description = $osC_Language->get('services_reviews_description');
    
	  $title1 = $osC_Language->get('services_reviews_admin_1');
	  $title2 = $osC_Language->get('services_reviews_admin_2');
	  $title3 = $osC_Language->get('services_reviews_admin_3');
	  $title4 = $osC_Language->get('services_reviews_admin_4');
	  $title5 = $osC_Language->get('services_reviews_admin_5');
	  $title6 = $osC_Language->get('services_reviews_admin_6');	
	  
	$titlex = $osC_Language->get('access_configuration_title27');
	$titley = $osC_Language->get('access_configuration_title93');
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	if (($configuration_title & $configuration_description) != ($titlex & $titley)) {		  

	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title1', configuration_description = '$title4' WHERE configuration_key = 'MAX_DISPLAY_NEW_REVIEWS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title2', configuration_description = '$title5' WHERE configuration_key = 'SERVICE_REVIEW_ENABLE_REVIEWS'");
	  $osC_Database->simpleQuery("UPDATE " . TABLE_CONFIGURATION . " SET configuration_title = '$title3', configuration_description = '$title6' WHERE configuration_key = 'SERVICE_REVIEW_ENABLE_MODERATION'");	  
	
	}
	}

    function install() {
      global $osC_Database;

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Review Level', 'SERVICE_REVIEW_ENABLE_REVIEWS', '1', 'Customer level required to write a review.', '6', '0', 'osc_cfg_set_boolean_value(array(\'0\', \'1\', \'2\'))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Moderate Reviews', 'SERVICE_REVIEW_ENABLE_MODERATION', '-1', 'Should reviews be approved by store admin.', '6', '0', 'osc_cfg_set_boolean_value(array(-1, 0, 1))', now())");
    }

    function remove() {
      global $osC_Database;

      $osC_Database->simpleQuery("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MAX_DISPLAY_NEW_REVIEWS',
                   'SERVICE_REVIEW_ENABLE_REVIEWS',
                   'SERVICE_REVIEW_ENABLE_MODERATION');
    }
  }
?>
