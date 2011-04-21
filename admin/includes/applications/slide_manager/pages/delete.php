<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/

  $osC_ObjectInfo = new osC_ObjectInfo(osC_SlideManager_Admin::getData($_GET['bID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png') . ' ' . $osC_Language->get('action_heading_delete_banners');; ?></div>
<div class="infoBoxContent">
  <form name="bDelete" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&bID=' . $osC_ObjectInfo->get('image_id') . '&action=delete'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_delete_banners'); ?></p>

  <p><?php echo '<img src="../images/' . $osC_ObjectInfo->get('image') . '" width="250" />'; ?></p>

<?php
  if ( !osc_empty($osC_ObjectInfo->get('image')) ) {
    echo '  <p>' . osc_draw_checkbox_field('delete_image', array(array('id' => 'on', 'text' => $osC_Language->get('field_delete_image'))), true) . '</p>';
  }
?>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_delete') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
