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

  class osC_Access_Configuration extends osC_Access {
    var $_module = 'configuration',
        $_group = 'configuration',
        $_icon = 'configure.png',
        $_title,
        $_sort_order = 200;

    function osC_Access_Configuration() {
      global $osC_Database, $osC_Language;

      $this->_title = $osC_Language->get('access_configuration_title');

      $this->_subgroups = array();

      $Qgroups = $osC_Database->query('select configuration_group_id, configuration_group_title from :table_configuration_group where visible = 1 order by sort_order, configuration_group_title');
      $Qgroups->bindTable(':table_configuration_group', TABLE_CONFIGURATION_GROUP);
      $Qgroups->execute();


        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title1'),
                                    'identifier' => 'gID=1');
									
        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title2'),
                                    'identifier' => 'gID=2');	

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title3'),
                                    'identifier' => 'gID=3');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title4'),
                                    'identifier' => 'gID=4');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title5'),
                                    'identifier' => 'gID=5');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title7'),
                                    'identifier' => 'gID=7');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title8'),
                                    'identifier' => 'gID=8');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title9'),
                                    'identifier' => 'gID=9');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title12'),
                                    'identifier' => 'gID=12');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title16'),
                                    'identifier' => 'gID=16');

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title17'),
                                    'identifier' => 'gID=17');		

        $this->_subgroups[] = array('icon' => 'configure.png',
                                    'title' => $osC_Language->get('access_configuration_title18'),
                                    'identifier' => 'gID=18');										
      
	  
    }
  }
?>
