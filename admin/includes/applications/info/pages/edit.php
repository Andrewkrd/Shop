<?php
/* 
  RuBiC production (http://www.rubicshop.ru)
*/
?>

<script type="text/javascript" src="../ext/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
  mode : "none",
  theme : "advanced",
  language : "<?php echo substr($osC_Language->getCode(), 0, 2); ?>",
  height : "400",
  theme_advanced_toolbar_align : "left",
  theme_advanced_toolbar_location : "top",
  theme_advanced_statusbar_location : "bottom",
  cleanup : false,
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertdate,inserttime,preview,|,fullscreen"
});

function toggleEditor(id) {
  if ( !tinyMCE.get(id) ) {
    tinyMCE.execCommand('mceAddControl', false, id);
  } else {
    tinyMCE.execCommand('mceRemoveControl', false, id);
  }
}
</script>

<?php
  if ( isset($_GET['pID']) ) {
    $osC_ObjectInfo = new osC_ObjectInfo(osC_info_Admin::getData($_GET['pID']));

    $Qpd = $osC_Database->query('select info_id, info_name, info_description, language_id, sort_order from :table_info where info_id = :info_id');
    $Qpd->bindTable(':table_info', TABLE_INFO);
    $Qpd->bindInt(':info_id', $_GET['pID']);
    $Qpd->execute();

    $info_name = array();
    $info_description = array();
    $sort_order = array();

    while ($Qpd->next()) {
      $info_name[$Qpd->valueInt('language_id')] = $Qpd->value('info_name');
      $info_description[$Qpd->valueInt('language_id')] = $Qpd->value('info_description');
      $sort_order = $Qpd->value('sort_order');
    }
  }

?>

<h1><?php echo (isset($osC_ObjectInfo) && isset($info_name[$osC_Language->getID()])) ? $info_name[$osC_Language->getID()] : $osC_Language->get('heading_title_new_product'); ?></h1>

<?php
  if ( $osC_MessageStack->exists($osC_Template->getModule()) ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<script type="text/javascript">
$(document).ready(function(){
  $("#mainTabs").tabs( { selected: 0 } );
  $("#languageTabs").tabs( { selected: 0 } );
});
</script>

<form name="info" class="dataForm" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '=' . (isset($osC_ObjectInfo) ? $osC_ObjectInfo->getInt('info_id') : '') . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=save'); ?>" method="post" enctype="multipart/form-data">

<div id="mainTabs">
  <ul>
    <li><?php echo osc_link_object('#section_general_content', $osC_Language->get('section_general')); ?></li>
  </ul>

  <div id="section_general_content">
    <div id="languageTabs">
      <ul>

<?php
  foreach ( $osC_Language->getAll() as $l ) {
    echo '<li>' . osc_link_object('#languageTabs_' . $l['code'], $osC_Language->showImage($l['code']) . '&nbsp;' . $l['name']) . '</li>';
  }
?>

      </ul>

<?php
  foreach ( $osC_Language->getAll() as $l ) {
?>

      <div id="languageTabs_<?php echo $l['code']; ?>">
        <fieldset>
          <div><label for="<?php echo 'info_name[' . $l['id'] . ']'; ?>"><?php echo $osC_Language->get('field_name'); ?></label><?php echo osc_draw_input_field('info_name[' . $l['id'] . ']', (isset($osC_ObjectInfo) && isset($info_name[$l['id']]) ? $info_name[$l['id']] : null)); ?></div>
          <div><label for="<?php echo 'info_description[' . $l['id'] . ']'; ?>"><?php echo $osC_Language->get('field_description'); ?></label><?php echo osc_draw_textarea_field('info_description[' . $l['id'] . ']', (isset($osC_ObjectInfo) && isset($info_description[$l['id']]) ? $info_description[$l['id']] : null)); ?><div style="width: 58.5%; text-align: right;"><?php echo '<a href="javascript:toggleEditor(\'info_description[' . $l['id'] . ']\');">' . $osC_Language->get('toggle_html_editor') . '</a>'; ?></div></div>
        </fieldset>
      </div>

<?php
  }
?>

    </div>
  </div>

  <div id="section_data_content">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%" height="100%" valign="top">
          <fieldset style="width: 100%;">
            <div><label for="info_status"><?php echo $osC_Language->get('field_status'); ?></label><?php echo osc_draw_radio_field('active', array(array('id' => '1', 'text' => $osC_Language->get('status_enabled')), array('id' => '0', 'text' => $osC_Language->get('status_disabled'))), (isset($osC_ObjectInfo) ? $osC_ObjectInfo->get('active') : '0'), null, ''); ?></div>
            <div style="width: 30px"><label for="sort_order"><?php echo $osC_Language->get('sort_order'); ?></label><?php echo osc_draw_input_field('sort_order', (isset($osC_ObjectInfo) ? $sort_order : null)); ?></div>
          </fieldset>
        </td>
      </tr>
    </table>
  </div>
</div>

<p align="left"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" onclick="' . (isset($osC_ObjectInfo) ? 'setFileUploadField(); ' : '') . 'document.product.target=\'_self\'; document.product.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=save') . '\';" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')) . '\';" class="operationButton" />'; ?></p>

</form>
