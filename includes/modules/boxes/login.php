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

  class osC_Boxes_login extends osC_Modules {
    var $_title,
        $_code = 'login',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_group = 'boxes';

    function osC_Boxes_login() {
      global $osC_Language;

      $this->_title = $osC_Language->get('box_login_heading');
    }

    function initialize() {
      global $osC_Language, $osC_Customer, $osC_Template;

      $this->_title_link = osc_href_link(FILENAME_ACCOUNT);
if ($osC_Customer->isLoggedOn()) {
      $this->_content = '<form name="login" action="' . osc_href_link(FILENAME_ACCOUNT, 'logoff', 'SSL') . '" method="post">' .
                        '<center>' . $osC_Template->osc_draw_image_jquery_button(array('icon' => 'arrowreturnthick-1-w', 'title' => $osC_Language->get('sign_out'))) . '</center>' .
                        '</form>';
} else {
	      $this->_content = '<form name="login" action="' . osc_href_link(FILENAME_ACCOUNT, 'login=process', 'SSL') . '" method="post">' .
                        osc_draw_label($osC_Language->get('field_customer_email_address'), 'email_address') . osc_draw_input_field('email_address') .
                        osc_draw_label($osC_Language->get('field_customer_password'), 'password') . osc_draw_password_field('password') . '<br/><br/>' .
                        '<center>' . $osC_Template->osc_draw_image_jquery_button(array('icon' => 'key', 'title' => $osC_Language->get('sign_in'))) . '</center>' .
                        '<center>' . sprintf($osC_Language->get('login_forgotten'), osc_href_link(FILENAME_ACCOUNT, 'password_forgotten', 'SSL')) . '</center>' .
                        '<center>' . osc_link_object(osc_href_link(FILENAME_ACCOUNT, 'create', 'SSL'), $osC_Language->get('box_registr')) . '</center>' .
                        '</form>';
}
    }
  }
?>
