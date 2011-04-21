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

<form name="search" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT); ?>" method="get"><?php echo osc_draw_hidden_field($osC_Template->getModule()); ?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

</table>
<p align="right">

<?php
  echo '<input type="button" value="' . $osC_Language->get('button_insert') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=save') . '\';" class="infoBoxButton" />';
?>

</p>

</form>

<?php

  $QinfoList = $osC_Database->query('select info_id, active, info_name, info_description, sort_order from :table_info where language_id = :language_id');


  $QinfoList->appendQuery('order by sort_order ASC');
  $QinfoList->bindTable(':table_info', TABLE_INFO);
  $QinfoList->bindInt(':language_id', $osC_Language->getID());
  $QinfoList->setBatchLimit($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, (!empty($_GET['search']) ? 'distinct info_id' : ''));
  $QinfoList->execute();
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><?php echo $QinfoList->getBatchTotalPages($osC_Language->get('batch_results_number_of_entries')); ?></td>
    <td align="right"><?php echo $QinfoList->getBatchPageLinks('page', $osC_Template->getModule(), false); ?></td>
  </tr>
</table>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
  <thead>
    <tr>
      <th align="left"><?php echo $osC_Language->get('table_heading_name'); ?></th>
      <th><?php echo ''; ?></th>
      <th width="10%"><?php echo $osC_Language->get('table_heading_status'); ?></th>
      <th width="10%"><?php echo $osC_Language->get('sort_order'); ?></th>
      <th align="right" width="10%"><?php echo $osC_Language->get('table_heading_action'); ?></th>
      <th align="right" width="20" colspan="2"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th align="right" colspan="5"><?php echo '<input type="image" src="' . osc_icon_raw('trash.png') . '" title="' . $osC_Language->get('icon_trash') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete') . '\';" />'; ?></th>
      <th align="right" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </tfoot>
  <tbody>

<?php
  while ($QinfoList->next()) {
  	if (($QinfoList->valueInt('info_id')) <= 3) {
?>

    <tr onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" <?php echo (($QinfoList->valueInt('active') !== 1) ? 'class="deactivatedRow"' : '') ?>>
      <td><?php echo $QinfoList->value('info_name'); ?></td>
      <td align="left" width="55%"><?php echo ''; ?></td>
      <td align="center"><?php echo osc_icon(($QinfoList->valueInt('active') === 1) ? 'checkbox_ticked.gif' : 'checkbox_crossed.gif', null, null); ?></td>
      <td align="center"><?php echo $QinfoList->value('sort_order'); ?></td>
      <td align="right">

<?php
    echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QinfoList->valueInt('info_id') . '&action=save'), osc_icon('edit.png')) . '&nbsp;' . osc_icon('checkbox_crossed.gif');
?>

      </td>
      <td align="center"><?php echo osc_icon('checkbox_crossed.gif'); ?></td>
    </tr>

<?php
  	} else {
?>
<tr onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" <?php echo (($QinfoList->valueInt('active') !== 1) ? 'class="deactivatedRow"' : '') ?>>
      <td onclick="document.getElementById('batch<?php echo $QinfoList->valueInt('info_id'); ?>').checked = !document.getElementById('batch<?php echo $QinfoList->valueInt('info_id'); ?>').checked;"><?php echo $QinfoList->value('info_name'); ?></td>
      <td align="left" width="55%"><?php echo ''; ?></td>
      <td align="center"><?php echo osc_icon(($QinfoList->valueInt('active') === 1) ? 'checkbox_ticked.gif' : 'checkbox_crossed.gif', null, null); ?></td>
      <td align="center"><?php echo $QinfoList->value('sort_order'); ?></td>
      <td align="right">

<?php
    echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QinfoList->valueInt('info_id') . '&action=save'), osc_icon('edit.png')) . '&nbsp;' .
         osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QinfoList->valueInt('info_id') . '&action=delete'), osc_icon('trash.png'));
?>

      </td>
      <td align="center"><?php echo osc_draw_checkbox_field('batch[]', $QinfoList->valueInt('info_id'), null, 'id="batch' . $QinfoList->valueInt('info_id') . '"'); ?></td>
    </tr>
<?php
  	}
  	}
?>

  </tbody>
</table>

</form>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td style="opacity: 0.5; filter: alpha(opacity=50);"><?php echo '<b>' . $osC_Language->get('table_action_legend') . '</b> ' . osc_icon('edit.png') . '&nbsp;' . $osC_Language->get('icon_edit') . '&nbsp;&nbsp;' . osc_icon('trash.png') . '&nbsp;' . $osC_Language->get('icon_trash'); ?></td>
    <td align="right"><?php echo $QinfoList->getBatchPagesPullDownMenu('page', $osC_Template->getModule()); ?></td>
  </tr>
</table>
