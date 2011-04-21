<?php
/*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename edit.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tóth
  http://oscommerce-extra.hu
  
  RuBiC modify (http://www.rubicshop.ru)
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
    $osC_ObjectInfo = new osC_ObjectInfo(osC_cms_Admin::getData($_GET['pID']));

    $Qpd = $osC_Database->query('select cms_name, cms_description, cms_short_text, language_id from :table_cms where cms_id = :cms_id');
    $Qpd->bindTable(':table_cms', TABLE_CMS);
    $Qpd->bindInt(':cms_id', $_GET['pID']);
    $Qpd->execute();

    $cms_name = array();
    $cms_description = array();

    while ($Qpd->next()) {
      $cms_name[$Qpd->valueInt('language_id')] = $Qpd->value('cms_name');
      $cms_description[$Qpd->valueInt('language_id')] = $Qpd->value('cms_description');
      $cms_short_text[$Qpd->valueInt('language_id')] = $Qpd->value('cms_short_text');
    }
  }

?>

<h1><?php echo (isset($osC_ObjectInfo) && isset($cms_name[$osC_Language->getID()])) ? $cms_name[$osC_Language->getID()] : $osC_Language->get('heading_title_new_product'); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<script type="text/javascript">
$(document).ready(function(){
  $("#mainTabs").tabs( { selected: 0 } );
  $("#languageTabs").tabs( { selected: 0 } );
});
</script>

<form name="product" class="dataForm" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '=' . (isset($osC_ObjectInfo) ? $osC_ObjectInfo->getInt('cms_id') : '') . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=save'); ?>" method="post" enctype="multipart/form-data">

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
          <div><label for="<?php echo 'cms_name[' . $l['id'] . ']'; ?>"><?php echo $osC_Language->get('field_name'); ?></label><?php echo osc_draw_input_field('cms_name[' . $l['id'] . ']', (isset($osC_ObjectInfo) && isset($cms_name[$l['id']]) ? $cms_name[$l['id']] : null)); ?></div>
          <div><label for="<?php echo 'cms_short_text[' . $l['id'] . ']'; ?>"><?php echo $osC_Language->get('field_short_text'); ?></label><?php echo osc_draw_textarea_field('cms_short_text[' . $l['id'] . ']', (isset($osC_ObjectInfo) && isset($cms_short_text[$l['id']]) ? $cms_short_text[$l['id']] : null)); ?></div>
          <div><label for="<?php echo 'cms_description[' . $l['id'] . ']'; ?>"><?php echo $osC_Language->get('field_description'); ?></label><?php echo osc_draw_textarea_field('cms_description[' . $l['id'] . ']', (isset($osC_ObjectInfo) && isset($cms_description[$l['id']]) ? $cms_description[$l['id']] : null)); ?><div style="width: 58.5%; text-align: right;"><?php echo '<a href="javascript:toggleEditor(\'cms_description[' . $l['id'] . ']\');">' . $osC_Language->get('toggle_html_editor') . '</a>'; ?></div></div>
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
            <div><label for="cms_status"><?php echo $osC_Language->get('field_status'); ?></label><?php echo osc_draw_radio_field('active', array(array('id' => '1', 'text' => $osC_Language->get('status_enabled')), array('id' => '0', 'text' => $osC_Language->get('status_disabled'))), (isset($osC_ObjectInfo) ? $osC_ObjectInfo->get('active') : '0'), null, ''); ?></div>
          </fieldset>
        </td>
      </tr>
    </table>
  </div>
</div>

<p align="left"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" onclick="' . (isset($osC_ObjectInfo) ? 'setFileUploadField(); ' : '') . 'document.product.target=\'_self\'; document.product.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=save') . '\';" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')) . '\';" class="operationButton" />'; ?></p>
</form>
