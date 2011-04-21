<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
  RuBiC production (http://www.rubicshop.ru)  
*/


  class osC_Content_slide_show extends osC_Modules {
    var $_title,
        $_code = 'slide_show',
        $_author_name = 'RuBiC',
        $_author_www = 'http://www.rubicshop.ru',
        $_group = 'content';

/* Class constructor */

    function osC_Content_slide_show() {
      global $osC_Language;

      $this->_title = $osC_Language->get('slide_show_title');
    }

    function initialize() {
      global $osC_Database, $osC_Services, $osC_Language, $osC_Image, $osC_Template;
            
      $Qimages = $osC_Database->query('select image ,image_url from :table_slides where language_id =:language_id and status = 1 order by sort_order desc');
      $Qimages->bindTable(':table_slides', TABLE_SLIDES);
      $Qimages->bindInt(':language_id', $osC_Language->getID());
      $Qimages->setCache('slide-images-' . $osC_Language->getCode());
      $Qimages->execute();

      if ($Qimages->numberOfRows() > 0) {
        $this->_content =
              '<div id="CustomSlideshow" style="width:' . MODULE_CONTENT_SLIDE_SHOW_WIDTH . 'px; height:' . MODULE_CONTENT_SLIDE_SHOW_HEIGHT . 'px">' . "\n";

        while($Qimages->next()){
        	if ($Qimages->value('image_url') == true) {
          $this->_content .= '<span><a href="' . $Qimages->value('image_url') . '">' . osc_image(DIR_WS_IMAGES . $Qimages->value('image')) . '</a></span>' . "\n";
        } else {
          $this->_content .= '<span>' . osc_image(DIR_WS_IMAGES . $Qimages->value('image')) . '</span>' . "\n";
        }}

        $this->_content .=
              '</div>' . "\n" .
            '<script type="text/javascript">//<![CDATA[
	$(document).ready(function(){    
    $(\'#CustomSlideshow\').slideshow({time:' . MODULE_CONTENT_SLIDE_SHOW_INTERVAL . ', effecttime:' . MODULE_CONTENT_SLIDE_SHOW_DURATION . ', effect:\'' . MODULE_CONTENT_SLIDE_SHOW_MODE . '\', width:' . MODULE_CONTENT_SLIDE_SHOW_WIDTH . ', height:' . MODULE_CONTENT_SLIDE_SHOW_HEIGHT . '}).playSlide();
	});
//]]>
</script>'  . "\n";
      }
      $Qimages->freeResult();
    }

    function install() {
      global $osC_Database;

      parent::install();

      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Slide show mode', 'MODULE_CONTENT_SLIDE_SHOW_MODE', 'random', 'Slideshow Mode', '6', '0', 'osc_cfg_set_boolean_value(array(\'random\', \'scrollUp\', \'scrollDown\', \'scrollLeft\', \'scrollRight\', \'fade\', \'growX\', \'growY\', \'zoom\', \'zoomFade\', \'zoomTL\', \'zoomBR\'))', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Image width (px)', 'MODULE_CONTENT_SLIDE_SHOW_WIDTH', '960', 'Image width', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Image height (px)', 'MODULE_CONTENT_SLIDE_SHOW_HEIGHT', '210', 'Image height', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Interval (ms)', 'MODULE_CONTENT_SLIDE_SHOW_INTERVAL', '5000', 'slide show interval', '6', '0', now())");
      $osC_Database->simpleQuery("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Duration (ms)', 'MODULE_CONTENT_SLIDE_SHOW_DURATION', '1000', 'slide show duration', '6', '0', now())");
    }

    function getKeys() {
      if (!isset($this->_keys)) {
        $this->_keys = array('MODULE_CONTENT_SLIDE_SHOW_MODE',
                             'MODULE_CONTENT_SLIDE_SHOW_WIDTH',
                             'MODULE_CONTENT_SLIDE_SHOW_HEIGHT',
                             'MODULE_CONTENT_SLIDE_SHOW_INTERVAL',
                             'MODULE_CONTENT_SLIDE_SHOW_DURATION');
      }

      return $this->_keys;
    }
  }
?>
