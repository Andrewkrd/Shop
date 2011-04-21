<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/


  class osC_Application_Backup extends osC_Template_Admin {

/* Protected variables */

    protected $_module = 'backup',
              $_page_title,
              $_page_contents = 'main.php';

/* Class constructor */

    function __construct() {
      global $osC_Language, $osC_MessageStack;

      $this->_page_title = $osC_Language->get('heading_title');

// check if the backup directory exists
      if ( !osc_empty(DIR_FS_BACKUP) && is_dir(DIR_FS_BACKUP) ) {
        if ( !is_writeable(DIR_FS_BACKUP) ) {
          $osC_MessageStack->add('header', sprintf($osC_Language->get('ms_error_backup_directory_not_writable'), DIR_FS_BACKUP), 'error');
        }
        if ( !is_writeable(DIR_FS_CATALOG.'admin/external/sxd/ses.php') ) {
          $osC_MessageStack->add('header', sprintf($osC_Language->get('ms_error_backup_file_not_writable'), DIR_FS_CATALOG.'admin/external/sxd/ses.php'), 'error');
        }		
      } else {
        $osC_MessageStack->add('header', sprintf($osC_Language->get('ms_error_backup_directory_non_existant'), DIR_FS_BACKUP), 'error');
      }
	
  }
  }
?>
