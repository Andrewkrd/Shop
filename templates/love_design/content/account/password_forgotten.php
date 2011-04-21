<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<?php if (file_exists('images/' . $osC_Template->getPageImage()) == true) {
echo osc_image(DIR_WS_IMAGES . $osC_Template->getPageImage(), $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'id="pageIcon"');
} else {}
?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<?php
  if ($osC_MessageStack->size('password_forgotten') > 0) {
    echo $osC_MessageStack->get('password_forgotten');
  }
?>

<form name="password_forgotten" action="<?php echo osc_href_link(FILENAME_ACCOUNT, 'password_forgotten=process', 'SSL'); ?>" method="post" onsubmit="return check_form(password_forgotten);">

<div class="moduleBox">
  <h6><?php echo $osC_Language->get('password_forgotten_heading'); ?></h6>

  <div class="content">
    <p><?php echo $osC_Language->get('password_forgotten'); ?></p>

    <ol>
      <li><?php echo osc_draw_label($osC_Language->get('field_customer_email_address'), 'email_address') . osc_draw_input_field('email_address'); ?></li>
    </ol>
  </div>
</div>

<div class="submitFormButtons">
  <span style="float: right;"><?php echo $osC_Template->osc_draw_image_jquery_button(array('icon' => 'triangle-1-e', 'title' => $osC_Language->get('button_continue'))); ?></span>

  <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_ACCOUNT, null, 'SSL'), 'icon' => 'triangle-1-w', 'title' => $osC_Language->get('button_back'))); ?>
</div>

</form>
