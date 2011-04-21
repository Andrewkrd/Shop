<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
   function utf8a_wordwrap($str, $width = 75, $break = "\n", $return = '') // wordwrap() with utf-8 support
    {
        $str =  preg_split('/([\x20\r\n\t]++|\xc2\xa0)/sSX', $str, -1, PREG_SPLIT_NO_EMPTY);
        $len = 0;
        foreach ($str as $val)
        {
            $val .= ' ';
            $tmp = mb_strlen($val, 'utf-8');
            $len += $tmp;
            if ($len >= $width)
            {
                $return .= $break . $val;
                $len = $tmp;
            }
            else
                $return .= $val;
        }
        return $return;
    }

  $Qreviews = osC_Reviews::getListing();
?>

<?php if (file_exists('images/' . $osC_Template->getPageImage()) == true) {
echo osc_image(DIR_WS_IMAGES . $osC_Template->getPageImage(), $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'id="pageIcon"');
} else {}
?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<?php
  while ($Qreviews->next()) {
?>

<div class="moduleBox">
  <div style="float: right; margin-top: 5px;"><?php echo osC_DateTime::getLong($Qreviews->value('date_added')); ?></div>

  <h6><?php echo osc_link_object(osc_href_link(FILENAME_PRODUCTS, 'reviews=' . $Qreviews->valueInt('reviews_id') . '&' . $Qreviews->value('products_keyword')), $Qreviews->value('products_name')); ?> (<?php echo sprintf(($osC_Language->get('reviewed_by')), $Qreviews->valueProtected('customers_name')); ?>)

  <div class="content">

<?php
    if (!osc_empty($Qreviews->value('image'))) {
      echo osc_link_object(osc_href_link(FILENAME_PRODUCTS, 'reviews=' . $Qreviews->valueInt('reviews_id') . '&' . $Qreviews->value('products_keyword')), $osC_Image->show($Qreviews->value('image'), $Qreviews->value('products_name'), 'style="float: left;"'));
    }
?>

    <p style="padding-left: 100px;"><?php echo utf8a_wordwrap($Qreviews->valueProtected('reviews_text'), 100) . ((strlen($Qreviews->valueProtected('reviews_text')) >= 100) ? '...' : '') . '<br /><br /><i>' . osc_image('templates/' . $osC_Template->getCode() . '/images/stars_' . $Qreviews->valueInt('reviews_rating') . '.png', sprintf($osC_Language->get('rating_of_5_stars'), $Qreviews->valueInt('reviews_rating'))) . '</i>'; ?></p>

    <div style="clear: both;"></div>
  </div>
</div>

<?php
  }
?>

<div class="listingPageLinks">
  <span style="float: right;"><?php echo $Qreviews->getBatchPageLinks('page', 'reviews&0&'); ?></span>

  <?php echo $Qreviews->getBatchTotalPages($osC_Language->get('result_set_number_of_reviews')); ?>
</div>
