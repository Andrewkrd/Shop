<?php
/*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename cms.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tth
  http://oscommerce-extra.hu
  
  RuBiC modding (http://www.rubicshop.ru)
*/

  class osC_Boxes_cms extends osC_Modules {
    var $_title,
        $_code = 'cms',
        $_author_name = 'Box 25 and RuBiC (modding)',
        $_author_www = 'http://www.box25.net and http://www.rubicshop.ru',
        $_group = 'boxes';

    function osC_Boxes_cms() {
      global $osC_Language, $osC_Database;
	  
	$title1 = $osC_Language->get('cms_read_text_more1');
	$title2 = $osC_Language->get('cms_read_text_more2');
	$title3 = $osC_Language->get('cms_read_text_more3');
	$title4 = $osC_Language->get('cms_read_text_more4');
	
		$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title1', configuration_description = '$title2' WHERE configuration_key = 'BOX_CMS_LIST_SIZE'");
		$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title3', configuration_description = '$title4' WHERE configuration_key = 'MAX_DISPLAY_CMS_ARTICLES'");		

      $this->_title = $osC_Language->get('box_cms_heading');
    }

    function initialize() {
      global $osC_Database, $osC_Language;

	  // build the box title link	
	  $this->_title_link = osc_href_link(FILENAME_CMS);
	  
	  // build the database query
      $QcmsBuild = $osC_Database->query('select cms_id as id , cms_name as text from :table_cms where language_id = :language_id and active = 1 order by date_added DESC LIMIT :box_cms_limit');
      $QcmsBuild->bindTable(':table_cms', TABLE_CMS);
      $QcmsBuild->bindInt(':box_cms_limit', BOX_CMS_LIST_SIZE);
      $QcmsBuild->bindInt(':language_id', $osC_Language->getID());
      $QcmsBuild->execute();

	  // build the output content for the box
      $this->_content = '<ol>';
      while ($QcmsBuild->next()) {
        
        $this->_content .= '<li>'. osc_link_object(osc_href_link(FILENAME_CMS, 'view=' . $QcmsBuild->value("id")), $QcmsBuild->value("text")) . '</li>';
      }

      $QcmsBuild->freeResult();

      $this->_content .= '</ol>';
   
    }

	// administration installation 
    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CMS Box List Size', 'BOX_CMS_LIST_SIZE', '5', 'The number of cms articles to display in box.', '6', '0', now())");

      
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('BOX_CMS_LIST_SIZE');
      }

      return $this->_keys;
    }
  }
?>
