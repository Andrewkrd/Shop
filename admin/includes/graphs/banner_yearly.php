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

  $stats = array();

  $Qstats = $osC_Database->query('select year(banners_history_date) as year, sum(banners_shown) as value, sum(banners_clicked) as dvalue from :table_banners_history where banners_id = :banners_id group by year');
  $Qstats->bindTable(':table_banners_history', TABLE_BANNERS_HISTORY);
  $Qstats->bindInt(':banners_id', $_GET['bID']);
  $Qstats->execute();

  while ( $Qstats->next() ) {
    $stats[] = array($Qstats->valueInt('year'), (($Qstats->valueInt('value') > 0) ? $Qstats->valueInt('value') : '0'), (($Qstats->valueInt('dvalue') > 0) ? $Qstats->valueInt('dvalue') : '0'));

    $views[] = $Qstats->valueInt('value');
    $clicks[] = $Qstats->valueInt('dvalue');
    $vLabels[] = $Qstats->valueInt('year');
  }

  if (!isset($stats[0][1]) or !isset($stats[0][2])){  $stats[] = array(date ("Y"), 0, 0);}

?>
