<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
  RuBiC modify (http://www.rubicshop.ru)
*/

  class osC_ShippingAvailability_Admin {
    public static function getData($id) {
      global $osC_Database, $osC_Language;

      $Qstatus = $osC_Database->query('select * from :table_shipping_availability where id = :id and languages_id = :languages_id');
      $Qstatus->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
      $Qstatus->bindInt(':id', $id);
      $Qstatus->bindInt(':languages_id', $osC_Language->getID());
      $Qstatus->execute();

      $data = $Qstatus->toArray();

      $Qstatus->freeResult();

      return $data;
    }

    public static function save($id = null, $data1, $data2, $default = false) {
      global $osC_Database, $osC_Language;

      $error = false;

      $osC_Database->startTransaction();

      if ( is_numeric($id) ) {
        $shippings_id = $id;
      } else {
        $Qstatus = $osC_Database->query('select max(id) as id from :table_shipping_availability');
        $Qstatus->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
        $Qstatus->execute();

        $shippings_id = $Qstatus->valueInt('id') + 1;
      }

      foreach ( $osC_Language->getAll() as $l ) {
        if ( is_numeric($id) ) {
          $Qstatus = $osC_Database->query('update :table_shipping_availability set title = :title, css_key = :css_key where id = :id and languages_id = :languages_id');
        } else {
          $Qstatus = $osC_Database->query('insert into :table_shipping_availability (id, languages_id, title, css_key) values (:id, :languages_id, :title, :css_key)');
        }

        $Qstatus->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
        $Qstatus->bindInt(':id', $shippings_id);
        $Qstatus->bindValue(':title', $data1['title'][$l['id']]);
        $Qstatus->bindValue(':css_key', 'ships24hours');
        $Qstatus->bindInt(':languages_id', $l['id']);
        $Qstatus->setLogging($_SESSION['module'], $shippings_id);
        $Qstatus->execute();

        if ( $osC_Database->isError() ) {
          $error = true;
          break;
        }
      }

      if ( $error === false ) {
        $osC_Database->commitTransaction();

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }

    public static function delete($id) {
      global $osC_Database;

      $Qstatus = $osC_Database->query('delete from :table_shipping_availability where id = :id');
      $Qstatus->bindTable(':table_shipping_availability', TABLE_SHIPPING_AVAILABILITY);
      $Qstatus->bindInt(':id', $id);
      $Qstatus->setLogging($_SESSION['module'], $id);
      $Qstatus->execute();

      if ( !$osC_Database->isError() ) {
        return true;
      }

      return false;
    }
  }
?>
