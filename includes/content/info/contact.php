<?php
/*
  $Id: password.php 64 2005-03-12 16:36:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
  require_once("includes/classes/captcha.php");
  class osC_Info_Contact extends osC_Template {

/* Private variables */

    var $_module = 'contact',
        $_group = 'info',
        $_page_title,
        $_page_contents = 'info_contact.php',
        $_page_image = 'table_background_contact_us.gif';

/* Class constructor */

    function osC_Info_Contact() {
      global $osC_Services, $osC_Language, $osC_Breadcrumb;

      $this->_page_title = $osC_Language->get('info_contact_heading');

      if ($osC_Services->isStarted('breadcrumb')) {
        $osC_Breadcrumb->add($osC_Language->get('breadcrumb_contact'), osc_href_link(FILENAME_INFO, $this->_module));
      }

      if ($_GET[$this->_module] == 'process') {
        $this->_process();
      }

      if($_GET[$this->_module] == 'showImage') {
        $this->_generateImage();
      }
    }

/* Private methods */

    function _process() {
      global $osC_Language, $osC_MessageStack; 
	  
      if (isset($_POST['name']) && !empty($_POST['name'])) {
      $name = osc_sanitize_string($_POST['name']);  
      }
      
      if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email_address = osc_sanitize_string($_POST['email']);
        
        if (!osc_validate_email_address($email_address)) {
          $osC_MessageStack->add('contact', $osC_Language->get('field_customer_email_address_check_error'));
        }
      } else {
        $osC_MessageStack->add('contact', $osC_Language->get('field_customer_email_address_check_error'));
      }
	  
      if (isset($_POST['enquiry']) && !empty($_POST['enquiry'])) {
        $enquiry = osc_sanitize_string($_POST['enquiry']);
        
        if (!osc_validate_email_address($enquiry) == 0) {
          $osC_MessageStack->add('contact', $osC_Language->get('field_customer_enquiry_check_error'));
        }
      } else {
        $osC_MessageStack->add('contact', $osC_Language->get('field_customer_enquiry_check_error'));
      }	  
      
              if (isset($_POST['concat_code']) && !empty($_POST['concat_code'])) {
          $concat_code = osc_sanitize_string($_POST['concat_code']);
          
          if ( !strcasecmp($concat_code, $_SESSION['verify_code']) == 0 ) {
            $osC_MessageStack->add('contact', $osC_Language->get('field_concat_captcha_check_error'));
          }
        } else {
          $osC_MessageStack->add('contact', $osC_Language->get('field_concat_captcha_check_error'));
        }
        
      if ( $osC_MessageStack->size('contact') === 0 ) {
        osc_email(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $osC_Language->get('contact_email_subject'), $enquiry, $name, $email_address);
        osc_redirect(osc_href_link(FILENAME_INFO, 'contact=success', 'AUTO'));    
      } 
    }
    
    function _generateImage() {
      $captcha = new osC_Captcha();
      $_SESSION['verify_code'] = $captcha->getCode(); 
      
      $captcha->genCaptcha();
    }

    }
?>
