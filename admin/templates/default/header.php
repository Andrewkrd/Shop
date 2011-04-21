<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<script language="javascript" src="external/jscookmenu/JSCookMenu.js"></script>
<link rel="stylesheet" href="external/jscookmenu/ThemeOffice/theme.css" type="text/css">
<script language="javascript" src="external/jscookmenu/ThemeOffice/theme.js"></script>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left: 5px;"><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT), osc_image('includes/languages/'. $osC_Language->getCode() .'/images/img.png', 'RuBiC')); ?></td>
    <td width="330" align="right" style="padding-right: 5px;" >
<span style="color: #FFFFFF;"><b>
<?php
  if ( $request_type == 'SSL' ) {
    echo sprintf($osC_Language->get('ssl_protection'), (isset($_SERVER['SSL_CIPHER_ALGKEYSIZE']) ? $_SERVER['SSL_CIPHER_ALGKEYSIZE'] . '-bit' : '')) . osc_icon('locked.png');
  } else {
    echo $osC_Language->get('ssl_unprotected') . ' ' . osc_icon('unlocked.png');
  }
?>
</b></span>
    </td>
  </tr>
</table>

<div id="administrationMenu" class="ThemeOfficeMainItem">
  <ul style="visibility: hidden">

<?php
  $access = array();

  if ( isset($_SESSION['admin']) ) {
    $access = osC_Access::getLevels();
  }

  ksort($access);

  foreach ( $access as $group => $links ) {
    echo '    <li><span></span><span>' . osC_Access::getGroupTitle($group) . '</span>' .
         '      <ul>';

    ksort($links);

    foreach ( $links as $link ) {
      echo '        <li><span>' . osc_icon($link['icon'], $link['title']) . '</span><a href="' . osc_href_link_admin(FILENAME_DEFAULT, $link['module']) . '">' . $link['title'] . '</a>';

      if ( is_array($link['subgroups']) && !empty($link['subgroups']) ) {
        echo '          <ul>';

        foreach ( $link['subgroups'] as $subgroup ) {
          echo '            <li><span>' . osc_icon($subgroup['icon']) . '</span><a href="' . osc_href_link_admin(FILENAME_DEFAULT, $link['module'] . '&' . $subgroup['identifier']) . '">' . $subgroup['title'] . '</a></li>';
        }

        echo '          </ul>';
      }

      echo '        </li>';
    }

    echo '      </ul>' .
         '    </li>' .
         '    <li></li>';
  }

  echo '    <li><span></span><span>' . $osC_Language->get('header_title_help') . '</span>' .
       '      <ul>' .
       '        <li><span>' . osc_icon('oscommerce.png') . '</span><span>' . $osC_Language->get('header_title_oscommerce_support_site') . '</span>' .
       '          <ul>' .
        '            <li><span>' . osc_icon('wrench_orange.png') . '</span><a href="'.osc_href_link_admin(FILENAME_DEFAULT, 'help') .'">' . $osC_Language->get('header_title_oscommerce_support_tech') . '</a></li>' .
       '          </ul>' .
       '        </li>' .
       '        <li><span>' . osc_icon('locale.png') . '</span><span>' . $osC_Language->get('header_title_languages') . '</span>' .
       '          <ul>';

  foreach ( $osC_Language->getAll() as $l ) {
    echo '            <li><span>' . $osC_Language->showImage($l['code']) . '</span><a href="' . osc_href_link_admin(FILENAME_DEFAULT, 'language=' . $l['code']) . '">' . $l['name'] . '</a></li>';
  }

  echo '          </ul>' .
       '        </li>' .
       '        <li><span>' . osc_icon('home.png') . '</span><a href="' . osc_href_link('', null, 'NONSSL', false, false, true) . '" target="_blank">' . $osC_Language->get('header_title_online_catalog') . '</a></li>' .
       '      </ul>' .
       '    </li>';

  if ( isset($_SESSION['admin']) ) {
    echo '    <li></li>' .
         '    <li><span></span><a href="' . osc_href_link_admin(FILENAME_DEFAULT, 'login&action=logoff') . '">' . $osC_Language->get('header_title_logoff') . '</a></li>';
  }
?>

  </ul>
</div>

<script type="text/javascript"><!--
  cmDrawFromText('administrationMenu', 'hbr', cmThemeOffice, 'ThemeOffice');
//--></script>

<?php
  if ( $osC_MessageStack->size('header') > 0 ) {
    echo $osC_MessageStack->get('header');
  }
?>
