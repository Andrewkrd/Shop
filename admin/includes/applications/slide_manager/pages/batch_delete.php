<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ($osC_MessageStack->size($osC_Template->getModule()) > 0) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png') . ' ' . $osC_Language->get('action_heading_batch_delete_banners'); ?></div>
<div class="infoBoxContent">
  <form name="bDeleteBatch" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_batch_delete_banners'); ?></p>

<?php
  $Qbanners = $osC_Database->query('select image_id, image from :table_slides where image_id in (":image_id") order by image');
  $Qbanners->bindTable(':table_slides', TABLE_SLIDES);
  $Qbanners->bindRaw(':image_id', implode('", "', array_unique(array_filter(array_slice($_POST['batch'], 0, MAX_DISPLAY_SEARCH_RESULTS), 'is_numeric'))));
  $Qbanners->execute();

  $names_string = '';

  while ( $Qbanners->next() ) {
    $names_string .= osc_draw_hidden_field('batch[]', $Qbanners->valueInt('image_id')) . '<img src="../images/' . $Qbanners->valueProtected('image') . '" width="250" /><br/><br/>';
  }

  if ( !empty($names_string) ) {
    $names_string = substr($names_string, 0, -2);
  }

  echo '<p>' . $names_string . '</p>';
?>

  <p><?php echo osc_draw_checkbox_field('delete_image', array(array('id' => 'on', 'text' => $osC_Language->get('field_batchdelete_image'))), true); ?></p>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_delete') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
