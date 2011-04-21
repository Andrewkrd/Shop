<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
  RuBiC modding (http://www.rubicshop.ru)  
*/


  class osC_Content_cms_sitemap extends osC_Modules {
    var $_title,
        $_code = 'cms_sitemap',
        $_author_name = 'Gergely and RuBiC (modding)',
        $_author_www = 'http://www.oscommerce-extra.hu and http://www.rubicshop.ru',
        $_group = 'content';

/* Class constructor */

    function osC_Content_cms_sitemap() {
      global $osC_Language, $osC_Database;
	  
	$title1 = $osC_Language->get('cms_sitemap_title1');
	$title2 = $osC_Language->get('cms_sitemap_title2');
	
		$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title1', configuration_description = '$title2' WHERE configuration_key = 'MODULE_CONTENT_ARTICLES_TOPIC_DISPLAY'");

      $this->_title = $osC_Language->get('cms_sitemap_title');

    }

    function initialize() {
      global $osC_Database, $osC_Language;
	  

 		$QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id order by date_added DESC');
		$QcmsList->bindTable(':table_cms', TABLE_CMS);
		$QcmsList->bindInt(':language_id', $osC_Language->getID());
		$QcmsList->execute();

        $this->_content = '<ul>';
						  
	    while ($QcmsList->next()) {
            $this->_content .= '<li>' . osc_link_object(osc_href_link(FILENAME_CMS, 'view=' . 
                               $QcmsList->value('cms_id')), $QcmsList->value('cms_name')) . '</li>';
        
        }
        
        $this->_content .= '</ul>';
    }


    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('List Articles with topics', 'MODULE_CONTENT_ARTICLES_TOPIC_DISPLAY', -1 , 'Display articles in topics', '6', '0','osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CMS Page List Size', 'MAX_DISPLAY_CMS_ARTICLES', '5', 'The number of cms articles to display on one page.', '6', '0', now())");

    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_CONTENT_ARTICLES_TOPIC_DISPLAY',
                             'MAX_DISPLAY_CMS_ARTICLES');
      }

      return $this->_keys;
    }
  }
?>
