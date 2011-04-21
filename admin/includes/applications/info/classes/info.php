<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/

  //include('../includes/classes/info.php');

  class osC_info_Admin {
    public static function getData($id) {
      global $osC_Database, $osC_Language;


      $QinfoListItem = $osC_Database->query('select * from :table_info where info_id = :info_id and language_id = :language_id');
      $QinfoListItem->bindTable(':table_info', TABLE_INFO);
      $QinfoListItem->bindInt(':info_id', $id);
      $QinfoListItem->bindInt(':language_id', $osC_Language->getID());
      $QinfoListItem->execute();
      
      $data = $QinfoListItem->toArray(); 
      
      $QinfoListItem->freeResult();
      
      return $data;
      
    }

    public static function save($id = null, $data, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();

      if ( is_numeric($id) ) {
        $info_id = $id;
      } else {
        $Qstatus = $osC_Database->query('select max(info_id) as info_id from :table_info');
        $Qstatus->bindTable(':table_info', TABLE_INFO);
        $Qstatus->execute();

        $info_id = $Qstatus->valueInt('info_id') + 1;
      }

      foreach ( $osC_Language->getAll() as $l ) {
        if ( is_numeric($id) ) {
          $Qstatus = $osC_Database->query('update :table_info set active = :active, sort_order = :sort_order, info_name = :info_name, info_description = :info_description, last_modified = :last_modified where info_id = :info_id and language_id = :language_id');
        } else {
          $Qstatus = $osC_Database->query('insert into :table_info (info_id, language_id, info_name, info_description, active, sort_order, last_modified, date_added) values (:info_id, :language_id, :info_name, :info_description, :active, :sort_order, :last_modified, :date_added)');
        }

        $Qstatus->bindTable(':table_info', TABLE_INFO);
        $Qstatus->bindInt(':info_id', $info_id);
        $Qstatus->bindInt(':active', $data['active']);
        $Qstatus->bindInt(':sort_order', $data['sort_order']);
        $Qstatus->bindValue(':info_name', $data['info_name'][$l['id']]);
        $Qstatus->bindValue(':info_description', $data['info_description'][$l['id']]);
        $Qstatus->bindRaw(':date_added', 'now()');
        $Qstatus->bindRaw(':last_modified', 'now()');
        $Qstatus->bindInt(':language_id', $l['id']);
        
        $Qstatus->setLogging($_SESSION['module'], $info_id);
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

        $Qpc = $osC_Database->query('delete from :table_info where info_id = :info_id and info_id > 3');
        $Qpc->bindTable(':table_info', TABLE_INFO);
        $Qpc->bindInt(':info_id', $id);
        $Qpc->setLogging($_SESSION['module'], $id);
        $Qpc->execute();


      if ( $error === false ) {
        $osC_Database->commitTransaction();

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }

 }
?>
