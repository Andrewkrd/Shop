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

  class osC_Content_cms_xsell extends osC_Modules {
    var $_title,
        $_code = 'cms_xsell',
        $_author_name = 'Gergely and RuBiC (modding)',
        $_author_www = 'ttp://www.oscommerce-extra.hu and http://www.rubicshop.ru',
        $_group = 'content';

/* Class constructor */

    function osC_Content_cms_xsell() {
      global $osC_Language;

      /* must need languages cms_xsell.xml in languages directory */
      $this->_title = $osC_Language->get('cms_xsell_title');


    }

    function initialize() {
      global $osC_Database, $osC_Language, $osc_Product, $osC_Session;
      
      if (empty($_GET) === false) {  
        $id = false;

// PHP < 5.0.2; array_slice() does not preserve keys and will not work with numerical key values, so foreach() is used
        foreach ($_GET as $key => $value) {
          if ( (preg_match('/^[0-9]+(#?([0-9]+:?[0-9]+)+(;?([0-9]+:?[0-9]+)+)*)*$/', $key) || preg_match('/^[a-zA-Z0-9 -_]*$/', $key)) && ($key != $osC_Session->getName()) ) {
            $id = $key;
          }

          break;
        }
        
        $XcmsList = $osC_Database->query('select c.cms_name, cx.cms_id from :table_cms c left join :table_xsell cx on (c.cms_id = cx.cms_id and c.language_id = :cmslanguage_id) left join :table_productsdesc p on (cx.xsell_id = p.products_id) where p.products_keyword = :products_key and p.language_id = :language_id and  c.active = :default_active');

		$XcmsList->bindTable(':table_cms', TABLE_CMS);
		$XcmsList->bindTable(':table_xsell', TABLE_CMS_XSELL);
		$XcmsList->bindTable(':table_productsdesc', TABLE_PRODUCTS_DESCRIPTION);        
		$XcmsList->bindInt(':default_active', 1);
		$XcmsList->bindInt(':language_id', $osC_Language->getID());
		$XcmsList->bindInt(':cmslanguage_id', $osC_Language->getID());        
        $XcmsList->bindValue(':products_key', $id);
         
        $XcmsList->appendQuery('order by c.date_added DESC');
        
		$XcmsList->execute();
        
		if ( empty($id) == false ) {
        
            while ($XcmsList->next()) {
            $this->_content .= '<div style="right: with; 49%;">' .
						  '<ul>';
                   $this->_content .= '<li>' . osc_link_object(osc_href_link(FILENAME_CMS, 'view=' . 
                                      $XcmsList->value('cms_id')), $XcmsList->value('cms_name')) . '</li>';
            $this->_content .= '</ul>' .
                            '</div>';
            }
        }
      }
    }


    function install() {
      global $osC_Database;

      parent::install();

//      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('List Articles with topics', 'MODULE_CONTENT_ARTICLES_TOPIC_DISPLAY', -1 , 'Display articles in topics', '6', '0','osc_cfg_use_get_boolean_value', 'osc_cfg_set_boolean_value(array(1, -1))', now())");

    }

    function getKeys() {
 //     if (!isset($this->_keys)) {
 //       $this->_keys = array('MODULE_CONTENT_ARTICLES_TOPIC_DISPLAY');
 //     }

      return $this->_keys;
    }
  }
?>
