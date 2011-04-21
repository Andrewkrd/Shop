<?php
/*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename cms.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tóth
  http://oscommerce-extra.hu
*/

  class osC_Cms {


/* Class constructor */

    function osC_Cms() {
    }

    function &getEntry() {
      global $osC_Database, $osC_Language;

      $QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id order by date_added DESC');
      $QcmsList->bindTable(':table_cms', TABLE_CMS);
      $QcmsList->bindInt(':language_id', $osC_Language->getID());
      $QcmsList->execute();

      return $QcmsList;
    }

//    function &getListing($limit = null, $page_keyword = 'page') {
// next page http://osc3.demowebshop.hu/products.php?specials&page=2
// error pages when http://osc3.demowebshop.hu/products.php?&page=2!

    function &getListing() {
      global $osC_Database, $osC_Language;

      $QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id order by date_added DESC');
      $QcmsList->bindTable(':table_cms', TABLE_CMS);
      $QcmsList->bindInt(':language_id', $osC_Language->getID());
      $QcmsList->setBatchLimit((isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1), MAX_DISPLAY_CMS_ARTICLES);
      $QcmsList->execute();
      

//      if (is_numeric($limit)) {
//        $QcmsList->setBatchLimit(isset($_GET[$page_keyword]) && is_numeric($_GET[$page_keyword]) ? $_GET[$page_keyword] : 1, $limit);
//      }

//      $QcmsList->execute();

      return $QcmsList;
    }

    function &getDetails() {
      global $osC_Database, $osC_Language;

      $QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id and cms_id = :request_id order by date_added DESC');
      $QcmsList->bindTable(':table_cms', TABLE_CMS);
      //$Qaccount->bindInt(':customers_id', $osC_Customer->getID());
      $QcmsList->bindInt(':language_id', $osC_Language->getID());
      $QcmsList->bindInt(':request_id', $_GET['view']);
      $QcmsList->execute();

      return $QcmsList;
    }

    function &getsitemapListing() {
      global $osC_Database, $osC_Language;

      $QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id order by date_added DESC');
      $QcmsList->bindTable(':table_cms', TABLE_CMS);
      $QcmsList->bindInt(':language_id', $osC_Language->getID());
      $QcmsList->execute();
   
      return $QcmsList;
    }
    
    function &getsearchDetail($key) {
      global $osC_Database, $osC_Language;
 
      $QcmsList = $osC_Database->query('select * from :table_cms where active = "1" and language_id = :language_id and cms_description LIKE "%' . $key . '%" order by date_added DESC');
      $QcmsList->bindTable(':table_cms', TABLE_CMS);
      $QcmsList->bindInt(':language_id', $osC_Language->getID());
      $QcmsList->setBatchLimit((isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1), MAX_DISPLAY_CMS_ARTICLES);      
      $QcmsList->execute();

      return $QcmsList;
    }
  }
?>
