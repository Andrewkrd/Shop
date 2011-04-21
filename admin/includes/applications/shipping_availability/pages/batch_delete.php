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
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png') . ' ' . $osC_Language->get('action_heading_batch_delete_shipping_availability'); ?></div>
<div class="infoBoxContent">
  <form name="osDeleteBatch" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_batch_delete_shipping_availability'); ?></p>

<?php
  $Qstatuses = $osC_Database->query('select id, title from :table_shipping_availability where id in (":id") and languages_id = :language_id order by title');
  $Qstatuses->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
  $Qstatuses->bindRaw(':id', implode('", "', array_unique(array_filter(array_slice($_POST['batch'], 0, MAX_DISPLAY_SEARCH_RESULTS), 'is_numeric'))));
  $Qstatuses->bindInt(':language_id', $osC_Language->getID());
  $Qstatuses->execute();

  $names_string = '';

  while ( $Qstatuses->next() ) {
    $names_string .= osc_draw_hidden_field('batch[]', $Qstatuses->valueInt('id')) . '<b>' . $Qstatuses->value('title') . '</b>, '; 
  }

  if ( !empty($names_string) ) {
    $names_string = substr($names_string, 0, -2) . osc_draw_hidden_field('subaction', 'confirm');
  }

  echo '<p>' . $names_string . '</p>';
    echo '  <p align="center"><input type="submit" value="' . $osC_Language->get('button_delete') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" /></p>';

?>

  </form>
</div>
