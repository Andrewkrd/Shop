<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/

  class osC_SlideManager_Admin {
    public static function getData($id) {
      global $osC_Database;

      $Qslide = $osC_Database->query('select * from :table_slides where image_id = :image_id');
      $Qslide->bindTable(':table_slides', TABLE_SLIDES);
      $Qslide->bindInt(':image_id', $id);
      $Qslide->execute();

      $data = $Qslide->toArray();

      $Qslide->freeResult();

      return $data;
    }

    public static function save($id = null, $data) {
      global $osC_Database;

      $error = false;

        $images = array();

        $image = new img_upload('image');
        $image->set_extensions(array('gif', 'jpg', 'jpeg', 'png'));

        if ( $image->exists() ) {
          $image->set_destination(realpath('../images/' . $data['image_target']));

          if ( $image->parse() && $image->save() ) {
            $images[] = time().'_'.$image->filename;
          }
        }

      if ( $error === false ) {
        $image_location = (!empty($data['image_local']) ? $data['image_local'] : (isset($image) ? $data['image_target'] . time().'_'.$image->filename : null));

        if ( is_numeric($id) ) {
          $Qslide = $osC_Database->query('update :table_slides set language_id = :language_id, image = :image, image_url = :image_url, status = :status where image_id = :image_id');
          $Qslide->bindInt(':image_id', $id);
        } else {
          $Qslide = $osC_Database->query('insert into :table_slides (language_id, image, image_url, status) values (:language_id, :image, :image_url, :status)');
        }

        $Qslide->bindTable(':table_slides', TABLE_SLIDES);
        $Qslide->bindValue(':language_id', $data['group']);
        $Qslide->bindValue(':image_url', $data['url']);
        $Qslide->bindValue(':image', $image_location);
		$Qslide->bindInt(':status', (($data['status'] === true) ? 1 : 0));

        $Qslide->setLogging($_SESSION['module'], $id);
        $Qslide->execute();

        if ( !$osC_Database->isError() ) {
          return true;
        }
      }

      return false;
    }

    public static function delete($id, $delete_image = false) {
      global $osC_Database;

      $error = false;

      $osC_Database->startTransaction();

      if ( $delete_image === true ) {
        $Qimage = $osC_Database->query('select image_id, image from :table_slides where image_id = :image_id');
        $Qimage->bindTable(':table_slides', TABLE_SLIDES);
        $Qimage->bindInt(':image_id', $id);
        $Qimage->execute();
      }

      $Qdelete = $osC_Database->query('delete from :table_slides where image_id = :image_id');
      $Qdelete->bindTable(':table_slides', TABLE_SLIDES);
      $Qdelete->bindInt(':image_id', $id);
      $Qdelete->setLogging($_SESSION['module'], $id);
      $Qdelete->execute();

      if ( $osC_Database->isError() ) {
        $error = true;
      }

      if ( $error === false ) {
        if ( $delete_image === true ) {
          if ( !osc_empty($Qimage->value('image')) ) {
            if ( is_file('../images/' . $Qimage->value('image')) && is_writeable('../images/' . $Qimage->value('image')) ) {
              @unlink('../images/' . $Qimage->value('image'));
            }
          }
        }

        $osC_Database->commitTransaction();

        return true;
      }

      $osC_Database->rollbackTransaction();

      return false;
    }
  }
?>
