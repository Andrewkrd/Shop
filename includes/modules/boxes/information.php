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

  class osC_Boxes_information extends osC_Modules {
    var $_title,
        $_code = 'information',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_group = 'boxes';

    function osC_Boxes_information() {
      global $osC_Language;
      
      $this->_title = $osC_Language->get('box_information_heading');
    }

    function initialize() {
      global $osC_Database, $osC_Language;

      $this->_title_link = osc_href_link(FILENAME_INFO);
      
      $QinfoBuild = $osC_Database->query('select info_id as id , info_name as text from :table_info where language_id = :language_id and active = 1 order by sort_order ASC');
      $QinfoBuild->bindTable(':table_info', TABLE_INFO);
      $QinfoBuild->bindInt(':language_id', $osC_Language->getID());
      $QinfoBuild->execute();

      $this->_content = '<ol>';
      while ($QinfoBuild->next()) {
        
        $this->_content .= '<li>' . osc_link_object(osc_href_link(FILENAME_INFO, 'view=' . $QinfoBuild->value("id")), $QinfoBuild->value("text")) . '</li>';
      }
            $QinfoBuild->freeResult();
      $this->_content .= '  <li>' . osc_link_object(osc_href_link(FILENAME_INFO, 'contact'), $osC_Language->get('box_information_contact')) . '</li>' .
                        '  <li>' . osc_link_object(osc_href_link(FILENAME_INFO, 'sitemap'), $osC_Language->get('box_information_sitemap')) . '</li>' .
                        '</ol>';
    }
  }
?>
