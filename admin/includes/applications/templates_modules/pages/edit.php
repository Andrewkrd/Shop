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

    $title1 = $osC_Language->get('access_configuration_title208');
    $title2 = $osC_Language->get('access_configuration_title209');
    $title3 = $osC_Language->get('access_configuration_title210');
    $title4 = $osC_Language->get('access_configuration_title211');
    $title5 = $osC_Language->get('access_configuration_title212');
    $title6 = $osC_Language->get('access_configuration_title213');
    $title7 = $osC_Language->get('access_configuration_title214');
    $title8 = $osC_Language->get('access_configuration_title215');
    $title9 = $osC_Language->get('access_configuration_title216');
    $title10 = $osC_Language->get('access_configuration_title217');
    $title11 = $osC_Language->get('access_configuration_title218');
    $title12 = $osC_Language->get('access_configuration_title219');
    $title13 = $osC_Language->get('access_configuration_title220');
    $title14 = $osC_Language->get('access_configuration_title221');
    $title15 = $osC_Language->get('access_configuration_title222');
    $title16 = $osC_Language->get('access_configuration_title223');
    $title17 = $osC_Language->get('access_configuration_title224');
    $title18 = $osC_Language->get('access_configuration_title225');
    $title19 = $osC_Language->get('access_configuration_title226');
	
    $title20 = $osC_Language->get('access_configuration_title227');
    $title21 = $osC_Language->get('access_configuration_title228');
    $title22 = $osC_Language->get('access_configuration_title229');
    $title23 = $osC_Language->get('access_configuration_title230');
    $title24 = $osC_Language->get('access_configuration_title231');
    $title25 = $osC_Language->get('access_configuration_title232');
    $title26 = $osC_Language->get('access_configuration_title233');
    $title27 = $osC_Language->get('access_configuration_title234');
    $title28 = $osC_Language->get('access_configuration_title235');
    $title29 = $osC_Language->get('access_configuration_title236');
    $title30 = $osC_Language->get('access_configuration_title237');
    $title31 = $osC_Language->get('access_configuration_title238');
    $title32 = $osC_Language->get('access_configuration_title239');
    $title33 = $osC_Language->get('access_configuration_title240');
    $title34 = $osC_Language->get('access_configuration_title241');
    $title35 = $osC_Language->get('access_configuration_title242');
    $title36 = $osC_Language->get('access_configuration_title243');
    $title37 = $osC_Language->get('access_configuration_title244');
    $title38 = $osC_Language->get('access_configuration_title245');

    $title40 = $osC_Language->get('access_configuration_title250');
    $title41 = $osC_Language->get('access_configuration_title251');
    $title42 = $osC_Language->get('access_configuration_title252');
    $title43 = $osC_Language->get('access_configuration_title253');
    $title44 = $osC_Language->get('access_configuration_title254');
    $title45 = $osC_Language->get('access_configuration_title255');
    $title46 = $osC_Language->get('access_configuration_title256');
    $title47 = $osC_Language->get('access_configuration_title257');
    $title46a = $osC_Language->get('access_configuration_title256a');
    $title47a = $osC_Language->get('access_configuration_title257a');
	
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title1', configuration_description = '$title20' WHERE configuration_key = 'BOX_BEST_SELLERS_MIN_LIST'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title2', configuration_description = '$title21' WHERE configuration_key = 'BOX_BEST_SELLERS_MAX_LIST'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title3', configuration_description = '$title22' WHERE configuration_key = 'BOX_BEST_SELLERS_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title4', configuration_description = '$title23' WHERE configuration_key = 'BOX_CATEGORIES_SHOW_PRODUCT_COUNT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title5', configuration_description = '$title24' WHERE configuration_key = 'BOX_MANUFACTURERS_LIST_SIZE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title6', configuration_description = '$title25' WHERE configuration_key = 'BOX_ORDER_HISTORY_MAX_LIST'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title7', configuration_description = '$title26' WHERE configuration_key = 'BOX_REVIEWS_RANDOM_SELECT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title8', configuration_description = '$title27' WHERE configuration_key = 'BOX_REVIEWS_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title9', configuration_description = '$title28' WHERE configuration_key = 'BOX_SPECIALS_RANDOM_SELECT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title10', configuration_description = '$title29' WHERE configuration_key = 'BOX_SPECIALS_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title11', configuration_description = '$title30' WHERE configuration_key = 'BOX_WHATS_NEW_RANDOM_SELECT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title12', configuration_description = '$title31' WHERE configuration_key = 'BOX_WHATS_NEW_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title13', configuration_description = '$title32' WHERE configuration_key = 'MODULE_CONTENT_NEW_PRODUCTS_MAX_DISPLAY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title14', configuration_description = '$title33' WHERE configuration_key = 'MODULE_CONTENT_NEW_PRODUCTS_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title15', configuration_description = '$title34' WHERE configuration_key = 'MODULE_CONTENT_ALSO_PURCHASED_MIN_DISPLAY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title16', configuration_description = '$title35' WHERE configuration_key = 'MODULE_CONTENT_ALSO_PURCHASED_MAX_DISPLAY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title17', configuration_description = '$title36' WHERE configuration_key = 'MODULE_CONTENT_ALSO_PURCHASED_PRODUCTS_CACHE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title18', configuration_description = '$title37' WHERE configuration_key = 'MODULE_CONTENT_UPCOMING_PRODUCTS_MAX_DISPLAY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title19', configuration_description = '$title38' WHERE configuration_key = 'MODULE_CONTENT_UPCOMING_PRODUCTS_CACHE'");	

	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title40', configuration_description = '$title41' WHERE configuration_key = 'MODULE_CONTENT_SLIDE_SHOW_MODE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title42', configuration_description = '$title43' WHERE configuration_key = 'MODULE_CONTENT_SLIDE_SHOW_WIDTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title44', configuration_description = '$title45' WHERE configuration_key = 'MODULE_CONTENT_SLIDE_SHOW_HEIGHT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title46', configuration_description = '$title47' WHERE configuration_key = 'MODULE_CONTENT_SLIDE_SHOW_INTERVAL'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title46a', configuration_description = '$title47a' WHERE configuration_key = 'MODULE_CONTENT_SLIDE_SHOW_DURATION'");

  include('../includes/modules/' . $_GET['set'] . '/' . $_GET['module'] . '.php');

  $module = 'osC_' . ucfirst($_GET['set']) . '_' . $_GET['module'];

  $module = new $module();
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set']), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('edit.png') . ' ' . $module->getTitle(); ?></div>
<div class="infoBoxContent">
  <form name="mEdit" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set'] . '&module=' . $module->getCode() . '&action=save'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_edit_module'); ?></p>

<?php
  $keys = '';

  foreach ( $module->getKeys() as $key ) {
    $Qkey = $osC_Database->query('select configuration_title, configuration_key, configuration_value, configuration_description, use_function, set_function from :table_configuration where configuration_key = :configuration_key');
    $Qkey->bindTable(':table_configuration', TABLE_CONFIGURATION);
    $Qkey->bindValue(':configuration_key', $key);
    $Qkey->execute();

    $keys .= '<b>' . $Qkey->value('configuration_title') . '</b><br />' . $Qkey->value('configuration_description') . '<br />';

    if ( !osc_empty($Qkey->value('set_function')) ) {
      $keys .= osc_call_user_func($Qkey->value('set_function'), $Qkey->value('configuration_value'), $key);
    } else {
      $keys .= osc_draw_input_field('configuration[' . $key . ']', $Qkey->value('configuration_value'));
    }

    $keys .= '<br /><br />';
  }

  $keys = substr($keys, 0, strrpos($keys, '<br /><br />'));
?>

  <p><?php echo $keys; ?></p>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&set=' . $_GET['set']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
