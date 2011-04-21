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

  class osC_Content_cms_xsell_products extends osC_Modules {
    var $_title,
        $_code = 'cms_xsell_products',
        $_author_name = 'Gergely and RuBiC (modding)',
        $_author_www = 'ttp://www.oscommerce-extra.hu and http://www.rubicshop.ru',
        $_group = 'content';

/* Class constructor */

    function osC_Content_cms_xsell_products() {
      global $osC_Language;

      /* must need languages cms_xsell.xml in languages directory */
      $this->_title = $osC_Language->get('cms_xsell_products_title');


    }

    function initialize() {
      global $osC_Database, $osC_Language, $osc_Product, $osC_Session, $osC_Image;
      
      if (isset($_GET['view'])) {  
        $id = $_GET['view'];
        }

        $XcmsList = $osC_Database->query('select p.products_name, p.products_id, p.products_keyword, pi.image, s.products_status from :table_productsdesc p left join :table_xsell cx on (p.products_id = cx.xsell_id) left join :table_images pi on (cx.xsell_id = pi.products_id) left join :table_products s on (cx.xsell_id = s.products_id) where s.products_status = 1 and cx.cms_id = :cms_key and p.language_id = :language_id');
        
		$XcmsList->bindTable(':table_images', TABLE_PRODUCTS_IMAGES);
		$XcmsList->bindTable(':table_xsell', TABLE_CMS_XSELL);
		$XcmsList->bindTable(':table_productsdesc', TABLE_PRODUCTS_DESCRIPTION);    
		$XcmsList->bindTable(':table_products', TABLE_PRODUCTS);      
		$XcmsList->bindInt(':language_id', $osC_Language->getID());
        $XcmsList->bindValue(':cms_key', $id);
         
        $XcmsList->appendQuery('group by pi.products_id order by cx.sort_order');
        
		$XcmsList->execute();
        
		if ( empty($id) == false ) {
        
            while ($XcmsList->next()) {
					$this->_content .= '<div style="right: with; 49%;">' .
						  '<ol style="list-style: none; margin: 5; padding: 0;">';
                   $this->_content .= '<li style="padding-bottom: 25px;">' . osc_link_object(osc_href_link(FILENAME_PRODUCTS,
                                      $XcmsList->value('products_keyword')), $XcmsList->value('products_name'));
                   $this->_content .= '<span style="float: left; width: ' . ($osC_Image->getWidth('mini') + 15) . 'px; text-align: center;">' . osc_link_object(osc_href_link(FILENAME_PRODUCTS, $XcmsList->value('products_keyword')), $osC_Image->show($XcmsList->value('image'), $XcmsList->value('products_name'), null, 'mini')) . '</span>' . '</li>';
           $this->_content .= '</ol>' .
                            '</div>';
            }
            
        } else {
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
