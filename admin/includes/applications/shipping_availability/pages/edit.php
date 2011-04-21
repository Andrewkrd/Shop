<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
  RuBiC modify (http://www.rubicshop.ru)  
*/

  $osC_ObjectInfo = new osC_ObjectInfo(osC_ShippingAvailability_Admin::getData($_GET['osID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('edit.png') . ' ' . $osC_ObjectInfo->get('title'); ?></div>
<div class="infoBoxContent">
  <form name="osEdit" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&osID=' . $osC_ObjectInfo->get('id') . '&action=save'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_edit_shipping_availability'); ?></p>

  <table border="0" width="100%" cellspacing="0" cellpadding="1" class="dataTable">
    <thead>
      <tr>
        <th><div align="left"><?php echo $osC_Language->get('field_name_title'); ?></span></th>
      </tr>
    </thead>
    <tbody>
  
<?php
  $Qsd = $osC_Database->query('select languages_id, title, css_key from :table_shipping_availability where id = :id');
  $Qsd->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
  $Qsd->bindInt(':id', $osC_ObjectInfo->get('id'));
  $Qsd->execute();

  $status_name = array();

  while ( $Qsd->next() ) {
    $status_name[$Qsd->valueInt('languages_id')] = $Qsd->value('title');
    $status_css[$Qsd->valueInt('languages_id')] = $Qsd->value('css_key');
  }

  foreach ( $osC_Language->getAll() as $l ) {
?>
	  <tr>
        <td><?php echo $osC_Language->showImage($l['code']); ?>&nbsp;<?php echo osc_draw_input_field('title[' . $l['id'] . ']', (isset($status_name[$l['id']]) ? $status_name[$l['id']] : null)); ?></td>
      </tr>	
<?php
  }
?>
     </tbody>
  </table>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
