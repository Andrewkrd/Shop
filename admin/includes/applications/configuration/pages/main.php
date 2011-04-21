<?php
/*
  $Id: main.php 1845 2009-02-27 00:19:37Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->exists($osC_Template->getModule()) ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div style="padding-bottom: 10px;">
  <span><form id="liveSearchForm"><input type="text" id="liveSearchField" name="search" class="searchField fieldTitleAsDefault" title= <?php echo $osC_Language->get('access_configuration_search') ?> /><input type="button" value= <?php echo $osC_Language->get('access_configuration_reset') ?> class="operationButton" onclick="osC_DataTable.reset();" /></form></span>
</div>

<div id="infoPane" class="ui-corner-all" style="float: left; width: 150px;">

  <ul>

<?php

    $title1 = $osC_Language->get('access_configuration_title19');
    $title2 = $osC_Language->get('access_configuration_title20');
    $title3 = $osC_Language->get('access_configuration_title21');
    $title4 = $osC_Language->get('access_configuration_title22');
    $title5 = $osC_Language->get('access_configuration_title23');
    $title6 = $osC_Language->get('access_configuration_title24');
    $title7 = $osC_Language->get('access_configuration_title25');
    $title8 = $osC_Language->get('access_configuration_title26');
    $title9 = $osC_Language->get('access_configuration_title27');
    $title10 = $osC_Language->get('access_configuration_title28');
    $title11 = $osC_Language->get('access_configuration_title29');
    $title12 = $osC_Language->get('access_configuration_title30');
    $title13 = $osC_Language->get('access_configuration_title31');
    $title14 = $osC_Language->get('access_configuration_title32');
    $title15 = $osC_Language->get('access_configuration_title33');
    $title16 = $osC_Language->get('access_configuration_title34');
    $title17 = $osC_Language->get('access_configuration_title35');
    $title18 = $osC_Language->get('access_configuration_title36');
    $title19 = $osC_Language->get('access_configuration_title37');
    $title20 = $osC_Language->get('access_configuration_title38');
    $title21 = $osC_Language->get('access_configuration_title39');
    $title22 = $osC_Language->get('access_configuration_title40');
    $title23 = $osC_Language->get('access_configuration_title41');
    $title24 = $osC_Language->get('access_configuration_title42');
    $title25 = $osC_Language->get('access_configuration_title43');
    $title26 = $osC_Language->get('access_configuration_title44');
    $title27 = $osC_Language->get('access_configuration_title45');
    $title28 = $osC_Language->get('access_configuration_title46');
    $title29 = $osC_Language->get('access_configuration_title47');
    $title30 = $osC_Language->get('access_configuration_title48');
    $title31 = $osC_Language->get('access_configuration_title49');
    $title32 = $osC_Language->get('access_configuration_title50');
    $title33 = $osC_Language->get('access_configuration_title51');
    $title34 = $osC_Language->get('access_configuration_title52');
    $title35 = $osC_Language->get('access_configuration_title53');
    $title36 = $osC_Language->get('access_configuration_title54');
    $title37 = $osC_Language->get('access_configuration_title55');
    $title38 = $osC_Language->get('access_configuration_title56');
    $title39 = $osC_Language->get('access_configuration_title57');
    $title40 = $osC_Language->get('access_configuration_title58');
    $title41 = $osC_Language->get('access_configuration_title59');
    $title42 = $osC_Language->get('access_configuration_title60');
    $title43 = $osC_Language->get('access_configuration_title61');
    $title44 = $osC_Language->get('access_configuration_title62');
    $title45 = $osC_Language->get('access_configuration_title63');
    $title46 = $osC_Language->get('access_configuration_title64');
    $title47 = $osC_Language->get('access_configuration_title65');
    $title48 = $osC_Language->get('access_configuration_title66');
    $title49 = $osC_Language->get('access_configuration_title67');
    $title50 = $osC_Language->get('access_configuration_title68');
    $title51 = $osC_Language->get('access_configuration_title69');
    $title52 = $osC_Language->get('access_configuration_title70');
    $title53 = $osC_Language->get('access_configuration_title71');
    $title54 = $osC_Language->get('access_configuration_title72');
    $title55 = $osC_Language->get('access_configuration_title73');
    $title56 = $osC_Language->get('access_configuration_title74');
    $title57 = $osC_Language->get('access_configuration_title75');
    $title58 = $osC_Language->get('access_configuration_title76');
    $title59 = $osC_Language->get('access_configuration_title77');
    $title60 = $osC_Language->get('access_configuration_title78');
    $title61 = $osC_Language->get('access_configuration_title79');
    $title62 = $osC_Language->get('access_configuration_title80');
    $title63 = $osC_Language->get('access_configuration_title81');
    $title64 = $osC_Language->get('access_configuration_title82');
    $title65 = $osC_Language->get('access_configuration_title83');
    $title66 = $osC_Language->get('access_configuration_title84');
    $title67 = $osC_Language->get('access_configuration_title85');
    $title68 = $osC_Language->get('access_configuration_title86');
    $title69 = $osC_Language->get('access_configuration_title87');
    $title70 = $osC_Language->get('access_configuration_title88');
    $title71 = $osC_Language->get('access_configuration_title89');
    $title72 = $osC_Language->get('access_configuration_title90');
    $title73 = $osC_Language->get('access_configuration_title91');
    $title74 = $osC_Language->get('access_configuration_title92');
    $title75 = $osC_Language->get('access_configuration_title93');
    $title76 = $osC_Language->get('access_configuration_title94');
    $title77 = $osC_Language->get('access_configuration_title95');
    $title78 = $osC_Language->get('access_configuration_title96');
    $title79 = $osC_Language->get('access_configuration_title97');
    $title80 = $osC_Language->get('access_configuration_title98');
    $title81 = $osC_Language->get('access_configuration_title99');
    $title82 = $osC_Language->get('access_configuration_title100');
    $title83 = $osC_Language->get('access_configuration_title101');
    $title84 = $osC_Language->get('access_configuration_title102');
	
    $title85 = $osC_Language->get('access_configuration_title103');
    $title86 = $osC_Language->get('access_configuration_title104');
    $title87 = $osC_Language->get('access_configuration_title105');
    $title88 = $osC_Language->get('access_configuration_title106');
    $title89 = $osC_Language->get('access_configuration_title107');
    $title90 = $osC_Language->get('access_configuration_title108');
    $title91 = $osC_Language->get('access_configuration_title109');
    $title92 = $osC_Language->get('access_configuration_title110');
    $title93 = $osC_Language->get('access_configuration_title111');
    $title94 = $osC_Language->get('access_configuration_title112');
    $title95 = $osC_Language->get('access_configuration_title113');
    $title96 = $osC_Language->get('access_configuration_title114');
    $title97 = $osC_Language->get('access_configuration_title115');
    $title98 = $osC_Language->get('access_configuration_title116');
    $title99 = $osC_Language->get('access_configuration_title117');
    $title100 = $osC_Language->get('access_configuration_title118');
    $title101 = $osC_Language->get('access_configuration_title119');
    $title102 = $osC_Language->get('access_configuration_title120');
    $title103 = $osC_Language->get('access_configuration_title121');
    $title104 = $osC_Language->get('access_configuration_title122');
    $title105 = $osC_Language->get('access_configuration_title123');
    $title106 = $osC_Language->get('access_configuration_title124');
    $title107 = $osC_Language->get('access_configuration_title125');
    $title108 = $osC_Language->get('access_configuration_title126');
    $title109 = $osC_Language->get('access_configuration_title127');
    $title110 = $osC_Language->get('access_configuration_title128');
    $title111 = $osC_Language->get('access_configuration_title129');
    $title112 = $osC_Language->get('access_configuration_title130');
    $title113 = $osC_Language->get('access_configuration_title131');
    $title114 = $osC_Language->get('access_configuration_title132');
    $title115 = $osC_Language->get('access_configuration_title133');
    $title116 = $osC_Language->get('access_configuration_title134');
    $title117 = $osC_Language->get('access_configuration_title135');
    $title118 = $osC_Language->get('access_configuration_title136');
    $title119 = $osC_Language->get('access_configuration_title137');
    $title120 = $osC_Language->get('access_configuration_title138');
    $title121 = $osC_Language->get('access_configuration_title139');
    $title122 = $osC_Language->get('access_configuration_title140');
    $title123 = $osC_Language->get('access_configuration_title141');
    $title124 = $osC_Language->get('access_configuration_title142');
    $title125 = $osC_Language->get('access_configuration_title143');
    $title126 = $osC_Language->get('access_configuration_title144');
    $title127 = $osC_Language->get('access_configuration_title145');
    $title128 = $osC_Language->get('access_configuration_title146');
    $title129 = $osC_Language->get('access_configuration_title147');
    $title130 = $osC_Language->get('access_configuration_title148');
    $title131 = $osC_Language->get('access_configuration_title149');
    $title132 = $osC_Language->get('access_configuration_title150');
    $title133 = $osC_Language->get('access_configuration_title151');
    $title134 = $osC_Language->get('access_configuration_title152');
    $title135 = $osC_Language->get('access_configuration_title153');
    $title136 = $osC_Language->get('access_configuration_title154');
    $title137 = $osC_Language->get('access_configuration_title155');
    $title138 = $osC_Language->get('access_configuration_title156');
    $title139 = $osC_Language->get('access_configuration_title157');
    $title140 = $osC_Language->get('access_configuration_title158');
    $title141 = $osC_Language->get('access_configuration_title159');
    $title142 = $osC_Language->get('access_configuration_title160');
    $title143 = $osC_Language->get('access_configuration_title161');
    $title144 = $osC_Language->get('access_configuration_title162');
    $title145 = $osC_Language->get('access_configuration_title163');
    $title146 = $osC_Language->get('access_configuration_title164');
    $title147 = $osC_Language->get('access_configuration_title165');
    $title148 = $osC_Language->get('access_configuration_title166');
    $title149 = $osC_Language->get('access_configuration_title167');
    $title150 = $osC_Language->get('access_configuration_title168');
    $title151 = $osC_Language->get('access_configuration_title169');
    $title152 = $osC_Language->get('access_configuration_title170');
    $title153 = $osC_Language->get('access_configuration_title171');
    $title154 = $osC_Language->get('access_configuration_title172');
    $title155 = $osC_Language->get('access_configuration_title173');
    $title156 = $osC_Language->get('access_configuration_title174');
    $title157 = $osC_Language->get('access_configuration_title175');
    $title158 = $osC_Language->get('access_configuration_title176');
    $title159 = $osC_Language->get('access_configuration_title177');
    $title160 = $osC_Language->get('access_configuration_title178');
    $title161 = $osC_Language->get('access_configuration_title179');
    $title162 = $osC_Language->get('access_configuration_title180');
    $title163 = $osC_Language->get('access_configuration_title181');
    $title164 = $osC_Language->get('access_configuration_title182');
    $title165 = $osC_Language->get('access_configuration_title183');
    $title166 = $osC_Language->get('access_configuration_title184');
    $title167 = $osC_Language->get('access_configuration_title185');
    $title168 = $osC_Language->get('access_configuration_title186');
    $title169 = $osC_Language->get('access_configuration_title246');	
    $title170 = $osC_Language->get('access_configuration_title247');
	
	$Ckey = $osC_Database->query("SELECT * FROM " . DB_TABLE_PREFIX . "configuration WHERE configuration_key = 'STORE_NAME_ADDRESS'");	
	$configuration_title = $Ckey->value('configuration_title');
	$configuration_description = $Ckey->value('configuration_description');
	
	if (($configuration_title & $configuration_description) != ($title9 & $title93)) {
	
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title1', configuration_description = '$title85' WHERE configuration_key = 'STORE_NAME'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title2', configuration_description = '$title86' WHERE configuration_key = 'STORE_OWNER'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title3', configuration_description = '$title87' WHERE configuration_key = 'STORE_OWNER_EMAIL_ADDRESS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title4', configuration_description = '$title88' WHERE configuration_key = 'EMAIL_FROM'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title5', configuration_description = '$title89' WHERE configuration_key = 'STORE_COUNTRY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title6', configuration_description = '$title90' WHERE configuration_key = 'STORE_ZONE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title7', configuration_description = '$title91' WHERE configuration_key = 'SEND_EXTRA_ORDER_EMAILS_TO'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title8', configuration_description = '$title92' WHERE configuration_key = 'ALLOW_GUEST_TO_TELL_A_FRIEND'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title9', configuration_description = '$title93' WHERE configuration_key = 'STORE_NAME_ADDRESS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title10', configuration_description = '$title94' WHERE configuration_key = 'TAX_DECIMAL_PLACES'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title11', configuration_description = '$title95' WHERE configuration_key = 'DISPLAY_PRICE_WITH_TAX'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title12', configuration_description = '$title96' WHERE configuration_key = 'CC_OWNER_MIN_LENGTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title13', configuration_description = '$title97' WHERE configuration_key = 'CC_NUMBER_MIN_LENGTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title14', configuration_description = '$title98' WHERE configuration_key = 'REVIEW_TEXT_MIN_LENGTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title15', configuration_description = '$title99' WHERE configuration_key = 'MAX_ADDRESS_BOOK_ENTRIES'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title16', configuration_description = '$title100' WHERE configuration_key = 'MAX_DISPLAY_SEARCH_RESULTS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title17', configuration_description = '$title101' WHERE configuration_key = 'MAX_DISPLAY_PAGE_LINKS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title18', configuration_description = '$title102' WHERE configuration_key = 'MAX_DISPLAY_CATEGORIES_PER_ROW'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title19', configuration_description = '$title103' WHERE configuration_key = 'MAX_DISPLAY_PRODUCTS_NEW'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title20', configuration_description = '$title104' WHERE configuration_key = 'MAX_DISPLAY_ORDER_HISTORY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title21', configuration_description = '$title105' WHERE configuration_key = 'HEADING_IMAGE_WIDTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title22', configuration_description = '$title106' WHERE configuration_key = 'HEADING_IMAGE_HEIGHT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title23', configuration_description = '$title107' WHERE configuration_key = 'IMAGE_REQUIRED'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title24', configuration_description = '$title108' WHERE configuration_key = 'ACCOUNT_GENDER'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title25', configuration_description = '$title109' WHERE configuration_key = 'ACCOUNT_FIRST_NAME'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title26', configuration_description = '$title110' WHERE configuration_key = 'ACCOUNT_LAST_NAME'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title27', configuration_description = '$title111' WHERE configuration_key = 'ACCOUNT_DATE_OF_BIRTH'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title28', configuration_description = '$title112' WHERE configuration_key = 'ACCOUNT_EMAIL_ADDRESS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title29', configuration_description = '$title113' WHERE configuration_key = 'ACCOUNT_PASSWORD'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title30', configuration_description = '$title114' WHERE configuration_key = 'ACCOUNT_NEWSLETTER'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title31', configuration_description = '$title115' WHERE configuration_key = 'ACCOUNT_COMPANY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title32', configuration_description = '$title116' WHERE configuration_key = 'ACCOUNT_STREET_ADDRESS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title33', configuration_description = '$title117' WHERE configuration_key = 'ACCOUNT_SUBURB'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title34', configuration_description = '$title118' WHERE configuration_key = 'ACCOUNT_POST_CODE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title35', configuration_description = '$title119' WHERE configuration_key = 'ACCOUNT_CITY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title36', configuration_description = '$title120' WHERE configuration_key = 'ACCOUNT_STATE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title37', configuration_description = '$title121' WHERE configuration_key = 'ACCOUNT_COUNTRY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title38', configuration_description = '$title122' WHERE configuration_key = 'ACCOUNT_TELEPHONE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title39', configuration_description = '$title123' WHERE configuration_key = 'ACCOUNT_FAX'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title40', configuration_description = '$title124' WHERE configuration_key = 'DEFAULT_CURRENCY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title41', configuration_description = '$title125' WHERE configuration_key = 'DEFAULT_LANGUAGE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title42', configuration_description = '$title126' WHERE configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title43', configuration_description = '$title127' WHERE configuration_key = 'DEFAULT_IMAGE_GROUP_ID'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title44', configuration_description = '$title128' WHERE configuration_key = 'DEFAULT_TEMPLATE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title45', configuration_description = '$title129' WHERE configuration_key = 'SHIPPING_ORIGIN_COUNTRY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title46', configuration_description = '$title130' WHERE configuration_key = 'SHIPPING_ORIGIN_ZIP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title47', configuration_description = '$title131' WHERE configuration_key = 'SHIPPING_MAX_WEIGHT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title48', configuration_description = '$title132' WHERE configuration_key = 'SHIPPING_BOX_WEIGHT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title49', configuration_description = '$title133' WHERE configuration_key = 'SHIPPING_BOX_PADDING'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title50', configuration_description = '$title134' WHERE configuration_key = 'SHIPPING_WEIGHT_UNIT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title51', configuration_description = '$title135' WHERE configuration_key = 'PRODUCT_LIST_IMAGE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title52', configuration_description = '$title136' WHERE configuration_key = 'PRODUCT_LIST_MANUFACTURER'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title53', configuration_description = '$title137' WHERE configuration_key = 'PRODUCT_LIST_MODEL'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title54', configuration_description = '$title138' WHERE configuration_key = 'PRODUCT_LIST_NAME'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title55', configuration_description = '$title139' WHERE configuration_key = 'PRODUCT_LIST_PRICE'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title56', configuration_description = '$title140' WHERE configuration_key = 'PRODUCT_LIST_QUANTITY'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title57', configuration_description = '$title141' WHERE configuration_key = 'PRODUCT_LIST_WEIGHT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title58', configuration_description = '$title142' WHERE configuration_key = 'PRODUCT_LIST_BUY_NOW'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title59', configuration_description = '$title143' WHERE configuration_key = 'PRODUCT_LIST_FILTER'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title60', configuration_description = '$title144' WHERE configuration_key = 'PREV_NEXT_BAR_LOCATION'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title61', configuration_description = '$title145' WHERE configuration_key = 'STOCK_CHECK'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title62', configuration_description = '$title146' WHERE configuration_key = 'STOCK_LIMITED'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title63', configuration_description = '$title147' WHERE configuration_key = 'STOCK_ALLOW_CHECKOUT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title64', configuration_description = '$title148' WHERE configuration_key = 'STOCK_MARK_PRODUCT_OUT_OF_STOCK'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title65', configuration_description = '$title149' WHERE configuration_key = 'STOCK_REORDER_LEVEL'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title66', configuration_description = '$title150' WHERE configuration_key = 'EMAIL_TRANSPORT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title67', configuration_description = '$title151' WHERE configuration_key = 'EMAIL_LINEFEED'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title68', configuration_description = '$title152' WHERE configuration_key = 'EMAIL_USE_HTML'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title69', configuration_description = '$title153' WHERE configuration_key = 'ENTRY_EMAIL_ADDRESS_CHECK'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title70', configuration_description = '$title154' WHERE configuration_key = 'SEND_EMAILS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title71', configuration_description = '$title155' WHERE configuration_key = 'DOWNLOAD_ENABLED'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title72', configuration_description = '$title156' WHERE configuration_key = 'DOWNLOAD_BY_REDIRECT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title73', configuration_description = '$title157' WHERE configuration_key = 'DOWNLOAD_MAX_DAYS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title74', configuration_description = '$title158' WHERE configuration_key = 'DOWNLOAD_MAX_COUNT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title75', configuration_description = '$title159' WHERE configuration_key = 'DISPLAY_CONDITIONS_ON_CHECKOUT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title76', configuration_description = '$title160' WHERE configuration_key = 'DISPLAY_PRIVACY_CONDITIONS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title77', configuration_description = '$title161' WHERE configuration_key = 'CFG_CREDIT_CARDS_VERIFY_WITH_REGEXP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title78', configuration_description = '$title162' WHERE configuration_key = 'CFG_CREDIT_CARDS_VERIFY_WITH_JS'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title79', configuration_description = '$title163' WHERE configuration_key = 'CFG_APP_GZIP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title80', configuration_description = '$title164' WHERE configuration_key = 'CFG_APP_GUNZIP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title81', configuration_description = '$title165' WHERE configuration_key = 'CFG_APP_ZIP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title82', configuration_description = '$title166' WHERE configuration_key = 'CFG_APP_UNZIP'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title83', configuration_description = '$title167' WHERE configuration_key = 'CFG_APP_CURL'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title84', configuration_description = '$title168' WHERE configuration_key = 'CFG_APP_IMAGEMAGICK_CONVERT'");
	$osC_Database->simpleQuery("UPDATE " . DB_TABLE_PREFIX . "configuration SET configuration_title = '$title169', configuration_description = '$title170' WHERE configuration_key = 'NEW_PRODUCTS_CART'");

	}
	
    echo '<li id="cfgGroup1" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=1'), $osC_Language->get('access_configuration_title1')) . '</li>';
    echo '<li id="cfgGroup2" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=2'), $osC_Language->get('access_configuration_title2')) . '</li>';
    echo '<li id="cfgGroup3" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=3'), $osC_Language->get('access_configuration_title3')) . '</li>';
    echo '<li id="cfgGroup4" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=4'), $osC_Language->get('access_configuration_title4')) . '</li>';
    echo '<li id="cfgGroup5" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=5'), $osC_Language->get('access_configuration_title5')) . '</li>';

    echo '<li id="cfgGroup7" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=7'), $osC_Language->get('access_configuration_title7')) . '</li>';
    echo '<li id="cfgGroup8" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=8'), $osC_Language->get('access_configuration_title8')) . '</li>';
    echo '<li id="cfgGroup9" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=9'), $osC_Language->get('access_configuration_title9')) . '</li>';
    echo '<li id="cfgGroup12" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=12'), $osC_Language->get('access_configuration_title12')) . '</li>';
    //echo '<li id="cfgGroup13" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=13'), $osC_Language->get('access_configuration_title13')) . '</li>';
    echo '<li id="cfgGroup16" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=16'), $osC_Language->get('access_configuration_title16')) . '</li>';
    echo '<li id="cfgGroup17" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=17'), $osC_Language->get('access_configuration_title17')) . '</li>';
    echo '<li id="cfgGroup18" style="list-style: circle;">' . osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=18'), $osC_Language->get('access_configuration_title18')) . '</li>';	
  
?>

  </ul>

</div>

<script type="text/javascript"><!--
  $('#cfgGroup<?php echo (int)$_GET['gID']; ?>').css('listStyle', 'disc').find('a').css({'fontWeight': 'bold', 'textDecoration': 'none'});
//--></script>

<div id="dataTableContainer" style="margin-left: 160px;">
  <div style="padding: 2px; min-height: 16px;">
    <span id="batchTotalPages"></span>
    <span id="batchPageLinks"></span>
  </div>

  <form name="batch" action="#" method="post">

  <table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable" id="configurationDataTable">
    <thead>
      <tr>
        <th align="left" width="35%;"><?php echo $osC_Language->get('table_heading_title'); ?></th>
        <th align="left"><?php echo $osC_Language->get('table_heading_value'); ?></th>
        <th align="right" width="150"><?php echo $osC_Language->get('table_heading_action'); ?></th>
        <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th align="right" colspan="3"><?php echo '<input type="image" src="' . osc_icon_raw('edit.png') . '" title="' . $osC_Language->get('icon_edit') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=' . $_GET['gID'] . '&action=batch_save') . '\';" />'; ?></th>
        <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
      </tr>
    </tfoot>
    <tbody>
    </tbody>
  </table>

  </form>

  <div style="padding: 2px; min-height: 16px;">
    <span id="dataTableLegend"><?php echo '<b>' . $osC_Language->get('table_action_legend') . '</b> ' . osc_icon('edit.png') . '&nbsp;' . $osC_Language->get('icon_edit'); ?></span>
    <span id="batchPullDownMenu"></span>
  </div>
</div>

<div style="clear: both;"></div>

<script type="text/javascript"><!--
  var moduleParamsCookieName = 'oscadmin_module_' + pageModule;

  var moduleParams = new Object();
  moduleParams.page = 1;
  moduleParams.search = '';

  if ( $.cookie(moduleParamsCookieName) != null ) {
    var p = $.secureEvalJSON($.cookie(moduleParamsCookieName));
    moduleParams.page = parseInt(p.page);
    moduleParams.search = String(p.search);
  }

  var dataTableName = 'configurationDataTable';
  var dataTableDataURL = '<?php echo osc_href_link_admin('rpc.php', $osC_Template->getModule() . '&action=getAll&gID=' . (int)$_GET['gID']); ?>';

  var configEditLink = '<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&gID=' . (int)$_GET['gID'] . '&cID=CONFIGID&action=save'); ?>';
  var configEditLinkIcon = '<?php echo osc_icon('edit.png'); ?>';

  var osC_DataTable = new osC_DataTable();
  osC_DataTable.load();

  function feedDataTable(data) {
    var rowCounter = 0;

    for ( var r in data.entries ) {
      var record = data.entries[r];

      var newRow = $('#' + dataTableName)[0].tBodies[0].insertRow(rowCounter);
      newRow.id = 'row' + parseInt(record.configuration_id);

      $('#row' + parseInt(record.configuration_id)).mouseover( function() { rowOverEffect(this); }).mouseout( function() { rowOutEffect(this); }).click(function(event) {
        if (event.target.type !== 'checkbox') {
          $(':checkbox', this).trigger('click');
        }
      }).css('cursor', 'pointer');

      var newCell = newRow.insertCell(0);
      newCell.innerHTML = htmlSpecialChars(record.configuration_title);

      var newCell = newRow.insertCell(1);
      newCell.innerHTML = htmlSpecialChars(record.configuration_value).replace(/([^>]?)\n/g, '$1<br />\n'); // nl2br()

      newCell = newRow.insertCell(2);
      newCell.innerHTML = '<a href="' + configEditLink.replace('CONFIGID', parseInt(record.configuration_id)) + '">' + configEditLinkIcon + '</a>';
      newCell.align = 'right';

      newCell = newRow.insertCell(3);
      newCell.innerHTML = '<input type="checkbox" name="batch[]" value="' + parseInt(record.configuration_id) + '" id="batch' + parseInt(record.configuration_id) + '" />';
      newCell.align = 'center';

      rowCounter++;
    }
  }

/* HPDL
  var infoPaneWidth = $('#dataTableContainer').css('marginLeft');

  function toggleInfoPane() {
    if ( $('#dataTableContainer').css('marginLeft') == '0px' ) {
      $('#dataTableContainer').css('marginLeft', infoPaneWidth);
      $('#infoPane').show('fast');
    } else {
      $('#infoPane').hide('fast', function() { $('#dataTableContainer').css('marginLeft', '0px'); });
    }
  }
*/
//--></script>
