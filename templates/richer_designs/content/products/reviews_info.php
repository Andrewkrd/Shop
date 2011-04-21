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
  error_reporting(0);
  $Qreviews = osC_Reviews::getEntry($_GET[$osC_Template->getModule()]);
?>

<h1 style="float: right;"><?php echo $osC_Product->getPriceFormated(true); ?></h1>

<h1><?php echo $osC_Template->getPageTitle() . ($osC_Product->hasModel() ? '<br /><span class="smallText">' . $osC_Product->getModel() . '</span>' : ''); ?></h1>

<?php
  if ($osC_MessageStack->size('reviews') > 0) {
    echo $osC_MessageStack->get('reviews');
  }

  if ($osC_Product->hasImage()) {
?>

<div style="float: right; text-align: center;">
    <?php       if ( $osC_Product->hasImage() ) {
        echo osc_link_object(osc_href_link(FILENAME_PRODUCTS, $osC_Product->getKeyword()), $osC_Image->show($osC_Product->getImage(), $osC_Product->getTitle()));
      }
	?>
  <?php echo '<p>' . $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(basename($_SERVER['SCRIPT_FILENAME']), $osC_Product->getKeyword() . '&' . osc_get_all_get_params(array('action')) . '&action=cart_add'), 'icon' => 'cart', 'title' => $osC_Language->get('button_add_to_cart'))) . '</p>'; ?>
</div>

<?php
  }
?>

<p><?php echo osc_image('templates/' . $osC_Template->getCode() . '/images/stars_' . $Qreviews->valueInt('reviews_rating') . '.png', sprintf($osC_Language->get('rating_of_5_stars'), $Qreviews->valueInt('reviews_rating'))) . '&nbsp;' . sprintf($osC_Language->get('reviewed_by')); echo $Qreviews->value('customers_name').' '.$Qreviews->value('date_added'); ?></p>

<?php echo nl2br(wordwrap($Qreviews->valueProtected('reviews_text'), 10000)); ?>

<div class="submitFormButtons">

<?php
  if ($osC_Reviews->is_enabled === true) {
?>
<br>
<?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_PRODUCTS, 'reviews=new&' . $osC_Product->getKeyword()), 'icon' => 'pencil', 'title' => $osC_Language->get('button_write_review'))); ?>

<?php
  }
?>
<br><br><br>
  <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_PRODUCTS, 'reviews&' . $osC_Product->getKeyword()), 'icon' => 'triangle-1-w', 'title' => $osC_Language->get('button_back'))); ?>
</div>
