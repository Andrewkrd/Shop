<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/
?>
<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ($osC_MessageStack->size($osC_Template->getModule()) > 0) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png') . ' ' . $osC_Language->get('action_heading_batch_delete_products'); ?></div>
<div class="infoBoxContent">
  <form name="pDelete" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_batch_delete_products'); ?></p>

<?php
  $Qproducts = $osC_Database->query('select info_id, info_name from :table_info where info_id in (":info_id") and language_id = :language_id order by info_name');
  $Qproducts->bindTable(':table_info', TABLE_INFO);
  $Qproducts->bindRaw(':info_id', implode('", "', array_unique(array_filter(array_slice($_POST['batch'], 0, MAX_DISPLAY_SEARCH_RESULTS), 'is_numeric'))));
  $Qproducts->bindInt(':language_id', $osC_Language->getID());
  $Qproducts->execute();

  $names_string = '';

  while ($Qproducts->next()) {
    $names_string .= osc_draw_hidden_field('batch[]', $Qproducts->valueInt('info_id')) . '<b>' . $Qproducts->value('info_name') . '</b>, ';
  }

  if ( !empty($names_string) ) {
    $names_string = substr($names_string, 0, -2) . osc_draw_hidden_field('subaction', 'confirm');
  }

  echo '<p>' . $names_string . '</p>';
?>

  <p align="center"><?php echo '<input type="submit" value="' . $osC_Language->get('button_delete') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
