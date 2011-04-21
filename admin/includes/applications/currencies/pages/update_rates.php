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

  $services = array(array('id' => 'cbr',
                          'text' => 'ЦБ РФ (http://www.cbr.ru)'),
					array('id' => 'nbrb',
                          'text' => 'НБ РБ (http://www.nbrb.by)'),					  
					array('id' => 'nbu',
                          'text' => 'НБУ (http://www.bank.gov.ua)'),
					array('id' => 'bnm',
                          'text' => 'НБМ (http://www.bnm.md)'),
				    array('id' => 'oanda',
                          'text' => 'Oanda (http://www.oanda.com)'),
                    array('id' => 'xe',
                          'text' => 'XE (http://www.xe.com)'));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->exists($osC_Template->getModule()) ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('update.png') . ' ' . $osC_Language->get('action_heading_update_rates'); ?></div>
<div class="infoBoxContent">
  <form name="cUpdate" class="dataForm" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&action=update_rates'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_update_exchange_rates'); ?></p>

  <p><?php echo osc_draw_radio_field('service', $services, null, null, '<br />'); ?></p>

  <p><?php echo $osC_Language->get('service_terms_agreement'); ?></p>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_update') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
