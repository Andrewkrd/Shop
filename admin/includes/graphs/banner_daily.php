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

  $views = array();
  $clicks = array();
  $vLabels = array();

  $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
  $month = isset($_GET['month']) ? $_GET['month'] : date('n');

  $days = date('t', mktime(0, 0, 0, $month))+1;
  $stats = array();

  for ( $i = 1; $i < $days; $i++ ) {
    $stats[] = array($i, '0', '0');

    $views[$i-1] = 0;
    $clicks[$i-1] = 0;
    $vLabels[] = $i;
  }

  $Qstats = $osC_Database->query('select dayofmonth(banners_history_date) as banner_day, banners_shown as value, banners_clicked as dvalue from :table_banners_history where banners_id = :banners_id and month(banners_history_date) = :month and year(banners_history_date) = :year');
  $Qstats->bindTable(':table_banners_history', TABLE_BANNERS_HISTORY);
  $Qstats->bindInt(':banners_id', $_GET['bID']);
  $Qstats->bindInt(':month', $month);
  $Qstats->bindInt(':year', $year);
  $Qstats->execute();

  while ( $Qstats->next() ) {
    $stats[($Qstats->valueInt('banner_day')-1)] = array($Qstats->valueInt('banner_day'), (($Qstats->valueInt('value') > 0) ? $Qstats->valueInt('value') : '0'), (($Qstats->valueInt('dvalue') > 0) ? $Qstats->valueInt('dvalue') : '0'));

    $views[($Qstats->valueInt('banner_day')-1)] = $Qstats->valueInt('value');
    $clicks[($Qstats->valueInt('banner_day')-1)] = $Qstats->valueInt('dvalue');
  }
?>
