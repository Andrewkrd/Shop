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
  $QinfoList = osC_Info::getListing();
?>

<?php if (file_exists('images/' . $osC_Template->getPageImage()) == true) {
echo osc_image(DIR_WS_IMAGES . $osC_Template->getPageImage(), $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'id="pageIcon"');
} else {}
?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<div class="moduleBox">
  <h6><?php echo $osC_Language->get('information_title'); ?></h6>
    <div class="content">
        <?php echo osc_image('templates/' . $osC_Template->getCode() . '/images/account_personal.png', $osC_Language->get('information_title'), null, null, 'style="float: left;"'); ?>
<ul style="padding-left: 100px; list-style-image: url(<?php echo osc_href_link('templates/' . $osC_Template->getCode() . '/images/arrow_green.gif'); ?>);">
        <?php

	while ($QinfoList->next()) {
    	echo '<li><a href="' . osc_href_link(FILENAME_INFO, "view=" . $QinfoList->value("info_id"), "NONSSL") . '"> ' . $QinfoList->value("info_name") . '</a></li>';
    }

?>
      <li><?php echo osc_link_object(osc_href_link(FILENAME_INFO, 'contact'), $osC_Language->get('box_information_contact')); ?></li>
      <li><?php echo osc_link_object(osc_href_link(FILENAME_INFO, 'sitemap'), $osC_Language->get('box_information_sitemap')); ?></li>
    </ul>
    <div style="clear: both;"></div>
  </div>
</div>
