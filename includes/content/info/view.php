<?php

  // requrie the info class
  require('includes/classes/info.php');
  
  // initialise the class
  class osC_Info_View extends osC_Template {

/* Private variables */

    var $_module = 'view',
        $_group = 'info',
        $_page_title,
        $_page_contents = 'view.php',
        $_page_image = 'table_background_specials.gif';

/* Class constructor */

    function osC_Info_View() {
      global $osC_Services, $osC_Language, $osC_Breadcrumb, $osC_Info;
      
   //initialize the page_title
      $QinfoDetails = osC_Info::getDetails();
      $this->_page_title = $QinfoDetails->value("info_name");


      if ($osC_Services->isStarted('breadcrumb')) {
        $osC_Breadcrumb->add($QinfoDetails->value("info_name"), osc_href_link(FILENAME_INFO, $this->_module));
      }
    }
  }
?>
