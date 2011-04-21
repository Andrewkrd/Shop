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

  $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

  $stats = array();

  for ( $i = 1; $i < 13; $i++ ) {
    $stats[] = array(strftime('%m', mktime(0, 0, 0, $i, 1, $year)), '0', '0');
  }

  $views = array();
  $clicks = array();

  $Qstats = $osC_Database->query('select month(banners_history_date) as banner_month, sum(banners_shown) as value, sum(banners_clicked) as dvalue from :table_banners_history where banners_id = :banners_id and year(banners_history_date) = :year group by banner_month');
  $Qstats->bindTable(':table_banners_history', TABLE_BANNERS_HISTORY);
  $Qstats->bindInt(':banners_id', $_GET['bID']);
  $Qstats->bindInt(':year', $year);
  $Qstats->execute();

  while ( $Qstats->next() ) {
    $stats[($Qstats->valueInt('banner_month')-1)] = array(strftime('%m', mktime(0, 0, 0, $Qstats->valueInt('banner_month'), 1, $year)), (($Qstats->valueInt('value') > 0) ? $Qstats->valueInt('value') : '0'), (($Qstats->valueInt('dvalue') > 0) ? $Qstats->valueInt('dvalue') : '0'));

    $views[($Qstats->valueInt('banner_month')-1)] = $Qstats->valueInt('value');
    $clicks[($Qstats->valueInt('banner_month')-1)] = $Qstats->valueInt('dvalue');
  }

  $vLabels = array();

  for ( $i = 1; $i < 13; $i++ ) {
    $vLabels[] = strftime('%m', mktime(0, 0, 0, $i, 1, $year));

    if ( !isset($views[$i-1]) ) {
      $views[$i-1] = 0;
    }

    if ( !isset($clicks[$i-1]) ) {
      $clicks[$i-1] = 0;
    }
  }
?>
