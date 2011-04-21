<?php
/*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename main.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tóth
  http://oscommerce-extra.hu
  
  RuBiC modify (http://www.rubicshop.ru)
*/
   function utf8_wordwrap($str, $width = 75, $break = "\n", $return = '') // wordwrap() with utf-8 support
    {
        $str =  preg_split('/([\x20\r\n\t]++|\xc2\xa0)/sSX', $str, -1, PREG_SPLIT_NO_EMPTY);
        $len = 0;
        foreach ($str as $val)
        {
            $val .= ' ';
            $tmp = mb_strlen($val, 'utf-8');
            $len += $tmp;
            if ($len >= $width)
            {
                $return .= $break . $val;
                $len = $tmp;
            }
            else
                $return .= $val;
        }
        return $return;
    }
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

  $QcmsList = $osC_Database->query('select cms_id, active, cms_name, cms_short_text from :table_cms where language_id = :language_id');


  $QcmsList->appendQuery('order by cms_id DESC');
  $QcmsList->bindTable(':table_cms', TABLE_CMS);
  $QcmsList->bindInt(':language_id', $osC_Language->getID());
  $QcmsList->setBatchLimit($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, (!empty($_GET['search']) ? 'distinct cms_id' : ''));
  $QcmsList->execute();
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><?php echo $QcmsList->getBatchTotalPages($osC_Language->get('batch_results_number_of_entries')); ?></td>
    <td align="right"><?php echo $QcmsList->getBatchPageLinks('page', $osC_Template->getModule(), false); ?></td>
  </tr>
</table>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
  <thead>
    <tr>
      <th align="left"><?php echo $osC_Language->get('table_heading_name'); ?></th>
      <th align="left"><?php echo $osC_Language->get('table_heading_content'); ?></th>
      <th width="10%"><?php echo $osC_Language->get('table_heading_status'); ?></th>
	  <th align="right" width="150"><?php echo $osC_Language->get('table_heading_action'); ?></th>
      <th align="right" width="20" colspan="2"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th align="right" colspan="4"><?php echo '<input type="image" src="' . osc_icon_raw('trash.png') . '" title="' . $osC_Language->get('icon_trash') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=batchDelete') . '\';" />'; ?></th>
      <th align="right" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </tfoot>
  <tbody>

<?php
  while ($QcmsList->next()) {
?>

    <tr onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" <?php echo (($QcmsList->valueInt('active') !== 1) ? 'class="deactivatedRow"' : '') ?>>
      <td width="25%"><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QcmsList->valueInt('cms_id') . '&action=save'), osc_icon('article.png') . '&nbsp;' . $QcmsList->value('cms_name')); ?></td>
      <td align="left" width="55%"><?php echo utf8_wordwrap(substr($QcmsList->value('cms_short_text'), 0, 150)) . '<small> ' . $osC_Language->get('text_more') . '</small>' ; ?></td>
      <td align="center"><?php echo osc_icon(($QcmsList->valueInt('active') === 1) ? 'checkbox_ticked.gif' : 'checkbox_crossed.gif', null, null); ?></td>
      <td align="right">

<?php
    echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QcmsList->valueInt('cms_id') . '&action=save'), osc_icon('edit.png')) . '&nbsp;' .
         osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&pID=' . $QcmsList->valueInt('cms_id') . '&action=delete'), osc_icon('trash.png'));
?>

      </td>
      <td align="center"><?php echo osc_draw_checkbox_field('batch[]', $QcmsList->valueInt('cms_id'), null, 'id="batch' . $QcmsList->valueInt('cms_id') . '"'); ?></td>
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
    <td align="right"><?php echo $QcmsList->getBatchPagesPullDownMenu('page', $osC_Template->getModule()); ?></td>
  </tr>
</table>
