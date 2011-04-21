<?php
/*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename view.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tóth
  http://oscommerce-extra.hu
*/

  // requrie the cms class
  require('includes/classes/cms.php');
  
  // initialise the class
  class osC_Cms_View extends osC_Template {

/* Private variables */

    var $_module = 'view',
        $_group = 'cms',
        $_page_title,
        $_page_contents = 'view.php',
        $_page_image = 'table_background_specials.gif';

/* Class constructor */

    function osC_Cms_View() {
      global $osC_Services, $osC_Language, $osC_Breadcrumb, $osC_Cms;
      
   //initialize the page_title
      $QcmsDetails = osC_Cms::getDetails();
      $this->_page_title = $QcmsDetails->value("cms_name");


      if ($osC_Services->isStarted('breadcrumb')) {
        $osC_Breadcrumb->add($QcmsDetails->value("cms_name"), osc_href_link(FILENAME_CMS, $this->_module));
      }
    }
  }
?>
