<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  $osC_DirectoryListing = new osC_DirectoryListing('includes/modules/newsletters');
  $osC_DirectoryListing->setIncludeDirectories(false);

  $modules_array = array();

  foreach ( $osC_DirectoryListing->getFiles() as $file ) {
    $module = substr($file['name'], 0, strrpos($file['name'], '.'));

    $osC_Language->loadIniFile('modules/newsletters/' . $file['name']);
    include('includes/modules/newsletters/' . $file['name']);

    $newsletter_module_class = 'osC_Newsletter_' . $module;
    $osC_NewsletterModule = new $newsletter_module_class();

    $modules_array[] = array('id' => $module,
                             'text' => $osC_NewsletterModule->getTitle());
  }
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
<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('new.png') . ' ' . $osC_Language->get('action_heading_new_newsletter'); ?></div>
<div class="infoBoxContent">
  <form name="newsletter" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&action=save'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_new_newsletter'); ?></p>

  <table border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_module') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_pull_down_menu('module', $modules_array); ?></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_title') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_input_field('title'); ?></td>
    </tr>
    <tr>
      <td width="40%" valign="top"><?php echo '<b>' . $osC_Language->get('field_content') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_textarea_field('content', null, 60, 20, 'style="width: 100%;"'); ?><div style="width: 100%; text-align: right;"><?php if (EMAIL_USE_HTML == '1') { echo '<a href="javascript:toggleEditor(\'content\');">' . $osC_Language->get('toggle_html_editor') . '</a>'; } ?></div></td>
    </tr>
  </table>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
