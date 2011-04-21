<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/

  $Qlanguages = $osC_Database->query('select languages_id, name, code from :table_languages order by languages_id');
  $Qlanguages->bindTable(':table_languages', TABLE_LANGUAGES);
  $Qlanguages->execute();

  $languages_array = array();

  while ( $Qlanguages->next() ) {
    $languages_array[] = array('id' => $Qlanguages->value('languages_id'),
                            'text' => $Qlanguages->value('name'));
  }

  $osC_ObjectInfo = new osC_ObjectInfo(osC_SlideManager_Admin::getData($_GET['bID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('edit.png') . ' ' . $osC_Language->get('action_heading_edit_banners'); ?></div>
<div class="infoBoxContent">
  <form name="bEdit" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&bID=' . $osC_ObjectInfo->get('image_id') . '&action=save'); ?>" method="post" enctype="multipart/form-data">

  <p><?php echo $osC_Language->get('introduction_edit_banner'); ?></p>

  <table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_url') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_input_field('url', $osC_ObjectInfo->get('image_url'), 'style="width: 99%;"'); ?></td>
    </tr>
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_group') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_pull_down_menu('group', $languages_array, $osC_ObjectInfo->get('language_id')); ?></td>
    </tr>
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_image') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_hidden_field('image_local', $osC_ObjectInfo->get('image')) . '<img src="../images/' . $osC_ObjectInfo->get('image') . '" height="30" />'; ?></td>
    </tr>
    <tr>
      <td width="40%"><?php echo ' '; ?></td>
      <td width="60%"><?php echo osc_draw_hidden_field('image_target'); ?></td>
    </tr>
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_status') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_checkbox_field('status', null, (($osC_ObjectInfo->get('status') == '1') ? true : false)); ?></td>
    </tr>
  </table>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
