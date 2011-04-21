<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<p align="right"><?php echo '<input type="button" value="' . $osC_Language->get('button_insert') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=save') . '\';" class="infoBoxButton" />'; ?></p>

<?php
  $Qslides = $osC_Database->query('select image_id, language_id, image, image_url, sort_order, status from :table_slides order by image_id, language_id');
  $Qslides->bindTable(':table_slides', TABLE_SLIDES);
  $Qslides->setBatchLimit($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS);
  $Qslides->execute();
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><?php echo $Qslides->getBatchTotalPages($osC_Language->get('batch_results_number_of_entries')); ?></td>
    <td align="right"><?php echo $Qslides->getBatchPageLinks('page', $osC_Template->getModule(), false); ?></td>
  </tr>
</table>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
  <thead>
    <tr>
      <th align="left"><?php echo $osC_Language->get('table_heading_banners'); ?></th>
      <th align="left"><?php echo $osC_Language->get('field_url'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_group'); ?></th>
      <th align="right" width="150"><?php echo $osC_Language->get('table_heading_action'); ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th align="right" colspan="4"><?php echo '<input type="image" src="' . osc_icon_raw('trash.png') . '" title="' . $osC_Language->get('icon_trash') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete') . '\';" />'; ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </tfoot>
  <tbody>

<?php
  while ( $Qslides->next() ) {
    $Qstats = $osC_Database->query('select languages_id, name, code from :table_languages where languages_id = :languages_id');
    $Qstats->bindTable(':table_languages', TABLE_LANGUAGES);
    $Qstats->bindInt(':languages_id', $Qslides->valueInt('language_id'));
    $Qstats->execute();
?>

    <tr onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" <?php echo (($Qslides->valueInt('status') !== 1) ? 'class="deactivatedRow"' : '') ?>>
      <td onclick="document.getElementById('batch<?php echo $Qslides->valueInt('image_id'); ?>').checked = !document.getElementById('batch<?php echo $Qslides->valueInt('image_id'); ?>').checked;"><?php echo '<img src="../images/' . $Qslides->value('image') . '" height="50" />'; ?></td>
      <td align="left"><?php echo $Qslides->valueProtected('image_url'); ?></td>
      <td align="center"><?php echo '<img src="../images/worldflags/' . strtolower(substr($Qstats->value('code'), 3, 2)) . '.png" alt="' . $Qstats->valueProtected('name') . '" title="' . $Qstats->valueProtected('name') . '" />'; ?></td>
      <td align="right">

<?php
    echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&bID=' . $Qslides->valueInt('image_id') . '&action=save'), osc_icon('edit.png')) . '&nbsp;' . 
    osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&bID=' . $Qslides->valueInt('image_id') . '&action=delete'), osc_icon('trash.png'));
?>

      </td>
      <td align="center"><?php echo osc_draw_checkbox_field('batch[]', $Qslides->valueInt('image_id'), null, 'id="batch' . $Qslides->valueInt('image_id') . '"'); ?></td>
    </tr>

<?php
  }
?>

  </tbody>
</table>

</form>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td style="opacity: 0.5; filter: alpha(opacity=50);"><?php echo '<b>' . $osC_Language->get('table_action_legend') . '</b> ' . osc_icon('edit.png') . '&nbsp;' . $osC_Language->get('icon_edit') . '&nbsp;&nbsp;' . osc_icon('trash.png') . '&nbsp;' . $osC_Language->get('icon_trash'); ?></td>
    <td align="right"><?php echo $Qslides->getBatchPagesPullDownMenu('page', $osC_Template->getModule()); ?></td>
  </tr>
</table>
