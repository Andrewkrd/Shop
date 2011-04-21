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

  class osC_Products_Products extends osC_Template {

/* Private variables */

    var $_module = 'products',
        $_group = 'products',
        $_page_title,
        $_page_contents = 'info.php',
        $_page_image = 'table_background_list.gif';

/* Class constructor */

    function osC_Products_Products() {
      global $osC_Database, $osC_Services, $osC_Session, $osC_Language, $osC_Breadcrumb, $osC_Product;

      if (empty($_GET) === false) {
        $id = false;

// PHP < 5.0.2; array_slice() does not preserve keys and will not work with numerical key values, so foreach() is used
		//print_r($_GET);
        foreach ($_GET as $key => $value) {
        	//echo "key=" . $key. " value=" . $value; 
          //if ( (preg_match('/^[0-9]+(#?([0-9]+:?[0-9]+)+(;?([0-9]+:?[0-9]+)+)*)*$/', $key) || preg_match('/^[a-zA-Z0-9 -_]*$/', $key)) && 
          if(($key != $osC_Session->getName()) ) {//if ( (ereg('^[0-9]+(#?([0-9]+:?[0-9]+)+(;?([0-9]+:?[0-9]+)+)*)*$', $key) || ereg('^[a-zA-Z0-9 -_]*$', $key)) && ($key != $osC_Session->getName()) ) {
           $id = $key;
          }
          break;
        }
        
       // Andrew если браузер закодировал кирилицу в uri определяем это и раскодируем
      // echo $id;
       //iconv()
       //echo iconv('WINDOWS-1251', 'UTF-8', $id);
       // if(substr_count(iconv('WINDOWS-1251', 'UTF-8', $id), "%") > 2)       
       //	echo	$id = urldecode(iconv('WINDOWS-1251', 'UTF-8', $id));
        
        
      
      //  var_dump($id); echo "|";
     //$id="Эл. вертолёт Арт.6009 art 6009";
     
     //Andrew Заменить символы на подчёркивание для соответствия GET данных и keywords
	//	$rpl = array(",", ".", " ");
	//	$id = str_replace($rpl, "_", $id);
     
     
     //var_dump($id);
        if (($id !== false) && osC_Product::checkEntry($id)) {
          $osC_Product = new osC_Product($id);
          $osC_Product->incrementCounter();

          $this->addPageTags('keywords', $osC_Product->getTitle());
          $this->addPageTags('keywords', $osC_Product->getModel());

          if ($osC_Product->hasTags()) {
            $this->addPageTags('keywords', $osC_Product->getTags());
          }

          $this->addJavascriptFilename('templates/' . $this->getCode() . '/javascript/' . $this->_group . '/info.js');

          osC_Services_category_path::process($osC_Product->getCategoryID());

          if ($osC_Services->isStarted('breadcrumb')) {
            $osC_Breadcrumb->add($osC_Product->getTitle(), osc_href_link(FILENAME_PRODUCTS, $osC_Product->getKeyword()));
          }

          $this->_page_title = $osC_Product->getTitle();
        } else {
          $this->_page_title = $osC_Language->get('product_not_found_heading');
          $this->_page_contents = 'info_not_found.php';
        }
      } else {
        $this->_page_title = $osC_Language->get('product_not_found_heading');
        $this->_page_contents = 'info_not_found.php';
      }
    }
  }
?>
