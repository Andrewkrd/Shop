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

    $title1 = $osC_Language->get('access_configuration_title187');
    $title2 = $osC_Language->get('access_configuration_title188');
    $title3 = $osC_Language->get('access_configuration_title189');
    $title4 = $osC_Language->get('access_configuration_title190');
    $title5 = $osC_Language->get('access_configuration_title191');
    $title6 = $osC_Language->get('access_configuration_title192');
    $title7 = $osC_Language->get('access_configuration_title193');
    $title8 = $osC_Language->get('access_configuration_title194');
    $title9 = $osC_Language->get('access_configuration_title195');
    $title10 = $osC_Language->get('access_configuration_title196');
    $title11 = $osC_Language->get('access_configuration_title197');
    $title12 = $osC_Language->get('access_configuration_title198');
    $title13 = $osC_Language->get('access_configuration_title199');
    $title14 = $osC_Language->get('access_configuration_title200');
    $title15 = $osC_Language->get('access_configuration_title201');
    $title16 = $osC_Language->get('access_configuration_title202');
    $title17 = $osC_Language->get('access_configuration_title203');
    $title18 = $osC_Language->get('access_configuration_title204');
    $title19 = $osC_Language->get('access_configuration_title205');
    $title20 = $osC_Language->get('access_configuration_title206');
    $title21 = $osC_Language->get('access_configuration_title207');
    $title22 = $osC_Language->get('access_configuration_title258');
    $title23 = $osC_Language->get('access_configuration_title259');
    $title24 = $osC_Language->get('access_configuration_title260');
    $title25 = $osC_Language->get('access_configuration_title261');
    $title26 = $osC_Language->get('access_configuration_title262');
    $title27 = $osC_Language->get('access_configuration_title263');
	
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title1' WHERE code = 'best_sellers'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title2' WHERE code = 'categories'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title3' WHERE code = 'currencies'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title4' WHERE code = 'information'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title5' WHERE code = 'languages'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title6' WHERE code = 'manufacturer_info'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title7' WHERE code = 'manufacturers'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title8' WHERE code = 'order_history'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title9' WHERE code = 'product_notifications'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title10' WHERE code = 'reviews'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title11' WHERE code = 'search'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title12' WHERE code = 'shopping_cart'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title13' WHERE code = 'specials'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title14' WHERE code = 'tell_a_friend'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title15' WHERE code = 'whats_new'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title16' WHERE code = 'new_products'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title17' WHERE code = 'upcoming_products'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title18' WHERE code = 'recently_visited'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title19' WHERE code = 'also_purchased_products'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title20' WHERE code = 'date_available'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title21' WHERE code = 'manufacturers'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title22' WHERE code = 'slide_show'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title23' WHERE code = 'cms'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title23' WHERE code = 'cms_sitemap'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title24' WHERE code = 'templates'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title25' WHERE code = 'cms_xsell'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title26' WHERE code = 'cms_xsell_products'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "templates_boxes SET title = '$title27' WHERE code = 'checkout_trail'");

  require('includes/templates/' . $_GET['filter'] . '.php');

  $filter_id = 0;
  $templates_array = array();

  $Qtemplates = $osC_Database->query('select id, title, code from :table_templates order by title');
  $Qtemplates->bindTable(':table_templates', TABLE_TEMPLATES);
  $Qtemplates->execute();

  while ( $Qtemplates->next() ) {
    if ( $Qtemplates->value('code') == $_GET['filter'] ) {
      $filter_id = $Qtemplates->valueInt('id');
    }
	  $templates_array[] = array('id' => 0,
                               'text' => $osC_Language->get('please_select'));

    $templates_array[] = array('id' => $Qtemplates->value('code'),
                               'text' => $Qtemplates->value('title'));
  }
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set']), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div style="float: right;">
  <form name="template" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT); ?>" method="get"><?php echo osc_draw_hidden_field($osC_Template->getModule(), null) . osc_draw_hidden_field('set', $_GET['set']); ?>
  <?php echo osc_draw_pull_down_menu('filter', $templates_array, $filter_id) . '<input type="submit" value="' . $osC_Language->get('button_use') . '" class="operationButton" />'; ?>

  <?php echo '<input type="button" value="' . $osC_Language->get('button_insert') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set'] . '&filter=' . $_GET['filter'] . '&action=save') . '\';" class="infoBoxButton" />';  ?>

  </form>
</div>

<div style="clear: both; padding: 2px; height: 16px;">
</div>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
  <thead>
    <tr>
      <th align="left"><?php echo $osC_Language->get('table_heading_modules'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_pages'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_page_specific'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_group'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_sort_order'); ?></th>
      <th align="right" width="150"><?php echo $osC_Language->get('table_heading_action'); ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th align="right" colspan="6"><?php echo '<input type="image" src="' . osc_icon_raw('trash.png') . '" title="' . $osC_Language->get('icon_trash') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set'] . '&filter=' . $_GET['filter'] . '&action=batchDelete') . '\';" />'; ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </tfoot>
  <tbody>

<?php
  $Qlayout = $osC_Database->query('select b2p.*, b.title as box_title from :table_templates_boxes_to_pages b2p, :table_templates_boxes b where b2p.templates_id = :templates_id and b2p.templates_boxes_id = b.id and b.modules_group = :modules_group order by b2p.page_specific desc, b2p.boxes_group, b2p.sort_order, b.title');
  $Qlayout->bindTable(':table_templates_boxes_to_pages', TABLE_TEMPLATES_BOXES_TO_PAGES);
  $Qlayout->bindTable(':table_templates_boxes', TABLE_TEMPLATES_BOXES);
  $Qlayout->bindInt(':templates_id', $filter_id);
  $Qlayout->bindValue(':modules_group', $_GET['set']);
  $Qlayout->execute();

  while ( $Qlayout->next() ) {
?>

    <tr onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">
      <td onclick="document.getElementById('batch<?php echo $Qlayout->valueInt('id'); ?>').checked = !document.getElementById('batch<?php echo $Qlayout->valueInt('id'); ?>').checked;"><?php echo $Qlayout->value('box_title'); ?></td>
      <td align="center"><?php echo $Qlayout->value('content_page'); ?></td>
      <td align="center"><?php echo osc_icon(($Qlayout->valueInt('page_specific') === 1 ? 'checkbox_ticked.gif' : 'checkbox.gif'), null, null); ?></td>
      <td align="center"><?php echo $Qlayout->value('boxes_group'); ?></td>
      <td align="center"><?php echo $Qlayout->valueInt('sort_order'); ?></td>
      <td align="right">

<?php
    echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set'] . '&filter=' . $_GET['filter'] . '&lID=' . $Qlayout->valueInt('id') . '&action=save'), osc_icon('edit.png')) . '&nbsp;' .
         osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set'] . '&filter=' . $_GET['filter'] . '&lID=' . $Qlayout->valueInt('id') . '&action=delete'), osc_icon('trash.png'));
?>

      </td>
      <td align="center"><?php echo osc_draw_checkbox_field('batch[]', $Qlayout->valueInt('id'), null, 'id="batch' . $Qlayout->valueInt('id') . '"'); ?></td>
    </tr>

<?php
  }
?>

  </tbody>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td style="opacity: 0.5; filter: alpha(opacity=50);"><?php echo '<b>' . $osC_Language->get('table_action_legend') . '</b> ' . osc_icon('edit.png') . '&nbsp;' . $osC_Language->get('icon_edit') . '&nbsp;&nbsp;' . osc_icon('trash.png') . '&nbsp;' . $osC_Language->get('icon_trash'); ?></td>
  </tr>
</table>
