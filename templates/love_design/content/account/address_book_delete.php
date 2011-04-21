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

  $Qentry = osC_AddressBook::getEntry($_GET['address_book']);
?>

<?php if (file_exists('images/' . $osC_Template->getPageImage()) == true) {
echo osc_image(DIR_WS_IMAGES . $osC_Template->getPageImage(), $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'id="pageIcon"');
} else {}
?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<div class="moduleBox">
  <h6><?php echo $osC_Language->get('address_book_delete_address_title'); ?></h6>

  <div class="content">
    <div style="float: right; padding: 0px 0px 10px 20px;">
      <?php echo osC_Address::format($_GET['address_book'], '<br />'); ?>
    </div>

    <div style="float: right; padding: 0px 0px 10px 20px; text-align: center;">
      <?php echo '<b>' . $osC_Language->get('selected_address_title') . '</b><br />' . osc_image('templates/' . $osC_Template->getCode() . '/images/arrow_south_east.png'); ?>
    </div>

    <?php echo $osC_Language->get('address_book_delete_address_description'); ?>

    <div style="clear: both;"></div>
  </div>
</div>

<div class="submitFormButtons">
  <span style="float: right;"><?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_ACCOUNT, 'address_book=' . $_GET['address_book'] . '&delete=confirm', 'SSL'), 'icon' => 'trash', 'title' => $osC_Language->get('button_delete'))); ?></span>

  <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_ACCOUNT, 'address_book', 'SSL'), 'icon' => 'triangle-1-w', 'title' => $osC_Language->get('button_back'))); ?>
</div>
