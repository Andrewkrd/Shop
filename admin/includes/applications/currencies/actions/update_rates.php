<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
    -----------------------------
    Module Currencies v. 1.01
	for osCommerce 3.0
	-----------------------------
	Author by Alexander Kholodov
	02.02.2011
	E-mail: micromail@mail.ru
	http://oscommerce-3.spb.ru
	ICQ 264957087
	Category: Paid
	-----------------------------
*/

  class osC_Application_Currencies_Actions_update_rates extends osC_Application_Currencies {
    public function __construct() {
      global $osC_Language, $osC_MessageStack;

      parent::__construct();

      $this->_page_contents = 'update_rates.php';

      if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'confirm') ) {
        if ( isset($_POST['service']) && (($_POST['service'] == 'cbr') || ($_POST['service'] == 'nbrb') || ($_POST['service'] == 'nbu') || ($_POST['service'] == 'bnm') || ($_POST['service'] == 'xe') || ($_POST['service'] == 'oanda')) ) {
          $results = osC_Currencies_Admin::updateRates($_POST['service']);

          foreach ( $results[0] as $result ) {
            $osC_MessageStack->add($this->_module, sprintf($osC_Language->get('ms_error_invalid_currency'), $result['title'], $result['code']), 'error');
          }

          foreach ( $results[1] as $result ) {
            $osC_MessageStack->add($this->_module, sprintf($osC_Language->get('ms_success_currency_updated'), $result['title'], $result['code']), 'success');
          }
        }

        osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module));
      }
    }
  }
?>
