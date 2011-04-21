<?php error_reporting(0);
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<h1 style="float: right;"><?php echo $osC_Product->getPriceFormated(true); ?></h1>

<h1><?php echo $osC_Template->getPageTitle() . ($osC_Product->hasModel() ? '<br /><div class="smallText">' . $osC_Product->getModel() . '</div>' : ''); ?></h1>

<?php
  if ($osC_MessageStack->size('reviews') > 0) {
    echo $osC_MessageStack->get('reviews');
  }

  if ($osC_Product->hasImage()) {
?>

<div style="float: right; text-align: center;">
  <?php        if ( $osC_Product->hasImage() ) {
        echo osc_link_object(osc_href_link(FILENAME_PRODUCTS, $osC_Product->getKeyword()), $osC_Image->show($osC_Product->getImage(), $osC_Product->getTitle()));
      } ?>
  <?php echo '<p>' . $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(basename($_SERVER['SCRIPT_FILENAME']), $osC_Product->getKeyword() . '&' . osc_get_all_get_params(array('action')) . '&action=cart_add'), 'icon' => 'cart', 'title' => $osC_Language->get('button_add_to_cart'))) . '</p>'; ?>
</div>

<?php
  }

  if ($osC_Product->getData('reviews_average_rating') > 0) {
?>

<p><?php echo $osC_Language->get('average_rating') . ' ' . osc_image('templates/' . $osC_Template->getCode() . '/images/stars_' . $osC_Product->getData('reviews_average_rating') . '.png', sprintf($osC_Language->get('rating_of_5_stars'), $osC_Product->getData('reviews_average_rating'))); ?></p>

<?php
  }

  $counter = 0;
  $Qreviews = osC_Reviews::getListing($osC_Product->getID());
  while ($Qreviews->next()) {
    $counter++;

    if ($counter > 1) {
?>

<hr style="height: 1px; width: 150px; text-align: left; margin-left: 0px" />

<?php
    }
?>

<p><?php echo osc_image('templates/' . $osC_Template->getCode() . '/images/stars_' . $Qreviews->valueInt('reviews_rating') . '.png', sprintf($osC_Language->get('rating_of_5_stars'), $Qreviews->valueInt('reviews_rating'))) . '&nbsp;' . sprintf($osC_Language->get('reviewed_by')); echo $Qreviews->valueProtected('customers_name') . '; ' . osC_DateTime::getLong($Qreviews->value('date_added')); ?></p>

<?php echo nl2br(wordwrap($Qreviews->valueProtected('reviews_text'), 10000)); ?>

<?php
  }
?>

<div class="listingPageLinks">
  <span style="float: right;"><?php echo $Qreviews->getBatchPageLinks('page', 'reviews' . '&' . $osC_Product->getKeyword()); ?></span>

  <?php echo $Qreviews->getBatchTotalPages($osC_Language->get('result_set_number_of_reviews')); ?>
</div>

<div class="submitFormButtons"><br><br><br><br>

<?php
  if ($osC_Reviews->is_enabled === true) {
?>

    <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_PRODUCTS, 'reviews=new&' . $osC_Product->getKeyword()), 'icon' => 'pencil', 'title' => $osC_Language->get('button_write_review'))); ?>

<?php
  }
?>
 <br><br><br>
  <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_PRODUCTS, $osC_Product->getKeyword()), 'icon' => 'triangle-1-w', 'title' => $osC_Language->get('button_back'))); ?>
</div>
