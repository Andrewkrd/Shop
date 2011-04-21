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
  $type = ( isset($_GET['type']) ? $_GET['type'] : '' );

  $Qyears = $osC_Database->query('select distinct year(banners_history_date) as banner_year from :table_banners_history where banners_id = :banners_id');
  $Qyears->bindTable(':table_banners_history', TABLE_BANNERS_HISTORY);
  $Qyears->bindInt(':banners_id', $_GET['bID']);
  $Qyears->execute();

  $years_array = array();

  while ( $Qyears->next() ) {
    $years_array[] = array('id' => $Qyears->valueInt('banner_year'),
                           'text' => $Qyears->valueInt('banner_year'));
  }

  $Qyears->freeResult();

  $months_array = array();

  for ( $i = 1; $i < 13; $i++ ) {
    $months_array[] = array('id' => $i,
                            'text' => strftime('%m', mktime(0,0,0,$i)));
  }
  $type_array = array(array('id' => 'daily',
                            'text' => $osC_Language->get('section_daily')),
                      array('id' => 'monthly',
                            'text' => $osC_Language->get('section_monthly')),
                      array('id' => 'yearly',
                            'text' => $osC_Language->get('section_yearly')));							

  $osC_ObjectInfo = new osC_ObjectInfo(osC_BannerManager_Admin::getData($_GET['bID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<form name="type" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT); ?>" method="get">
  
<?php
  echo osc_draw_hidden_field($osC_Template->getModule()) .
       osc_draw_hidden_field('page', $_GET['page']) .
       osc_draw_hidden_field('bID', $_GET['bID']) .
       osc_draw_hidden_field('action', 'statistics');
?>

<p align="right">

<?php
  echo $osC_Language->get('operation_heading_type') . ' ' . osc_draw_pull_down_menu('type', $type_array, 'daily', 'onchange="this.form.submit();"') . ' ';

  switch ( $type ) {
    case 'yearly':
      break;

    case 'monthly':
      echo $osC_Language->get('operation_heading_year') . ' ' . osc_draw_pull_down_menu('year', $years_array, date('Y'), 'onchange="this.form.submit();"');

      break;

    case 'daily':
    default:
      echo $osC_Language->get('operation_heading_month') . ' ' . osc_draw_pull_down_menu('month', $months_array, date('n'), 'onchange="this.form.submit();"') . ' ' .
           $osC_Language->get('operation_heading_year') . ' ' . osc_draw_pull_down_menu('year', $years_array, date('Y'), 'onchange="this.form.submit();"');

      break;
  }

  echo '&nbsp;<input type="button" value="' . $osC_Language->get('button_back') . '" class="operationButton" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&bID=' . $_GET['bID']) . '\';" />';
?>

</p>
</form>

<?php

    switch ( $type ) {
      case 'yearly':
        include('includes/graphs/banner_yearly.php');

        echo '<p align="center">' . sprintf($osC_Language->get('subsection_heading_statistics_yearly'), $osC_ObjectInfo->get('banners_title')); echo '<br></p>';

        break;

      case 'monthly':
        include('includes/graphs/banner_monthly.php');

        echo '<p align="center">' . sprintf($osC_Language->get('subsection_heading_statistics_monthly'), $osC_ObjectInfo->get('banners_title'), $year); echo '<br></p>';

        break;

      case 'daily':
      default:
        include('includes/graphs/banner_daily.php');

        echo '<p align="center">' . sprintf($osC_Language->get('subsection_heading_statistics_daily'), $osC_ObjectInfo->get('banners_title'), strftime('%m /', mktime(0, 0, 0, $month)), $year); echo '<br></p>';

        break;
    }
	
	//$stats - > $stats[0][1] - RuBiC mod
	foreach ($stats as $value) {
	  $tmp_arr[] = $value[0];
	  $tmp_arr[] = $value[1];
	  $arr_01[] = $tmp_arr;
	  unset($tmp_arr);
	}	
	//$stats - > $stats[0][2] - RuBiC mod
	foreach ($stats as $value1) {
	  $tmp_arr[] = $value1[0];
	  $tmp_arr[] = $value1[2];
	  $arr_02[] = $tmp_arr;
	  unset($tmp_arr);
	}	
?>

<table border="0" width="99%" align="center">
 <thead align="center">
  <td align="center">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <!-- Load Flot -->
  <!--[if IE]><script language="javascript" type="text/javascript" src="external/flot/excanvas.min.js"></script><![endif]-->
  <script language="javascript" type="text/javascript" src="external/flot/jquery.js"></script>
  <script language="javascript" type="text/javascript" src="external/flot/jquery.flot.js"></script>
</head>
<body>
  <noscript><strong style="color: red;">Enable JavaScript!</strong></noscript>
  <div id="placeholder" align="center" style="width:600px;height:300px;"></div>
<script language="javascript" type="text/javascript">	
var all_data = [
  { data: 
  <?php echo json_encode($arr_01) ?>, 
  label: "<?php echo $osC_Language->get('table_heading_views'); ?>"},
  { data: 
  <?php echo json_encode($arr_02) ?>, 
  label: "<?php echo $osC_Language->get('table_heading_clicks'); ?>"},
];
var plot_conf = {
  bars: { show: true,lineWidth: 2, barWidth: 0.7, fill: 0.9, fillColor: false },
  xaxis: { tickDecimals: 0 },
  yaxis: { tickDecimals: 0, min:0},
};
$.plot($("#placeholder"), all_data, plot_conf);
</script>
  </body>
</html>
  </td>
    </thead>
</table>
<table border="0" width="600" cellspacing="0" cellpadding="2" class="dataTable" align="center">
  <thead>
    <tr>
      <th align="left"><?php echo $osC_Language->get('table_heading_source'); ?></th>
      <th align="left"><?php echo $osC_Language->get('table_heading_views'); ?></th>
      <th align="left"><?php echo $osC_Language->get('table_heading_clicks'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php
  if ( isset($stats) ) {
    for ( $i = 0, $n = sizeof($stats); $i < $n; $i++ ) {
      echo '    <tr>' .
           '      <td>' . $stats[$i][0] . '</td>' .
           '      <td>' . $stats[$i][1] . '</td>' .
           '      <td>' . $stats[$i][2] . '</td>' .
           '    </tr>';
    }
  }
  $f = sizeof($stats);
?>
  </tbody>
</table>