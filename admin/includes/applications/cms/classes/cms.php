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
  
  RuBiC modify (http://www.rubicshop.ru)
*/


  //include('../includes/classes/cms.php');

  class osC_cms_Admin {
    public static function getData($id) {
      global $osC_Database, $osC_Language;


      $QcmsListItem = $osC_Database->query('select * from :table_cms where cms_id = :cms_id and language_id = :language_id');
      $QcmsListItem->bindTable(':table_cms', TABLE_CMS);
      $QcmsListItem->bindInt(':cms_id', $id);
      $QcmsListItem->bindInt(':language_id', $osC_Language->getID());
      $QcmsListItem->execute();
      
      $data = $QcmsListItem->toArray(); 
      
      $QcmsListItem->freeResult();
      
      return $data;
      
    }

    public static function save($id = null, $data, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();

      if ( is_numeric($id) ) {
        $cms_id = $id;
      } else {
        $Qstatus = $osC_Database->query('select max(cms_id) as cms_id from :table_cms');
        $Qstatus->bindTable(':table_cms', TABLE_CMS);
        $Qstatus->execute();

        $cms_id = $Qstatus->valueInt('cms_id') + 1;
      }

      foreach ( $osC_Language->getAll() as $l ) {
        if ( is_numeric($id) ) {
          $Qstatus = $osC_Database->query('update :table_cms set active = :active, cms_name = :cms_name, cms_description = :cms_description, last_modified = :last_modified, cms_short_text = :cms_short_text where cms_id = :cms_id and language_id = :language_id');
        } else {
          $Qstatus = $osC_Database->query('insert into :table_cms (cms_id, language_id, cms_name, cms_description, active, last_modified, date_added, cms_short_text) values (:cms_id, :language_id, :cms_name, :cms_description, :active, :last_modified, :date_added, :cms_short_text)');
        }

        $Qstatus->bindTable(':table_cms', TABLE_CMS);
        $Qstatus->bindInt(':cms_id', $cms_id);
        $Qstatus->bindInt(':active', $data['active']);
        $Qstatus->bindValue(':cms_name', $data['cms_name'][$l['id']]);
        $Qstatus->bindValue(':cms_description', $data['cms_description'][$l['id']]);
        $Qstatus->bindRaw(':date_added', 'now()');
        $Qstatus->bindRaw(':last_modified', 'now()');
        $Qstatus->bindValue(':cms_short_text', $data['cms_short_text'][$l['id']]);
        $Qstatus->bindInt(':language_id', $l['id']);
        
        $Qstatus->setLogging($_SESSION['module'], $cms_id);
        $Qstatus->execute();

        if ( $osC_Database->isError() ) {
          $error = true;
          break;
        }
      }

      

      if ( $error === false ) {
        $osC_Database->commitTransaction();

        if ( $default === true ) {
          //osC_Cache::clear('configuration');
        }

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }


    public static function delete($id, $categories = null) {
      global $osC_Database;

      $delete_product = true;
      $error = false;

      $osC_Database->startTransaction();

        $Qpc = $osC_Database->query('delete from :table_cms where cms_id = :cms_id');
        $Qpc->bindTable(':table_cms', TABLE_CMS);
        $Qpc->bindInt(':cms_id', $id);
        $Qpc->setLogging($_SESSION['module'], $id);
        $Qpc->execute();


      if ( $error === false ) {
        $osC_Database->commitTransaction();

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }
    
    
    public static function xsell_save_sort($data, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();

            $Xupdate = $osC_Database->query('UPDATE :table_cms_xsell SET sort_order = :sort_value WHERE xsell_id= :xsell_id and cms_id = :cms_id');
            $Xupdate->bindTable(':table_cms_xsell', TABLE_CMS_XSELL);
            $Xupdate->bindInt(':sort_value', $data['short_order']);
            $Xupdate->bindInt(':xsell_id', $data['xsell_id']);
            $Xupdate->bindInt(':cms_id', $data['cms_id']);            
            $Xupdate->execute();
       
        if ( $osC_Database->isError() ) {
          $error = true;
          break;
        }
    
     

      if ( $error === false ) {
        $osC_Database->commitTransaction();

        if ( $default === true ) {
          //osC_Cache::clear('configuration');
        }

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }
    
    public static function category_tree($id = null, $categories = null) {
      global $osC_Database, $osC_Language;

      $Qcategories = $osC_Database->query('select c.categories_id, c.parent_id, c.categories_image, cd.categories_name from :table_categories c, :table_categories_description cd where c.categories_id = cd.categories_id and cd.language_id = :language_id order by c.parent_id, c.sort_order, cd.categories_name');
      $Qcategories->bindTable(':table_categories', TABLE_CATEGORIES);
      $Qcategories->bindTable(':table_categories_description', TABLE_CATEGORIES_DESCRIPTION);
      $Qcategories->bindInt(':language_id', $osC_Language->getID());
      $Qcategories->execute();

      $data = array();

      while ( $Qcategories->next() ) {
//        $data[$Qcategories->valueInt('parent_id')][$Qcategories->valueInt('categories_id')] = array('name' => $Qcategories->value('categories_name'), 'image' => $Qcategories->value('categories_image'), 'count' => 0);
            $data[] = array('id' => $Qcategories->valueInt('categories_id'),
                           'text' => $Qcategories->value('categories_name'));        
//             array_push($data, $Qcategories->value('categories_name'));
      }

                  
//      $Qcategories->freeResult();

//      if ($this->_show_total_products === true) {
//        $this->_calculateProductTotals(false);
//      }
      return($data);
    }
    
    public static function xsell_delete_all($data, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();
      
            $XsortList = $osC_Database->query('delete from :table_cms_xsell where cms_id = :cms_idpost');
            $XsortList->bindTable(':table_cms_xsell', TABLE_CMS_XSELL);
            $XsortList->bindInt(':cms_idpost', $data['cms_id']);
            $XsortList->execute();
            
        if ( $osC_Database->isError() ) {
          $error = true;
          break;
        }

      if ( $error === false ) {
        $osC_Database->commitTransaction();

        if ( $default === true ) {
          //osC_Cache::clear('configuration');
        }

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }            

    public static function xsell_update($data_cms, $data_xsell, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();
      
           $XaddList = $osC_Database->query('insert into :table_cms_xsell (ID, cms_id, xsell_id, sort_order) values (:id, :cms_id, :xsell_id, :xsell_sort)' );
           $XaddList->bindTable(':table_cms_xsell', TABLE_CMS_XSELL);
           $XaddList->bindInt(':id', '');           
           $XaddList->bindInt(':cms_id', $data_cms);
           $XaddList->bindInt(':xsell_id', $data_xsell);
           $XaddList->bindInt(':xsell_sort', 1);      
           $XaddList->execute();
           
           $Number_addrow = 0;
           $Number_addrow = $XaddList->numberOfRows();
          
           if ( $Number_addrow >0 ) exit( $osC_Language->get('text_no_insert') );
            
        if ( $osC_Database->isError() ) {
          $error = true;
          break;
        }

      if ( $error === false ) {
        $osC_Database->commitTransaction();

        if ( $default === true ) {
          //osC_Cache::clear('configuration');
        }

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    } 
    
 }
?>
