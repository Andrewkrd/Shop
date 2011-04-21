<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/

  $osC_ObjectInfo = new osC_ObjectInfo(osC_info_Admin::getData($_GET['pID']));

  $in_categories = array();

?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ($osC_MessageStack->size($osC_Template->getModule()) > 0) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png') . ' ' . $osC_ObjectInfo->get('info_name'); ?></div>
<div class="infoBoxContent">
  <form name="pDelete" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $osC_ObjectInfo->get('info_id') . '&action=delete'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_delete_product'); ?></p>

  <p><?php echo '<b>' . $osC_ObjectInfo->get('info_name') . '</b>'; ?></p>


  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_delete') . '" class="operationButton" /> 
  <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] ) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
